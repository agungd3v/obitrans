<?php

namespace App\Http\Controllers;

use App\Mail\MyEmail;
use App\Models\Banner;
use App\Models\Car;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\QuestionAnswer;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Testimonial;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class StaticController extends Controller
{
	public function home() {
		$services = Service::all();
		$baners = Banner::all();

		return view("welcome", compact("services", "baners"));
	}

	public function company() {
		$slides = Slider::all();
		$services = Service::all();
		$qna = QuestionAnswer::all();

		return view("company", compact("services", "qna", "slides"));
	}

	public function testimonial() {
		$testimonials = Testimonial::all();
		$galleries = Gallery::all();

		return view("testimonial", compact("testimonials", "galleries"));
	}

	public function contact() {
		$contacts = Contact::all();
		$socials = SocialMedia::all();

		return view("contact", compact("contacts", "socials"));
	}

	public function rent(Request $request, $type) {
		$type = Type::where("slug", $type)->first();
		if (!$type) abort(404);

		return view("rent", compact("type"));
	}

	public function rentData(Request $request) {
		$cars = Car::where("type_id", $request->type)->orderBy("id", "desc")->get();

		return DataTables::of($cars)->toJson();
	}

	public function sendEmail(Request $request) {
		try {
			Mail::to("agungd3v@gmail.com")->send(
				new MyEmail($request->companyName, $request->phone, $request->email, $request->message)
			);
			
			return response()->json(["message" => "Terimakasih, kami akan secepatnya merespon pertanyaan anda"]);
		} catch (\Exception $e) {
			return response()->json(["message" => $e->getMessage()], 400);
		}
	}

	public function unit() {
		$cars = Car::where("type_id", 1)->get();

		return view("unit", compact("cars"));
	}
}
