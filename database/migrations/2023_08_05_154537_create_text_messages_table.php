<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('text_message_details', function (Blueprint $table) {
            $table->id();
            $table->text("body");

            $table
                ->foreignId("message_id")
                ->references("id")
                ->on("messages");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_message_details');
    }
};