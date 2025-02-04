<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('score')->default(100)->change(); // Modification de la valeur par défaut
        });
    }

    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('score')->default(0)->change(); // Revenir à 0 si rollback
        });
    }
};
