<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", fn() => view("welcome"));
Route::get("contact", fn() => view("contact"));
Route::get("company", fn() => view("company"));
Route::get("testimonial", fn() => view("testimonial"));

Route::group(["prefix" => "user"], function() {
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
});