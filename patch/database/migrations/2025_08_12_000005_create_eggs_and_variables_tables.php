<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('eggs', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('docker_image');
            $t->string('startup_cmd');
            $t->string('version')->nullable();
            $t->string('author')->nullable();
            $t->string('source_url')->nullable();
            $t->json('features')->nullable();
            $t->timestamps();
        });
        Schema::create('egg_variables', function (Blueprint $t) {
            $t->id();
            $t->foreignId('egg_id')->constrained();
            $t->string('env_key');
            $t->string('label');
            $t->text('description')->nullable();
            $t->string('default')->nullable();
            $t->json('rules');
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('egg_variables');
        Schema::dropIfExists('eggs');
    }
};