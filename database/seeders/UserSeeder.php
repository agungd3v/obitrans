<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = new User();
		$user->name = "Administrator";
		$user->email = "admin@obitrans.co.id";
		$user->password = Hash::make("admin");
		$user->email_verified_at = Carbon::now();
		$user->remember_token = time();
		$user->save();
	}
}
