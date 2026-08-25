<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_account', function (Blueprint $table): void {
            if (Schema::hasColumn('user_account', 'name')) {
                $table->string('name', 255)->nullable()->default(null)->change();
            }
            if (Schema::hasColumn('user_account', 'company_name')) {
                $table->string('company_name', 255)->nullable()->default(null)->change();
            }
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('user_account', 'name')) {
            Schema::table('user_account', function (Blueprint $table): void {
                $table->string('name', 255)->nullable(false)->change();
            });
        }
    }
};
