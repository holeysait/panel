<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('nodes', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('public_fqdn');
            $t->string('daemon_url');
            $t->json('capabilities')->nullable();
            $t->string('status')->default('offline');
            $t->timestamps();
        });
        Schema::create('allocations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('node_id')->constrained();
            $t->string('ip');
            $t->integer('port');
            $t->boolean('is_taken')->default(false);
            $t->unique(['node_id','ip','port']);
        });
        Schema::create('servers', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained();
            $t->foreignId('egg_id')->constrained();
            $t->foreignId('node_id')->nullable()->constrained();
            $t->foreignId('allocation_id')->nullable()->constrained();
            $t->uuid('uuid')->unique();
            $t->string('name');
            $t->integer('cpu_limit');
            $t->integer('ram_mb');
            $t->integer('disk_gb');
            $t->string('status')->default('provisioning');
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('servers');
        Schema::dropIfExists('allocations');
        Schema::dropIfExists('nodes');
    }
};