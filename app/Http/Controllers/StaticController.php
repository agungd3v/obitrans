<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StaticController extends Controller
{
	public function home() {
		return view("welcome");
	}

	public function company() {
		return view("company");
	}

	public function testimonial() {
		return view("testimonial");
	}

	public function contact() {
		return view("contact");
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
