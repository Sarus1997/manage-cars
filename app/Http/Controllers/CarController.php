<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
  private $file = "app/data/cars.csv";

  private function readCSV()
  {
    if (!file_exists(storage_path($this->file))) return [];

    $rows = array_map('str_getcsv', file(storage_path($this->file)));
    $header = array_shift($rows);

    return array_values(array_filter(array_map(function ($row) use ($header) {
      if (count($row) === count($header)) {
        return array_combine($header, $row);
      }
      return null;
    }, $rows)));
  }

  private function writeCSV($data)
  {
    $fp = fopen(storage_path($this->file), 'w');
    fputcsv($fp, array_keys($data[0]));
    foreach ($data as $row) fputcsv($fp, $row);
    fclose($fp);
  }

  public function index()
  {
    $cars = $this->readCSV();
    return view('cars.index', compact('cars'));
  }

  public function store(Request $req)
  {
    $cars = $this->readCSV();
    $id = collect($cars)->max('id') + 1;

    $newCar = [
      'id' => $id,
      'brand' => $req->brand,
      'model' => $req->model,
      'price' => $req->price,
      'color' => $req->color,
      'year' => $req->year,
      'status' => 'available',
    ];

    $cars[] = $newCar;
    $this->writeCSV($cars);
    return response()->json(['success' => true, 'car' => $newCar]);
  }

  public function delete($id)
  {
    $cars = $this->readCSV();
    $cars = array_filter($cars, fn($c) => $c['id'] != $id);
    $cars = array_values($cars);

    if (!empty($cars)) {
      $this->writeCSV($cars);
    } else {
      $this->writeCSV([[
        'id' => '',
        'brand' => '',
        'model' => '',
        'year' => '',
        'color' => '',
        'price' => '',
        'status' => ''
      ]]);
    }

    return response()->json(['success' => true, 'cars' => $cars]);
  }
}
