<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_settings', function (Blueprint $table) {
            $table->id();
            $table->json('page_order')->nullable(); // array of page ids in display order
            $table->boolean('show_dashboard_link')->default(true);
            $table->timestamps();
        });

        // Registro padrão
        DB::table('menu_settings')->insert([
            'id' => 1,
            'page_order' => json_encode([]),
            'show_dashboard_link' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_settings');
    }
};
