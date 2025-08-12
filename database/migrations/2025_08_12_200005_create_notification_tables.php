<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('notification_campaigns')) {
            Schema::create('notification_campaigns', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->enum('channel',['inapp','email'])->default('inapp');
                $t->string('subject')->nullable();
                $t->longText('body');
                $t->enum('status',['draft','scheduled','canceled'])->default('draft');
                $t->timestamp('scheduled_at')->nullable();
                $t->json('filters')->nullable();
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        }
        if (!Schema::hasTable('notification_deliveries')) {
            Schema::create('notification_deliveries', function (Blueprint $t) {
                $t->id();
                $t->foreignId('campaign_id')->constrained('notification_campaigns')->onDelete('cascade');
                $t->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $t->string('channel',16);
                $t->string('status',16)->default('pending');
                $t->text('error')->nullable();
                $t->timestamps();
            });
        }
    }
    public function down(): void {
        Schema::dropIfExists('notification_deliveries');
        Schema::dropIfExists('notification_campaigns');
    }
};
