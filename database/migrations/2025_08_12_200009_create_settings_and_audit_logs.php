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
            });
        }
        if (!Schema::hasTable('audit_logs')) {
            Schema::create('audit_logs', function (Blueprint $t) {
                $t->id();
                $t->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $t->string('action');
                $t->string('model')->nullable();
                $t->unsignedBigInteger('model_id')->nullable();
                $t->string('ip',45)->nullable();
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        }
        if (!Schema::hasColumn('users','is_admin')) {
            Schema::table('users', function (Blueprint $t) {
                $t->boolean('is_admin')->default(false)->after('password');
            });
        }
    }
    public function down(): void {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('settings');
    }
};
