<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('usage_records', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('server_id'); // FK will be added later after servers table exists
            $t->timestamp('ts_minute');
            $t->integer('cpu_ms')->default(0);
            $t->integer('ram_mb_min')->default(0);
            $t->integer('disk_gb_x1000')->default(0);
            $t->integer('net_in_mb')->default(0);
            $t->integer('net_out_mb')->default(0);
            $t->unique(['server_id','ts_minute']);
            $t->index('server_id');
        });
    }
    public function down(): void { Schema::dropIfExists('usage_records'); }
};