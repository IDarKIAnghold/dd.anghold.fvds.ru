<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attachmentable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attachmentable_type');
            $table->unsignedInteger('attachmentable_id');
            $table->unsignedInteger('attachment_id')->index('attachment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachmentable');
    }
};
