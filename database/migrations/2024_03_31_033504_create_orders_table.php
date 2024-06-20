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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->double('subtotal',10,2);

            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->string('notelp');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kodepos');

            $table->enum('status', ['pending', 'delivered', 'inprogress', 'canceled'])->default('pending');
            $table->timestamp('shipped_date')->nullable();
            $table->enum('metode', ['cod', 'transfer']);
            $table->enum('payment_status', ['paid', 'not paid'])->default('not paid');;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
