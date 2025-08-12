<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('locations', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('code')->unique();
            $t->string('country')->nullable();
            $t->string('city')->nullable();
            $t->boolean('enabled')->default(true);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('locations'); }
};