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
         /* 
            **leads sources
            * 1 => Internal
            * 2 => External
            */
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('lead_source')->default(1);
           
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->date('enquiry_date')->nullable();
            $table->integer('adult_count')->nullable();
            $table->date('travel_date')->nullable();
            $table->string('assisgned_to')->nullable();
            $table->text('remark')->nullable();
            $table->integer('lead_status')->default(1);
            $table->integer('soft_delete')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('leads');

    }
};
