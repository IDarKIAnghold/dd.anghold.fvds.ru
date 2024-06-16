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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id')->nullable()->index('type_id');
            $table->unsignedBigInteger('manufacturer_id')->nullable()->index('manufacturer_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('content')->nullable();
            $table->longText('description')->nullable();
            $table->double('price')->nullable();
            $table->integer('discount');
            $table->integer('count')->nullable();
            $table->json('attachments')->nullable();
            $table->json('img')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
