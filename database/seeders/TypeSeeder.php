<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$types = ["Corporate", "Harian"];
		foreach ($types as $key => $type) {
			$a = new Type();
			$a->label = $type;
			$a->slug = Str::slug($type);
			$a->save();
		}
	}
}
