<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('price_catalog', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('unit');
            $t->bigInteger('unit_price_minor');
            $t->json('meta')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('price_catalog'); }
};