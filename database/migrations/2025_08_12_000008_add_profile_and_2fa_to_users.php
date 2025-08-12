<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $t) {
            if (!Schema::hasColumn('users','avatar_path')) $t->string('avatar_path')->nullable();
            if (!Schema::hasColumn('users','locale')) $t->string('locale', 5)->nullable()->default('ru');
            if (!Schema::hasColumn('users','two_factor_secret')) $t->string('two_factor_secret')->nullable();
            if (!Schema::hasColumn('users','two_factor_recovery_codes')) $t->text('two_factor_recovery_codes')->nullable();
            if (!Schema::hasColumn('users','two_factor_enabled')) $t->boolean('two_factor_enabled')->default(false);
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $t) {
            if (Schema::hasColumn('users','avatar_path')) $t->dropColumn('avatar_path');
            if (Schema::hasColumn('users','locale')) $t->dropColumn('locale');
            if (Schema::hasColumn('users','two_factor_secret')) $t->dropColumn('two_factor_secret');
            if (Schema::hasColumn('users','two_factor_recovery_codes')) $t->dropColumn('two_factor_recovery_codes');
            if (Schema::hasColumn('users','two_factor_enabled')) $t->dropColumn('two_factor_enabled');
        });
    }
};
