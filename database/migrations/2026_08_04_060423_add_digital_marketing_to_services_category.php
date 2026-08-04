<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // MySQL requires redefining the whole enum to add a new value
        DB::statement("ALTER TABLE services MODIFY COLUMN category ENUM('3d_mapping', 'web_development', 'digital_marketing') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE services MODIFY COLUMN category ENUM('3d_mapping', 'web_development') NOT NULL");
    }
};
