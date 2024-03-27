<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BranchSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$branches = ["Jakarta", "Bali"];

		foreach ($branches as $key => $value) {
			$branch = new Branch();
			$branch->label = $value;
			$branch->slug = Str::slug($value);
			$branch->save();
		}
	}
}
