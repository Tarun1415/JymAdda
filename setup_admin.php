<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    if (!Schema::hasColumn('users', 'role')) {
        DB::statement("ALTER TABLE users ADD COLUMN role ENUM('admin', 'manager', 'staff') DEFAULT 'staff' AFTER password");
        echo "Role column added.\n";
    }

    $admin = User::firstOrCreate(
        ['email' => 'admin@gymadda.com'],
        [
            'name' => 'Super Admin',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]
    );
    echo "Admin created successfully.\n";

} catch (\Exception $e) {
    echo $e->getMessage();
}
