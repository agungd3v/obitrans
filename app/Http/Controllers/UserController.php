<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Car;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\SocialMedia;
use App\Models\Testimonial;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
  public function dashboard() {
		return view("user.dashboard");
	}

	public function car() {
		$types = Type::all();
		return view("user.car", compact("types"));
	}

	public function dataCar(Request $request) {
		$cars = Car::with("type")->get();

		return DataTables::of($cars)->toJson();
	}

	public function showCar(Request $request, $id) {
		$car = Car::where("id", $id)->first();
		return response()->json(["data" => $car]);
	}

	public function updateCar(Request $request) {
		try {
			DB::beginTransaction();

			$type = Type::where("id", $request->rent_update)->first();
			if (!$type) throw new \Exception("Error, sewa hanya untuk harian atau corporate saja!");

			$car = Car::where("id", $request->rent_id)->first();
			if (!$car) throw new \Exception("Error, data unit tidak ditemukan!");

			$car->label = $request->label_update;
			$car->slug = Str::slug($request->label_update);
			$car->gear = $request->gear_update;
			$car->fuel = $request->fuel_update;
			$car->capacity = $request->capacity_update;
			$car->type_id = $type->id;
			$car->branch_id = $type->id == 1 ? 1 : 2; // 1 untuk jakarta, 2 untuk bali
			$car->price_per_day = $type->id == 1 ? 0 : $request->price_update;
			$car->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah data unit!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function storeCar(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			$type = Type::where("id", $request->rent)->first();
			if (!$type) throw new \Exception("Error, sewa hanya untuk harian atau corporate saja!");

			if ($request->hasFile("image")) {
				$ext = $request->file("image")->extension();
				$imgName = date("dmyHis") ."_". date("His") .".". $ext;
				$this->validate($request, ["image" => "file|image|max:2048"]);

				$request->file("image")->move("cars", $imgName);
			}

			$car = new Car();
			$car->label = $request->label;
			$car->slug = Str::slug($request->label) . "_" . time();
			$car->gear = $request->gear;
			$car->fuel = $request->fuel;
			$car->capacity = $request->capacity;
			$car->type_id = $type->id;
			$car->branch_id = $type->id == 1 ? 1 : 2; // 1 untuk jakarta, 2 untuk bali
			$car->price_per_day = $type->id == 1 ? 0 : $request->price;
			$car->image = "cars/". $imgName;
			$car->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menambahkan unit baru!");
		} catch (\Exception $e) {
			if (File::exists(public_path("cars/". $imgName))) {
				File::delete(public_path("cars/". $imgName));
			}

			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function changePhotoCar(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			$car = Car::where("id", $request->id)->first();
			if (!$car) throw new \Exception("Data mobil tidak ditemukan!");

			if ($request->hasFile("new-photo")) {
				$ext = $request->file("new-photo")->extension();
				$imgName = date("dmyHis") ."_". date("His") .".". $ext;
				$this->validate($request, ["new-photo" => "file|image|max:2048"]);

				$request->file("new-photo")->move("cars", $imgName);
			}

			if (File::exists(public_path($car->image))) {
				File::delete(public_path($car->image));
			}

			$car->image = "cars/". $imgName;
			$car->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah foto!");
		} catch (\Exception $e) {
			if (File::exists(public_path("cars/". $imgName))) {
				File::delete(public_path("cars/". $imgName));
			}

			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function deleteCar(Request $request) {
		try {
			DB::beginTransaction();

			$car = Car::where("id", $request->id)->first();
			if (!$car) throw new \Exception("Data mobil tidak ditemukan!");

			if (File::exists(public_path($car->image))) {
				File::delete(public_path($car->image));
			}

			$car->delete();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil melakukan penghapusan data!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function gallery() {
		$galleries = Gallery::all();
		return view("user.gallery", compact("galleries"));
	}

	public function dataGallery(Request $request) {
		$galleries = Gallery::all();

		return DataTables::of($galleries)->toJson();
	}

	public function storeGallery(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			$gallery = new Gallery();
			$gallery->label = Str::uuid();

			if ($request->hasFile("image")) {
				$ext = $request->file("image")->extension();
				$imgName = date("dmyHis") ."_". date("His") .".". $ext;
				$this->validate($request, ["image" => "file|image|max:2048"]);

				$request->file("image")->move("galleries", $imgName);
			}

			$gallery->path = "galleries/". $imgName;
			$gallery->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menambah gambar pada gallery");
		} catch (\Exception $e) {
			if (File::exists(public_path("galleries/". $imgName))) {
				File::delete(public_path("galleries/". $imgName));
			}

			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function testimonial() {
		return view("user.testimonial");
	}

	public function testimonialData(Request $request) {
		$testimonials = Testimonial::orderBy("id", "desc")->get();

		return DataTables::of($testimonials)->toJson();
	}

	public function testimonialStore(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			if ($request->hasFile("author_image")) {
				$ext = $request->file("author_image")->extension();
				$imgName = date("dmyHis") ."_". date("His") .".". $ext;
				$this->validate($request, ["author_image" => "file|image|max:2048"]);

				$request->file("author_image")->move("author", $imgName);
			}

			$car = new Testimonial();
			$car->author_name = $request->author_name;
			$car->author_image = $imgName == "" ? null : "author/". $imgName;
			$car->content = $request->content;
			$car->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menambahkan testimonial baru!");
		} catch (\Exception $e) {
			if (File::exists(public_path("author/". $imgName))) {
				File::delete(public_path("author/". $imgName));
			}

			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function contact() {
		return view("user.contact");
	}

	public function contactData(Request $request) {
		$contacts = Contact::all();

		return DataTables::of($contacts)->toJson();
	}

	public function showContact(Request $request, $id) {
		$contact = Contact::where("id", $id)->first();
		return response()->json(["data" => $contact]);
	}

	public function updateContact(Request $request) {
		try {
			DB::beginTransaction();

			$contact = Contact::where("id", $request->contact_id)->first();
			$contact->value = $request->contact_value;
			$contact->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah data contact!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function social() {
		return view("user.social");
	}

	public function socialData(Request $request) {
		$social = SocialMedia::all();

		return DataTables::of($social)->toJson();
	}

	public function showSocial(Request $request, $id) {
		$social = SocialMedia::where("id", $id)->first();
		return response()->json(["data" => $social]);
	}

	public function updateSocial(Request $request) {
		try {
			DB::beginTransaction();

			$social = SocialMedia::where("id", $request->social_id)->first();
			$social->value = $request->social_value;
			$social->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah data sosial media!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function service() {
		return view("user.service");
	}

	public function serviceData(Request $request) {
		$services = Service::all();

		return DataTables::of($services)->toJson();
	}

	public function showService(Request $request, $id) {
		$service = Service::where("id", $id)->first();
		return response()->json(["data" => $service]);
	}

	public function updateService(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			$service = Service::where("id", $request->id)->first();
			$service->title = $request->title;
			$service->content = $request->content;
			$service->save();

			if ($request->hasFile("image_icon")) {
				$ext = $request->file("image_icon")->extension();
				$imgName = date("dmyHis") ."_". date("His") .".". $ext;
				$this->validate($request, ["image_icon" => "file|image|max:2048"]);
				$request->file("image_icon")->move("services", $imgName);

				$service->image_icon = "services/". $imgName;
				$service->save();
			}

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah data sosial media!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function banner() {
		return view("user.banner");
	}

	public function bannerData(Request $request) {
		$banners = Banner::all();

		return DataTables::of($banners)->toJson();
	}

	public function storeBanner(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			if (!$request->hasFile("banner_image")) throw new \Exception("Gambar tidak boleh kosong");

			$banner = new Banner();

			$ext = $request->file("banner_image")->extension();
			$imgName = date("dmyHis") ."_". date("His") .".". $ext;
			$this->validate($request, ["banner_image" => "file|image|max:2048"]);
			$request->file("banner_image")->move("banners", $imgName);

			$banner->banner_image = "banners/". $imgName;
			$banner->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menambah data banner!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function showBanner(Request $request, $id) {
		$banner = Banner::where("id", $id)->first();
		return response()->json(["data" => $banner]);
	}

	public function bannerUpdate(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			if (!$request->hasFile("banner_image")) throw new \Exception("Gambar tidak boleh kosong");

			$banner = Banner::where("id", $request->id)->first();

			if (File::exists(public_path($banner->banner_image))) {
				File::delete(public_path($banner->banner_image));
			}

			$ext = $request->file("banner_image")->extension();
			$imgName = date("dmyHis") ."_". date("His") .".". $ext;
			$this->validate($request, ["banner_image" => "file|image|max:2048"]);
			$request->file("banner_image")->move("banners", $imgName);

			$banner->banner_image = "banners/". $imgName;
			$banner->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah banner!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function deleteBanner(Request $request) {
		try {
			DB::beginTransaction();

			$banner = Banner::where("id", $request->id)->first();

			if (File::exists(public_path($banner->banner_image))) {
				File::delete(public_path($banner->banner_image));
			}

			$banner->delete();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menghapus banner!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}
}
