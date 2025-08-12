<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $t) {
                $t->boolean('is_admin')->default(false)->after('password');
            });
        }
        if (!Schema::hasColumn('users', 'locale')) {
            Schema::table('users', function (Blueprint $t) {
                $t->string('locale', 8)->nullable()->after('remember_token');
            });
        }
    }
    public function down(): void {
        if (Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $t) { $t->dropColumn('is_admin'); });
        }
        if (Schema::hasColumn('users', 'locale')) {
            Schema::table('users', function (Blueprint $t) { $t->dropColumn('locale'); });
        }
    }
};
