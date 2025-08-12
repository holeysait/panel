<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('promotions')) {
            Schema::create('promotions', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->string('code')->unique();
                $t->text('description')->nullable();
                $t->unsignedInteger('discount_percent')->nullable(); // 0-100
                $t->bigInteger('discount_amount_minor')->nullable(); // fixed discount in minor units
                $t->timestamp('starts_at')->nullable();
                $t->timestamp('ends_at')->nullable();
                $t->boolean('is_active')->default(true);
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
