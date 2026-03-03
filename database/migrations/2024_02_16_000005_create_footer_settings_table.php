<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('copyright')->nullable();
            $table->json('social_links')->nullable(); // facebook, instagram, whatsapp, tiktok
            $table->timestamps();
        });

        DB::table('footer_settings')->insert([
            'id' => 1,
            'copyright' => '© ' . date('Y') . ' ' . config('app.name') . '. Todos os direitos reservados.',
            'social_links' => json_encode([
                'facebook' => '',
                'instagram' => '',
                'whatsapp' => '',
                'tiktok' => '',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
