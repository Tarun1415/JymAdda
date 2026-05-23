<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('bank_details')) {
            return;
        }

        $this->addIndex('bank_details', 'idx_bank_details_bank_slug', 'bank_slug');
        $this->addIndex('bank_details', 'idx_bank_details_bank_state', 'bank_slug, state_slug');
        $this->addIndex('bank_details', 'idx_bank_details_location', 'bank_slug, state_slug, district_slug');
        $this->addIndex('bank_details', 'idx_bank_details_ifsc_lookup', 'bank_slug(120), state_slug(120), district_slug(120), ifsc_slug(50)');
    }

    public function down(): void
    {
        if (! Schema::hasTable('bank_details')) {
            return;
        }

        $this->dropIndex('bank_details', 'idx_bank_details_ifsc_lookup');
        $this->dropIndex('bank_details', 'idx_bank_details_location');
        $this->dropIndex('bank_details', 'idx_bank_details_bank_state');
        $this->dropIndex('bank_details', 'idx_bank_details_bank_slug');
    }

    private function addIndex(string $table, string $name, string $columns): void
    {
        if ($this->indexExists($table, $name)) {
            return;
        }

        DB::statement("ALTER TABLE {$table} ADD INDEX {$name} ({$columns})");
    }

    private function dropIndex(string $table, string $name): void
    {
        if (! $this->indexExists($table, $name)) {
            return;
        }

        DB::statement("ALTER TABLE {$table} DROP INDEX {$name}");
    }

    private function indexExists(string $table, string $name): bool
    {
        return collect(DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$name]))->isNotEmpty();
    }
};
