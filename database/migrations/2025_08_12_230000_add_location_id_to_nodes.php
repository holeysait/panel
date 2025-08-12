<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('nodes') && !Schema::hasColumn('nodes','location_id')) {
            Schema::table('nodes', function (Blueprint $t) {
                $t->unsignedBigInteger('location_id')->nullable()->after('id');
                $t->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
            });
        }
    }
    public function down(): void {
        if (Schema::hasTable('nodes') && Schema::hasColumn('nodes','location_id')) {
            Schema::table('nodes', function (Blueprint $t) {
                $t->dropForeign(['location_id']);
                $t->dropColumn('location_id');
            });
        }
    }
};