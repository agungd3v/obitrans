<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call([
			BranchSeeder::class,
			TypeSeeder::class,
			TestimonialSeeder::class,
			ContactSeeder::class,
			SocialMediaSeeder::class,
			ServiceSeeder::class,
			BannerSeeder::class,
			SlideSeeder::class,
			QnaSeeder::class,
			UserSeeder::class
		]);
	}
}
