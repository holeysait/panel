<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('tariffs')) {
            Schema::create('tariffs', function (Blueprint $t) {
                $t->id();
                $t->string('name');
                $t->string('slug')->unique();
                $t->text('description')->nullable();
                $t->bigInteger('price_minor')->default(0);
                $t->string('currency',3)->default('USD');
                $t->string('period')->default('month'); // hour/day/month
                $t->integer('cpu_limit')->default(100);
                $t->integer('ram_mb')->default(1024);
                $t->integer('disk_gb')->default(10);
                $t->integer('ports')->default(1);
                $t->boolean('is_active')->default(true);
                $t->json('meta')->nullable();
                $t->timestamps();
            });
        } else {
            Schema::table('tariffs', function (Blueprint $t) {
                foreach ([
                    ['slug','string', ['unique'=>True]],
                    ['description','text', []],
                    ['price_minor','bigInteger', []],
                    ['currency','string', []],
                    ['period','string', []],
                    ['cpu_limit','integer', []],
                    ['ram_mb','integer', []],
                    ['disk_gb','integer', []],
                    ['ports','integer', []],
                    ['is_active','boolean', []],
                    ['meta','json', []],
                ] as $col) {
                    if (!Schema::hasColumn('tariffs', $col[0])) {
                        $name=$col[0]; $type=$col[1];
                        $t->{$type}($name)->nullable();
                    }
                }
            });
        }
    }
    public function down(): void {
        // safe: do nothing
    }
};
