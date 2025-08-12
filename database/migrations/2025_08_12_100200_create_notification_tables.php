<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('notification_campaigns')) {
            Schema::create('notification_campaigns', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->string('channel')->default('inapp'); // inapp, email
                $t->string('subject')->nullable();
                $t->longText('body')->nullable();
                $t->json('filters')->nullable(); // JSON of criteria for recipients
                $t->timestamp('scheduled_at')->nullable();
                $t->string('status')->default('draft'); // draft, scheduled, sent, canceled
                $t->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
                $t->timestamps();
            });
        }
        if (!Schema::hasTable('notification_deliveries')) {
            Schema::create('notification_deliveries', function (Blueprint $t) {
                $t->id();
                $t->foreignId('campaign_id')->constrained('notification_campaigns')->cascadeOnDelete();
                $t->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $t->string('status')->default('pending'); // pending, sent, failed
                $t->timestamp('sent_at')->nullable();
                $t->text('error')->nullable();
                $t->timestamps();
                $t->index(['campaign_id','status']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_deliveries');
        Schema::dropIfExists('notification_campaigns');
    }
};
