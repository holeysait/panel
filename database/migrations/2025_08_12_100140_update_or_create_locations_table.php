<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('locations')) {
            Schema::create('locations', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->string('slug')->unique();
                $t->string('country', 2)->nullable();
                $t->string('city')->nullable();
                $t->boolean('is_active')->default(true);
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        } else {
            Schema::table('locations', function (Blueprint $t) {
                if (!Schema::hasColumn('locations','slug')) $t->string('slug')->unique()->after('name');
                if (!Schema::hasColumn('locations','country')) $t->string('country',2)->nullable()->after('slug');
                if (!Schema::hasColumn('locations','city')) $t->string('city')->nullable()->after('country');
                if (!Schema::hasColumn('locations','is_active')) $t->boolean('is_active')->default(true)->after('city');
                if (!Schema::hasColumn('locations','meta')) $t->json('meta')->nullable()->after('is_active');
            });
        }
    }
    public function down(): void {
        // Keep data; do not drop table in down to be safe
    }
};
