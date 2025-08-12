<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('usage_records', function (Blueprint $t) {
            $t->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::table('usage_records', function (Blueprint $t) {
            $t->dropForeign(['server_id']);
        });
    }
};