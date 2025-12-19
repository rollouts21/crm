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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->index('owner_id', 'clients_owner_id_idx');
            $table->foreign('owner_id', 'clients_owner_id_fk')->on('users')->references('id');
            $table->foreignId('source_id')->constrained();
            $table->string('status')->default('new');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->text('note')->nullable();
            $table->dateTime('last_contact_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
