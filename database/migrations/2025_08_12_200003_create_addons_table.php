<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('addons')) {
            Schema::create('addons', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->string('code')->unique();
                $t->text('description')->nullable();
                $t->string('unit');
                $t->bigInteger('unit_price_minor');
                $t->string('currency',3)->default('USD');
                $t->boolean('is_active')->default(true);
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        }
    }
    public function down(): void { Schema::dropIfExists('addons'); }
};
