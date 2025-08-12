<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
  public function up(): void {
    if (!Schema::hasTable('settings')) {
      Schema::create('settings', function (Blueprint $t) {
        $t->id();
        $t->string('key')->unique();
        $t->text('value')->nullable();
        $t->string('type')->default('string'); // string, bool, int, json, secret
        $t->json('meta')->nullable();
        $t->timestamps();
      });
    }
  }
  public function down(): void { Schema::dropIfExists('settings'); }
};