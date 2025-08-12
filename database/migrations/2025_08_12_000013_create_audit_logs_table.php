<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
  public function up(): void {
    if (!Schema::hasTable('audit_logs')) {
      Schema::create('audit_logs', function (Blueprint $t) {
        $t->id();
        $t->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
        $t->string('action');
        $t->string('target_type')->nullable();
        $t->unsignedBigInteger('target_id')->nullable();
        $t->json('meta')->nullable();
        $t->timestamp('created_at')->useCurrent();
      });
    }
  }
  public function down(): void { Schema::dropIfExists('audit_logs'); }
};