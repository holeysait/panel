<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('locations')) {
            Schema::create('locations', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->string('slug')->unique();
                $t->string('country')->nullable();
                $t->string('city')->nullable();
                $t->boolean('is_active')->default(true);
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        }
    }
    public function down(): void {
        Schema::dropIfExists('locations');
    }
};
