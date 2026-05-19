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
        Schema::create('contract_signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('contract_id')->constrained('contracts')->onDelete('cascade');
            $table->string('signer_role'); // e.g. 'Party A', 'Party B'
            $table->string('signer_identifier'); // email/phone
            $table->string('token_id')->unique()->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_signatures');
    }
};
