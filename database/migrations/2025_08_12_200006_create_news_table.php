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
                $t->string('excerpt',500)->nullable();
                $t->longText('body');
                $t->boolean('is_published')->default(false);
                $t->timestamp('published_at')->nullable();
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        }
    }
    public function down(): void { Schema::dropIfExists('news'); }
};
