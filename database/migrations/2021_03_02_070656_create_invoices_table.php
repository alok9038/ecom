<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_documents', function (Blueprint $table) {
            $table->id();
            $table->text('invoice_url')->nullable();
            $table->text('label_url')->nullable();
            $table->text('manifest_url')->nullable();
            $table->foreignId('order_id')->constrained('order_items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
