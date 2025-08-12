<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('addons', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('name');
            $t->text('description')->nullable();
            $t->string('unit')->default('unit');
            $t->bigInteger('unit_price_minor')->default(0);
            $t->boolean('enabled')->default(true);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('addons'); }
};