<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attributes', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('type');

            $table->timestamps();
        });

        Schema::create('attribute_value_collections', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('attribute_value_collection_entity', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->foreignId('attribute_value_collection_id')
                ->constrained('attribute_value_collections', 'id', 'entity_attribute_value_collection_id_foreign')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('attribute_scalar_values', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_value_collection_id')->constrained()->onDelete('cascade');
            $table->string('text_value')->nullable();
            $table->unsignedBigInteger('integer_value')->nullable();

            $table->timestamps();
        });

        Schema::create('attribute_enum_values', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_value_collection_id')->constrained()->onDelete('cascade');

            $table->string('enum_code')->nullable();
            $table->unsignedBigInteger('enum_id')->nullable();

            $table->timestamps();
        });

        Schema::create('attribute_catalog_values', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_value_collection_id')->constrained()->onDelete('cascade');

            $table->string('catalog_id')->nullable();
            $table->unsignedBigInteger('catalog_element_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_catalog_values');
        Schema::dropIfExists('attribute_enum_values');
        Schema::dropIfExists('attribute_scalar_values');
        Schema::dropIfExists('attribute_value_collections');
        Schema::dropIfExists('attribute_value_collection_entity');
        Schema::dropIfExists('attributes');
    }
};
