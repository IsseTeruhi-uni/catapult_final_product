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
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // 閲覧者のユーザーID
            $table->unsignedBigInteger('viewed_user_id'); // 閲覧されたユーザーのID
            $table->timestamp('viewed_at')->useCurrent(); // 閲覧日時
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('viewed_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_histories');
    }
};
