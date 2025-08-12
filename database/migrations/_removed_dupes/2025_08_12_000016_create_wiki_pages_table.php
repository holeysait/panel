<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('wiki_pages', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('slug')->unique();
            $t->text('body');
            $t->boolean('published')->default(false);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('wiki_pages'); }
};