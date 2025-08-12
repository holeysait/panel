<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
  public function up(): void {
    if (!Schema::hasTable('news')) {
      Schema::create('news', function (Blueprint $t) {
        $t->id();
        $t->string('title');
        $t->string('slug')->unique();
        $t->text('excerpt')->nullable();
        $t->longText('content');
        $t->boolean('is_published')->default(false);
        $t->timestamp('published_at')->nullable();
        $t->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
        $t->json('meta')->nullable();
        $t->timestamps();
      });
    }
  }
  public function down(): void { Schema::dropIfExists('news'); }
};