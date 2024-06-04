<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", [StaticController::class, "home"]);
Route::get("companys", [StaticController::class, "company"]);
Route::get("testimonial", [StaticController::class, "testimonial"]);
Route::get("contact", [StaticController::class, "contact"]);
Route::get("rent/{type}", [StaticController::class, "rent"]);
Route::post("rent/data", [StaticController::class, "rentData"]);

Route::get("login", [AuthController::class, "loginPage"])->name("login");
Route::post("login", [AuthController::class, "login"])->name("login.post");
Route::get("logout", [AuthController::class, "logout"])->name("logout");

Route::group(["prefix" => "user", "middleware" => ["auth"]], function() {
	Route::get("", fn() => redirect()->route("dashboard"));
	Route::get("dashboard", [UserController::class, "dashboard"])->name("dashboard");
	Route::get("car", [UserController::class, "car"])->name("car");
	Route::post("car", [UserController::class, "storeCar"])->name("car.store");
	Route::get("car/data", [UserController::class, "dataCar"])->name("car.data");
	Route::post("car/image/change", [UserController::class, "changePhotoCar"])->name("car.change.image");
	Route::delete("car/delete", [UserController::class, "deleteCar"])->name("car.delete");
	Route::get("car/show/{id}", [UserController::class, "showCar"])->name("car.show");
	Route::put("car/update", [UserController::class, "updateCar"])->name("car.update");
	Route::get("gallery", [UserController::class, "gallery"])->name("gallery");
	Route::get("gallery/data", [UserController::class, "dataGallery"])->name("gallery.data");
	Route::post("gallery", [UserController::class, "storeGallery"])->name("gallery.store");
	Route::get("testimonial", [UserController::class, "testimonial"])->name("testimonial");
	Route::get("testimonial/data", [UserController::class, "testimonialData"])->name("testimonial.data");
	Route::post("testimonial", [UserController::class, "testimonialStore"])->name("testimonial.store");
	Route::delete("testimonial", [UserController::class, "testimonialDelete"])->name("testimonial.delete");
	Route::get("contact", [UserController::class, "contact"])->name("contact");
	Route::get("contact/data", [UserController::class, "contactData"])->name("contact.data");
	Route::get("contact/data/{id}", [UserController::class, "showContact"])->name("contact.show.data");
	Route::put("contact", [UserController::class, "updateContact"])->name("contact.update");
	Route::get("social", [UserController::class, "social"])->name("social");
	Route::get("social/data", [UserController::class, "socialData"])->name("social.data");
	Route::get("social/data/{id}", [UserController::class, "showSocial"])->name("social.show.data");
	Route::put("social", [UserController::class, "updateSocial"])->name("social.update");
	Route::get("service", [UserController::class, "service"])->name("service");
	Route::get("service/data", [UserController::class, "serviceData"])->name("service.data");
	Route::get("service/data/{id}", [UserController::class, "showService"])->name("service.show.data");
	Route::put("service", [UserController::class, "updateService"])->name("service.update");
	Route::get("banner", [UserController::class, "banner"])->name("banner");
	Route::get("banner/data", [UserController::class, "bannerData"])->name("banner.data");
	Route::post("banner", [UserController::class, "storeBanner"])->name("banner.store");
	Route::get("banner/data/{id}", [UserController::class, "showBanner"])->name("banner.show");
	Route::put("banner", [UserController::class, "bannerUpdate"])->name("banner.update");
	Route::delete("banner", [UserController::class, "deleteBanner"])->name("banner.delete");
	Route::get("company", [UserController::class, "company"])->name("company");
	Route::get("company/slide/data", [UserController::class, "companySlideData"])->name("company.slide.data");
	Route::get("qna", [UserController::class, "qna"])->name("qna");
	Route::get("qna/data", [UserController::class, "qnaData"])->name("qna.data");
	Route::get("qna/data/{id}", [UserController::class, "showQna"])->name("qna.show");
	Route::put("qna", [UserController::class, "updateQna"])->name("qna.update");
});