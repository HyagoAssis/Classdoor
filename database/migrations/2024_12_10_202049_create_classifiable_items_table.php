<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classifiable_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('classification_type_id')->index();
            $table->foreignId('created_by')->constrained(table: 'users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifiable_items');
    }
};
