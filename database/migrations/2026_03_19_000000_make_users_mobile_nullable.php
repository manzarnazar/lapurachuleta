<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // `users.mobile` is UNIQUE; allowing NULL lets multiple users omit phone numbers.
        DB::statement('ALTER TABLE users MODIFY mobile VARCHAR(20) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE users MODIFY mobile VARCHAR(20) NOT NULL');
    }
};

