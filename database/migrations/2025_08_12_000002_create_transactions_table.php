<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('transactions', function (Blueprint $t) {
            $t->id();
            $t->foreignId('wallet_id')->constrained();
            $t->string('type');
            $t->bigInteger('amount_minor');
            $t->json('meta')->nullable();
            $t->timestamps();
            $t->index(['wallet_id','created_at']);
        });
    }
    public function down(): void { Schema::dropIfExists('transactions'); }
};