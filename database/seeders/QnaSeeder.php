<?php

namespace Database\Seeders;

use App\Models\QuestionAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QnaSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$qna_1 = new QuestionAnswer();
		$qna_1->question = "Apa yang bisa kami berikan kepada pelanggan?";
		$qna_1->answer = "Perusahaan kami dibangun dengan 3 nilai utama: kemudahan, kecepatan, dan kepuasan pelanggan. Kami selalu memprioritaskan pelanggan untuk membantu perusahaan Anda dalam menjalankan tugas.";
		$qna_1->save();

		$qna_2 = new QuestionAnswer();
		$qna_2->question = "Apa rencana kami kedepan sebagai perusahaan?";
		$qna_2->answer = "Mengembangkan dan menjaga kualitas pelayanan adalah kunci dari perkembangan perusahaan kami. Kami selalu menjaga standar etika dan legalitas dalam semua proses bisnis. Kami percaya bahwa kami dapat memberikan pelayanan terbaik kepada pelanggan dan tidak akan pernah berhenti melakukan inovasi seiring perkembangan zaman.";
		$qna_2->save();

		$qna_3 = new QuestionAnswer();
		$qna_3->question = "Apakah ada perwakilan khusus bagi perusahaan Anda?";
		$qna_3->answer = "Setiap pelanggan kami akan mendapat perwakilan khusus untuk segala kebutuhan. Kami berkomitmen untuk memberikan pelayanan terbaik bagi perusahaan Anda.";
		$qna_3->save();
	}
}
