<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    // Add index to created_at if it doesn't exist
    $sm = Schema::getConnection()->getDoctrineSchemaManager();
    $indexes = $sm->listTableIndexes('gyms');

    if (!array_key_exists('gyms_created_at_index', $indexes)) {
        DB::statement('ALTER TABLE gyms ADD INDEX gyms_created_at_index (created_at)');
        echo "Index created on created_at for fast pagination.\n";
    } else {
        echo "Index already exists on created_at.\n";
    }

} catch (\Exception $e) {
    echo $e->getMessage();
}
