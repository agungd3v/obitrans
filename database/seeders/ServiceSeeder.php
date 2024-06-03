<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$service_1 = new Service();
		$service_1->image_icon = "services/service_1.png";
		$service_1->title = "Program Kepemilikan Mobil";
		$service_1->content = "Kami juga melayani kebutuhan perusahaan untuk program kepemilikan mobil bagi staff perusahaan anda. Program kami di design untuk membantu perusahaan anda dalam menjalankan program COP (Car Ownership Prgram)";
		$service_1->save();

		$service_2 = new Service();
		$service_2->image_icon = "services/service_2.png";
		$service_2->title = "Layanan 24 Jam";
		$service_2->content = "Kami siap untuk melayani anda kapanpun anda memerlukan kami.";
		$service_2->save();

		$service_3 = new Service();
		$service_3->image_icon = "services/service_3.png";
		$service_3->title = "Jaringan Bengkel";
		$service_3->content = "Memiliki jaringan bengkel yang mencakup seluruh wilayah Indonesia.";
		$service_3->save();

		$service_4 = new Service();
		$service_4->image_icon = "services/service_4.png";
		$service_4->title = "Mobil Pengganti";
		$service_4->content = "Disaat mobil anda tidak dapat digunakan, baik itu kecelakaan ataupun perbaikan, kami menyediakan mobil pengganti sementara yang bisa digunakan sehingga kegiatan perusahaan anda tidak terganggu.";
		$service_4->save();
	}
}
