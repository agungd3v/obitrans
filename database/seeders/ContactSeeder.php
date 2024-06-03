<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$contact_1 = new Contact();
		$contact_1->label = "Phone";
		$contact_1->value = "0212252542";
		$contact_1->save();

		$contact_1 = new Contact();
		$contact_1->label = "Mobile";
		$contact_1->value = "08521252511";
		$contact_1->save();

		$contact_1 = new Contact();
		$contact_1->label = "Whatsapp";
		$contact_1->value = "08521252511";
		$contact_1->save();

		$contact_1 = new Contact();
		$contact_1->label = "Email";
		$contact_1->value = "cs@obitrans.co.id";
		$contact_1->save();
	}
}
