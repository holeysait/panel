<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('wallets', function (Blueprint $t) {
            $t->id();
            $t->morphs('owner');
            $t->string('currency', 3)->default('USD');
            $t->bigInteger('balance_minor')->default(0);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('wallets'); }
};