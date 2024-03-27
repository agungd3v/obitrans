<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("cars", function (Blueprint $table) {
			$table->id();
			$table->string("label");
			$table->string("slug")->unique();
			$table->string("image");
			$table->string("fuel");
			$table->string("gear");
			$table->integer("capacity")->default(1);
			$table->double("price_per_day")->default(0);
			$table->unsignedBigInteger("branch_id");
			$table->unsignedBigInteger("type_id");
			$table->timestamps();

			$table->foreign("branch_id")->references("id")->on("branches")->onUpdate("cascade")->onDelete("cascade");
			$table->foreign("type_id")->references("id")->on("types")->onUpdate("cascade")->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("cars");
	}
};
