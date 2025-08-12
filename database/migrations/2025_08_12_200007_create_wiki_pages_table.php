<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('wiki_pages')) {
            Schema::create('wiki_pages', function (Blueprint $t) {
                $t->id();
                $t->string('title');
                $t->string('slug')->unique();
                $t->longText('body');
                $t->string('tags')->nullable();
                $t->boolean('is_published')->default(false);
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        }
    }
    public function down(): void { Schema::dropIfExists('wiki_pages'); }
};
