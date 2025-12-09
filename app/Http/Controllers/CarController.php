<?php

namespace App\Http\Controllers;

use App\Models\Car;

class CarController extends Controller
{
    public function show($name)
    {
         $car = Car::where('title', $name)->firstOrFail();
         return view('cars.show', compact('car'));
    }
}
