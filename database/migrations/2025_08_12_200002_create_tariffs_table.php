<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('tariffs')) {
            Schema::create('tariffs', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->string('slug')->unique();
                $t->text('description')->nullable();
                $t->bigInteger('price_minor');
                $t->string('currency',3)->default('USD');
                $t->enum('period',['hour','day','month'])->default('month');
                $t->integer('cpu_limit');
                $t->integer('ram_mb');
                $t->integer('disk_gb');
                $t->integer('ports')->default(1);
                $t->boolean('is_active')->default(true);
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        }
    }
    public function down(): void { Schema::dropIfExists('tariffs'); }
};
