<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $t) {
            if (!Schema::hasColumn('users','is_admin')) {
                $t->boolean('is_admin')->default(false)->after('email_verified_at');
            }
            if (!Schema::hasColumn('users','locale')) {
                $t->string('locale', 8)->nullable()->after('is_admin');
            }
            if (!Schema::hasColumn('users','avatar_path')) {
                $t->string('avatar_path')->nullable()->after('locale');
            }
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $t) {
            if (Schema::hasColumn('users','avatar_path')) $t->dropColumn('avatar_path');
            if (Schema::hasColumn('users','locale')) $t->dropColumn('locale');
            if (Schema::hasColumn('users','is_admin')) $t->dropColumn('is_admin');
        });
    }
};