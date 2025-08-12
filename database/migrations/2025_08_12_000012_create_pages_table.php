<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
  public function up(): void {
    if (!Schema::hasTable('pages')) {
      Schema::create('pages', function (Blueprint $t) {
        $t->id();
        $t->string('title');
        $t->string('slug')->unique();
        $t->longText('content');
        $t->boolean('is_published')->default(false);
        $t->json('meta')->nullable();
        $t->timestamps();
      });
    }
  }
  public function down(): void { Schema::dropIfExists('pages'); }
};