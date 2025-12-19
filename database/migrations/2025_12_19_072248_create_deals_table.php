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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->unsignedBigInteger('owner_id');
            $table->index('owner_id', 'deals_owner_id_idx');
            $table->foreign('owner_id', 'deals_owner_id_fk')->on('users')->references('id');
            $table->string('title');
            $table->decimal('amount', 12, 2);
            $table->string('status')->default('new');
            $table->date('expected_close_at');
            $table->dateTime('closed_at')->nullable();
            $table->string('lost_reason')->nullable();
            $table->string('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
