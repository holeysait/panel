<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('nodes')) {
            Schema::table('nodes', function (Blueprint $t) {
                if (!Schema::hasColumn('nodes','last_seen_at')) $t->timestamp('last_seen_at')->nullable()->after('token_last_shown_at');
                if (!Schema::hasColumn('nodes','last_health_error')) $t->string('last_health_error', 255)->nullable()->after('last_seen_at');
            });
        }
    }
    public function down(): void {
        if (Schema::hasTable('nodes')) {
            Schema::table('nodes', function (Blueprint $t) {
                if (Schema::hasColumn('nodes','last_health_error')) $t->dropColumn('last_health_error');
                if (Schema::hasColumn('nodes','last_seen_at')) $t->dropColumn('last_seen_at');
            });
        }
    }
};