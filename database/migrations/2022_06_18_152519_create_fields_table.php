<?php

use App\Models\Field;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', Field::$default_types);
            $table->foreignId('subscriber_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fields');
    }
}