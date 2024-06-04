<?php

namespace App\Http\Controllers;

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
use Yajra\DataTables\Facades\DataTables;

class StaticController extends Controller
{
	public function home() {
		$services = Service::all();

		return view("welcome", compact("services"));
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
}
