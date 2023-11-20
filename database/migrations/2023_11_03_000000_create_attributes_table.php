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
            $table->string('name');
            $table->string('code')->unique();
            $table->string('type');

            $table->timestamps();
        });

        // TODO: for entity + attributes relation

        Schema::create('attribute_scalar_values', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('entity_id');
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->string('attribute_type');
            $table->string('attribute_code')->unique();

            $table->string('text_value')->nullable();
            $table->unsignedBigInteger('integer_value')->nullable();

            $table->timestamps();

            $table->unique(['entity_id', 'attribute_id'], 'attribute_scalar_values_entity_id_attribute_id_unique');
        });

        Schema::create('attribute_enum_values', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('entity_id');
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->string('attribute_type');
            $table->string('attribute_code')->unique();

            $table->jsonb('json_value')->nullable();

            $table->timestamps();

            $table->unique(['entity_id', 'attribute_id'], 'attribute_enum_values_entity_id_attribute_id_unique');
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
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('entities');
    }
};
