<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$testi_1 = new Testimonial();
		$testi_1->author_name = "Lorem Ipsum";
		$testi_1->content = "viverra dolor nulla, odio sed orci nisi quis sapien odio nisi ultrices sit felis, gravida facilisis sit Vestibulum sed Vestibulum Sed facilisis tortor. sapien ipsum venenatis ex eu adipiscing porta volutpat faucibus urna. libero, quam volutpat lacus, tortor. placerat lorem.";
		$testi_1->save();

		$testi_2 = new Testimonial();
		$testi_2->author_name = "Lorem Ipsum";
		$testi_2->content = "viverra dolor nulla, odio sed orci nisi quis sapien odio nisi ultrices sit felis, gravida facilisis sit Vestibulum sed Vestibulum Sed facilisis tortor. sapien ipsum venenatis ex eu adipiscing porta volutpat faucibus urna. libero, quam volutpat lacus, tortor. placerat lorem.";
		$testi_2->save();

		$testi_3 = new Testimonial();
		$testi_3->author_name = "Lorem Ipsum";
		$testi_3->content = "viverra dolor nulla, odio sed orci nisi quis sapien odio nisi ultrices sit felis, gravida facilisis sit Vestibulum sed Vestibulum Sed facilisis tortor. sapien ipsum venenatis ex eu adipiscing porta volutpat faucibus urna. libero, quam volutpat lacus, tortor. placerat lorem.";
		$testi_3->save();

		$testi_4 = new Testimonial();
		$testi_4->author_name = "Lorem Ipsum";
		$testi_4->content = "viverra dolor nulla, odio sed orci nisi quis sapien odio nisi ultrices sit felis, gravida facilisis sit Vestibulum sed Vestibulum Sed facilisis tortor. sapien ipsum venenatis ex eu adipiscing porta volutpat faucibus urna. libero, quam volutpat lacus, tortor. placerat lorem.";
		$testi_4->save();
	}
}
