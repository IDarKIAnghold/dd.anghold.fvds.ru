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
        Schema::table('attachmentable', function (Blueprint $table) {
            $table->foreign(['attachment_id'], 'attachmentable_ibfk_1')->references(['id'])->on('attachments')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attachmentable', function (Blueprint $table) {
            $table->dropForeign('attachmentable_ibfk_1');
        });
    }
};
