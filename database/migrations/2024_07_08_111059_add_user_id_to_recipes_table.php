<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddUserIdToRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Add user_id column
            $table->unsignedBigInteger('user_id')->after('id');

            // Optionally, add a foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Check if the foreign key exists before attempting to drop it
            $foreignKeys = DB::select(DB::raw('SHOW KEYS FROM recipes WHERE Key_name = "recipes_user_id_foreign"'));

            if (!empty($foreignKeys)) {
                $table->dropForeign(['user_id']);
            }

            // Drop the user_id column
            if (Schema::hasColumn('recipes', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
}
