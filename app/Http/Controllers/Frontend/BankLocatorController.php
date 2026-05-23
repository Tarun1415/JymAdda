<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class BankLocatorController extends Controller
{
    public function index(
        Request $request,
        ?string $bankSlug = null,
        ?string $stateSlug = null,
        ?string $districtSlug = null,
        ?string $ifscSlug = null
    ) {

        $selectedBank = null;
        $selectedState = null;
        $selectedDistrict = null;
        $selectedIfsc = null;

        /*
        |--------------------------------------------------------------------------
        | Banks
        |--------------------------------------------------------------------------
        */

        $banks = $this->banks();

        /*
        |--------------------------------------------------------------------------
        | Main Query
        |--------------------------------------------------------------------------
        */

        $query = BankDetail::query();

        /*
        |--------------------------------------------------------------------------
        | Bank Filter
        |--------------------------------------------------------------------------
        */

        if ($bankSlug) {

            $query->where('bank_slug', $bankSlug);

            $selectedBank = optional(
                $banks->firstWhere('bank_slug', $bankSlug)
            )->bank;

            if (! $selectedBank) {
                abort(404);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | States
        |--------------------------------------------------------------------------
        */

        $states = collect();

        if ($bankSlug) {

            $states = $this->states($bankSlug);
        }

        /*
        |--------------------------------------------------------------------------
        | State Filter
        |--------------------------------------------------------------------------
        */

        if ($stateSlug) {

            $query->where('state_slug', $stateSlug);

            $selectedState = optional(
                $states->firstWhere('state_slug', $stateSlug)
            )->state;

            if (! $selectedState) {
                abort(404);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Districts
        |--------------------------------------------------------------------------
        */

        $districts = collect();

        if ($bankSlug && $stateSlug) {

            $districts = $this->districts(
                $bankSlug,
                $stateSlug
            );
        }

        /*
        |--------------------------------------------------------------------------
        | District Filter
        |--------------------------------------------------------------------------
        */

        if ($districtSlug) {

            $query->where('district_slug', $districtSlug);

            $selectedDistrict = optional(
                $districts->firstWhere('district_slug', $districtSlug)
            )->district;

            if (! $selectedDistrict) {
                abort(404);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | IFSC Detail
        |--------------------------------------------------------------------------
        */

        if ($ifscSlug) {

            $query->where(function ($q) use ($ifscSlug) {

                $q->where('ifsc_slug', $ifscSlug)
                    ->orWhere('ifsc', strtoupper($ifscSlug));
            });

            $selectedIfsc = $query->first();

            if (! $selectedIfsc) {
                abort(404);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | IFSC List
        |--------------------------------------------------------------------------
        */

        $ifscOptions = collect();

        if (
            $bankSlug &&
            $stateSlug &&
            $districtSlug
        ) {

            $ifscOptions = $this->ifscOptions(
                $bankSlug,
                $stateSlug,
                $districtSlug
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Branches
        |--------------------------------------------------------------------------
        */

        $branches = collect();

        if (
            $bankSlug &&
            $stateSlug &&
            $districtSlug &&
            ! $ifscSlug
        ) {

            $branches = $query
                ->whereNotNull('ifsc')
                ->select(
                    'bank',
                    'bank_slug',
                    'state',
                    'state_slug',
                    'district',
                    'district_slug',
                    'branch',
                    'branch_slug',
                    'ifsc',
                    'ifsc_slug',
                    'address',
                    'city',
                    'micr',
                    'neft',
                    'rtgs',
                    'imps'
                )
                ->orderBy('branch')
                ->simplePaginate(20);
        }

        /*
        |--------------------------------------------------------------------------
        | Stats
        |--------------------------------------------------------------------------
        */

        $stats = $this->stats();

        /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        */

        $this->seo(
            $selectedBank,
            $selectedState,
            $selectedDistrict,
            $selectedIfsc
        );

        return view('frontend.pages.bank-locator', compact(
            'banks',
            'states',
            'districts',
            'ifscOptions',
            'branches',
            'selectedIfsc',
            'selectedBank',
            'selectedState',
            'selectedDistrict',
            'bankSlug',
            'stateSlug',
            'districtSlug',
            'ifscSlug',
            'stats'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SEO
    |--------------------------------------------------------------------------
    */

    private function seo(
        ?string $selectedBank = null,
        ?string $selectedState = null,
        ?string $selectedDistrict = null,
        ?BankDetail $selectedIfsc = null
    ): void {

        /*
        |--------------------------------------------------------------------------
        | IFSC SEO
        |--------------------------------------------------------------------------
        */

        if ($selectedIfsc) {

            $title =
                $selectedIfsc->ifsc .
                ' IFSC Code - ' .
                $selectedIfsc->branch .
                ' Branch ' .
                $selectedIfsc->bank;

            $description =
                'Get complete details of ' .
                $selectedIfsc->bank .
                ' ' .
                $selectedIfsc->branch .
                ' branch IFSC Code ' .
                $selectedIfsc->ifsc .
                ', MICR code, address, NEFT, RTGS, IMPS and branch contact details.';

            $keywords = implode(', ', [

                $selectedIfsc->ifsc . ' IFSC Code',
                $selectedIfsc->branch . ' IFSC Code',
                $selectedIfsc->bank . ' IFSC Code',
                $selectedIfsc->branch . ' branch details',
                $selectedIfsc->district . ' IFSC Code',
                $selectedIfsc->state . ' bank IFSC',
                'MICR Code',
                'NEFT RTGS IMPS',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | District SEO
        |--------------------------------------------------------------------------
        */

        elseif (
            $selectedBank &&
            $selectedState &&
            $selectedDistrict
        ) {

            $title =
                $selectedBank .
                ' IFSC Code in ' .
                $selectedDistrict . ', ' .
                $selectedState;

            $description =
                'Find all branches of ' .
                $selectedBank .
                ' in ' .
                $selectedDistrict . ', ' .
                $selectedState .
                ' with IFSC Code, MICR code, address and banking details.';

            $keywords = implode(', ', [

                $selectedBank . ' IFSC Code in ' . $selectedDistrict,
                $selectedDistrict . ' bank branches',
                $selectedBank . ' branch list in ' . $selectedDistrict,
                $selectedBank . ' MICR Code',
                $selectedState . ' IFSC Code',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | State SEO
        |--------------------------------------------------------------------------
        */

        elseif (
            $selectedBank &&
            $selectedState
        ) {

            $title =
                $selectedBank .
                ' IFSC Code in ' .
                $selectedState;

            $description =
                'Find all branches of ' .
                $selectedBank .
                ' in ' .
                $selectedState .
                ' with IFSC Code, MICR code, branch address and banking details.';

            $keywords = implode(', ', [

                $selectedBank . ' IFSC Code in ' . $selectedState,
                $selectedBank . ' branch list',
                $selectedState . ' bank IFSC Code',
                $selectedBank . ' MICR Code',
                $selectedBank . ' branch address',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Bank SEO
        |--------------------------------------------------------------------------
        */

        elseif ($selectedBank) {

            $title =
                $selectedBank .
                ' IFSC Code';

            $description =
                'Find all branch IFSC Codes of ' .
                $selectedBank .
                ' across India with MICR code, address and branch details.';

            $keywords = implode(', ', [

                $selectedBank . ' IFSC Code',
                $selectedBank . ' branch list',
                $selectedBank . ' MICR Code',
                $selectedBank . ' bank branches',
                $selectedBank . ' IFSC finder',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Home SEO
        |--------------------------------------------------------------------------
        */

        else {

            $title = 'IFSC Code Finder';

            $description =
                'Search IFSC Code, MICR Code, branch address and bank details of all Indian banks online.';

            $keywords =
                'IFSC Code Finder, MICR Code Finder, Bank IFSC Code, Bank Branch Details, IFSC Search';
        }

        /*
        |--------------------------------------------------------------------------
        | SEO Meta
        |--------------------------------------------------------------------------
        */

        SEOMeta::setTitle($title . ' | GymHai');

        SEOMeta::setDescription($description);

        SEOMeta::setCanonical(url()->current());

        SEOMeta::setKeywords($keywords);

        /*
        |--------------------------------------------------------------------------
        | Open Graph
        |--------------------------------------------------------------------------
        */

        OpenGraph::setTitle($title . ' | GymHai');

        OpenGraph::setDescription($description);

        OpenGraph::setUrl(url()->current());

        OpenGraph::addProperty('type', 'website');

        OpenGraph::setSiteName('GymHai');

        /*
        |--------------------------------------------------------------------------
        | Twitter
        |--------------------------------------------------------------------------
        */

        TwitterCard::setTitle($title . ' | GymHai');

        TwitterCard::setDescription($description);

        TwitterCard::addValue('card', 'summary_large_image');
    }

    /*
    |--------------------------------------------------------------------------
    | Banks
    |--------------------------------------------------------------------------
    */

    private function banks()
    {
        return Cache::remember(
            'bank_locator_banks',
            now()->addDay(),
            function () {

                return BankDetail::query()
                    ->whereNotNull('bank')
                    ->whereNotNull('bank_slug')
                    ->select('bank', 'bank_slug')
                    ->groupBy('bank', 'bank_slug')
                    ->orderBy('bank')
                    ->get();
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | States
    |--------------------------------------------------------------------------
    */

    private function states(string $bankSlug)
    {
        return Cache::remember(
            "bank_locator_states_{$bankSlug}",
            now()->addDay(),
            function () use ($bankSlug) {

                return BankDetail::query()
                    ->where('bank_slug', $bankSlug)
                    ->whereNotNull('state')
                    ->whereNotNull('state_slug')
                    ->select('state', 'state_slug')
                    ->groupBy('state', 'state_slug')
                    ->orderBy('state')
                    ->get();
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Districts
    |--------------------------------------------------------------------------
    */

    private function districts(
        string $bankSlug,
        string $stateSlug
    ) {

        return Cache::remember(
            "bank_locator_districts_{$bankSlug}_{$stateSlug}",
            now()->addDay(),
            function () use (
                $bankSlug,
                $stateSlug
            ) {

                return BankDetail::query()
                    ->where('bank_slug', $bankSlug)
                    ->where('state_slug', $stateSlug)
                    ->whereNotNull('district')
                    ->whereNotNull('district_slug')
                    ->select('district', 'district_slug')
                    ->groupBy('district', 'district_slug')
                    ->orderBy('district')
                    ->get();
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | IFSC Options
    |--------------------------------------------------------------------------
    */

    private function ifscOptions(
        string $bankSlug,
        string $stateSlug,
        string $districtSlug
    ) {

        return Cache::remember(
            "bank_locator_ifsc_{$bankSlug}_{$stateSlug}_{$districtSlug}",
            now()->addDay(),
            function () use (
                $bankSlug,
                $stateSlug,
                $districtSlug
            ) {

                return BankDetail::query()
                    ->where('bank_slug', $bankSlug)
                    ->where('state_slug', $stateSlug)
                    ->where('district_slug', $districtSlug)
                    ->whereNotNull('ifsc')
                    ->select(
                        'ifsc',
                        'ifsc_slug',
                        'branch',
                        'city'
                    )
                    ->orderBy('branch')
                    ->get();
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Stats
    |--------------------------------------------------------------------------
    */

    private function stats(): array
    {
        return Cache::remember(
            'bank_locator_stats',
            now()->addDay(),
            function () {

                return [

                    'banks' => BankDetail::whereNotNull('bank_slug')
                        ->distinct('bank_slug')
                        ->count('bank_slug'),

                    'states' => BankDetail::whereNotNull('state_slug')
                        ->distinct('state_slug')
                        ->count('state_slug'),

                    'branches' => BankDetail::whereNotNull('ifsc')
                        ->count(),
                ];
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | IFSC URL
    |--------------------------------------------------------------------------
    */

    public static function ifscUrl(
        BankDetail $detail
    ): string {

        return route('bank.locator.show', [

            'bankSlug' => $detail->bank_slug,

            'stateSlug' => $detail->state_slug,

            'districtSlug' => $detail->district_slug,

            'ifscSlug' => Str::lower(
                $detail->ifsc_slug ?: $detail->ifsc
            ),
        ]);
    }
}