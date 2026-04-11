<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SubscriptionPlan::create([
            'plan_name' => 'Basic',
            'duration_months' => 1,
            'price' => 999,
            'confirm_price' => 499,
            'features' => json_encode([
                'List 1 Gym Online',
                'Manage Members & Leads for 1 Gym',
                'Payments, Invoices & ID Cards for 1 Gym',
                'Manage 1 Gym\'s Photo Gallery'
            ]),
            'is_recommended' => false,
            'status' => 'active'
        ]);

        \App\Models\SubscriptionPlan::create([
            'plan_name' => 'Standard',
            'duration_months' => 6,
            'price' => 4999,
            'confirm_price' => 2499,
            'features' => json_encode([
                'List up to 3 Gyms Online',
                'Manage Members & Leads for 3 Gyms',
                'Payments, Invoices & ID Cards for 3 Gyms',
                'Manage Photo Galleries for 3 Gyms'
            ]),
            'is_recommended' => true,
            'status' => 'active'
        ]);

        \App\Models\SubscriptionPlan::create([
            'plan_name' => 'Premium',
            'duration_months' => 12,
            'price' => 8999,
            'confirm_price' => 4499,
            'features' => json_encode([
                'List up to 5 Gyms Online',
                'Manage Members & Leads for 5 Gyms',
                'Payments, Invoices & ID Cards for 5 Gyms',
                'Manage Photo Galleries for 5 Gyms'
            ]),
            'is_recommended' => false,
            'status' => 'active'
        ]);
    }
}
