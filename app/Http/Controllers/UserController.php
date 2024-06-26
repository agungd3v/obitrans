<?php

namespace App\Http\Controllers;

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

	public function deleteGallery(Request $request) {
		try {
			DB::beginTransaction();

			$galleries = Gallery::where("id", $request->id)->first();

			if (File::exists(public_path($galleries->path))) {
				File::delete(public_path($galleries->path));
			}

			$galleries->delete();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menghapus gambar!");
		} catch (\Exception $e) {
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

	public function testimonialShow(Request $request, $id) {
		$testi = Testimonial::where("id", $id)->first();

		return response()->json(["data" => $testi]);
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

	public function updateTestimonial(Request $request) {
		try {
			DB::beginTransaction();

			$testi = Testimonial::where("id", $request->id)->first();
			if (!$testi) throw new \Exception("Error, testimonial not found!");

			$testi->author_name = $request->author_name;
			$testi->content = $request->content;
			$testi->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah testimonial!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function testimonialDelete(Request $request) {
		try {
			DB::beginTransaction();

			$testi = Testimonial::where("id", $request->id)->first();

			if (File::exists(public_path($testi->author_image))) {
				File::delete(public_path($testi->author_image));
			}

			$testi->delete();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menghapus testimonial!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function contact() {
		return view("user.contact");
	}

	public function contactStore(Request $request) {
		try {
			DB::beginTransaction();

			$contact = new Contact();
			$contact->label = $request->label;
			$contact->zone = $request->zone;
			$contact->value = $request->value;
			$contact->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menambah kontak!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
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
			$contact->zone = $request->contact_zone;
			$contact->value = $request->contact_value;
			$contact->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah data contact!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function deleteContact(Request $request) {
		try {
			DB::beginTransaction();

			$contact = Contact::where("id", $request->id)->first();
			if (!$contact) throw new \Exception("Error, kontak tidak ditemukan!");

			$contact->delete();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menghapus kontak!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function social() {
		return view("user.social");
	}

	public function socialStore(Request $request) {
		try {
			DB::beginTransaction();

			$social = new SocialMedia();
			$social->label = $request->label;
			$social->value = $request->value;
			$social->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menambahkan sosial media");
		} catch (\Exception $e) {
			DB::beginTransaction();
			return redirect()->back()->with("error", $e->getMessage());
		}
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

	public function deleteSocial(Request $request) {
		try {
			DB::beginTransaction();

			$social = SocialMedia::where("id", $request->id)->first();
			if (!$social) throw new \Exception("Error, social media tidak ditemukan!");

			$social->delete();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menghapus sosial media!");
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

	public function company() {
		return view("user.company");
	}

	public function storeComapny(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			if (!$request->hasFile("company_image")) throw new \Exception("Gambar tidak boleh kosong");

			$slider = new Slider();

			$ext = $request->file("company_image")->extension();
			$imgName = date("dmyHis") ."_". date("His") .".". $ext;
			$this->validate($request, ["company_image" => "file|image|max:2048"]);
			$request->file("company_image")->move("company", $imgName);

			$slider->slide_image = "company/". $imgName;
			$slider->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menambah data gambar!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function updateCompany(Request $request) {
		$imgName = "";

		try {
			DB::beginTransaction();

			if (!$request->hasFile("slide_image")) throw new \Exception("Gambar tidak boleh kosong");

			$slider = Slider::where("id", $request->id)->first();

			if (File::exists(public_path($slider->slide_image))) {
				File::delete(public_path($slider->slide_image));
			}

			$ext = $request->file("slide_image")->extension();
			$imgName = date("dmyHis") ."_". date("His") .".". $ext;
			$this->validate($request, ["slide_image" => "file|image|max:2048"]);
			$request->file("slide_image")->move("company", $imgName);

			$slider->slide_image = "company/". $imgName;
			$slider->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah gambara!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function deleteCompany(Request $request) {
		try {
			DB::beginTransaction();

			$slider = Slider::where("id", $request->id)->first();

			if (File::exists(public_path($slider->slide_image))) {
				File::delete(public_path($slider->slide_image));
			}

			$slider->delete();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil menghapus gambar!");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}

	public function companySlideData() {
		$data = Slider::all();

		return DataTables::of($data)->toJson();
	}

	public function qna() {
		return view("user.qna");
	}

	public function qnaData() {
		$data = QuestionAnswer::all();

		return DataTables::of($data)->toJson();
	}

	public function showQna(Request $request, $id) {
		$data = QuestionAnswer::where("id", $id)->first();
		return response()->json(["data" => $data]);
	}

	public function updateQna(Request $request) {
		try {
			DB::beginTransaction();

			$qna = QuestionAnswer::where("id", $request->id)->first();
			if (!$qna) throw new \Exception("Error");

			$qna->question = $request->question;
			$qna->answer = $request->answer;
			$qna->save();

			DB::commit();
			return redirect()->back()->with("success", "Berhasil mengubah QnA");
		} catch (\Exception $e) {
			DB::rollBack();
			return redirect()->back()->with("error", $e->getMessage());
		}
	}
}
