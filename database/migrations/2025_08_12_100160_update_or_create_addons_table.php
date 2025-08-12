<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('addons')) {
            Schema::create('addons', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->string('code')->unique();
                $t->text('description')->nullable();
                $t->string('unit')->default('unit');
                $t->bigInteger('unit_price_minor')->default(0);
                $t->string('currency',3)->default('USD');
                $t->boolean('is_active')->default(true);
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        } else {
            Schema::table('addons', function (Blueprint $t) {
                if (!Schema::hasColumn('addons','code')) $t->string('code')->unique()->after('name');
                if (!Schema::hasColumn('addons','unit')) $t->string('unit')->default('unit')->after('description');
                if (!Schema::hasColumn('addons','unit_price_minor')) $t->bigInteger('unit_price_minor')->default(0)->after('unit');
                if (!Schema::hasColumn('addons','currency')) $t->string('currency',3)->default('USD')->after('unit_price_minor');
                if (!Schema::hasColumn('addons','is_active')) $t->boolean('is_active')->default(true)->after('currency');
                if (!Schema::hasColumn('addons','meta')) $t->json('meta')->nullable()->after('is_active');
            });
        }
    }
    public function down(): void {
        // keep data
    }
};
