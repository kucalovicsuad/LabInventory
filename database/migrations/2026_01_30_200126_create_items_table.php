<?php

use App\Models\Category;
use App\Models\Location;
use App\Models\Manufacturer;
use App\Models\Unit;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('serial_number')->unique()->nullable();
            $table->string('model')->nullable();
            $table->double('value')->nullable();
            $table->string('unit')->nullable();
            $table->integer('quantity');
            $table->integer('minimal_quantity');
            $table->text('description')->nullable();
            $table->string('picture')->unique()->nullable();
            $table->string('datasheet')->unique()->nullable();
            $table->foreignIdFor(Unit::class)
                ->nullable()
                ->constrained('units')
                ->nullOnDelete();
            $table->foreignIdFor(Category::class)
                ->constrained('categories')
                ->cascadeOnDelete();
            $table->foreignIdFor(Location::class)
                ->constrained('locations')
                ->cascadeOnDelete();
            $table->foreignIdFor(Manufacturer::class)
                ->nullable()
                ->constrained('manufacturers')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
