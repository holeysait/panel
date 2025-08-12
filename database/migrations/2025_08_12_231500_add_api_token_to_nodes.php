<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('nodes')) {
            Schema::table('nodes', function (Blueprint $t) {
                if (!Schema::hasColumn('nodes','api_token_hash')) $t->string('api_token_hash', 64)->nullable()->after('status');
                if (!Schema::hasColumn('nodes','token_last_shown_at')) $t->timestamp('token_last_shown_at')->nullable()->after('api_token_hash');
            });
        }
    }
    public function down(): void {
        if (Schema::hasTable('nodes')) {
            Schema::table('nodes', function (Blueprint $t) {
                if (Schema::hasColumn('nodes','token_last_shown_at')) $t->dropColumn('token_last_shown_at');
                if (Schema::hasColumn('nodes','api_token_hash')) $t->dropColumn('api_token_hash');
            });
        }
    }
};