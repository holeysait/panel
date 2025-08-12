<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('panel_notifications', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->text('body');
            $t->string('channel')->default('inapp'); // inapp|email
            $t->timestamp('scheduled_at')->nullable();
            $t->timestamp('sent_at')->nullable();
            $t->boolean('enabled')->default(true);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('panel_notifications'); }
};