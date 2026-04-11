<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    if (!Schema::hasColumn('gyms', 'seo_keywords')) {
        DB::statement("ALTER TABLE gyms ADD COLUMN seo_keywords TEXT NULL AFTER seo_description");
        echo "seo_keywords column added to gyms table.\n";
    } else {
        echo "Column already exists.\n";
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
