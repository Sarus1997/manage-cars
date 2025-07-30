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
    return view('cars', compact('cars'));
  }

  public function store(Request $req)
  {
    $cars = $this->readCSV();
    $id = count($cars) + 1;
    $cars[] = [
      'id' => $id,
      'brand' => $req->brand,
      'model' => $req->model,
      'price' => $req->price,
      'color' => $req->color,
      'year' => $req->year,
    ];
    $this->writeCSV($cars);
    return response()->json(['success' => true, 'cars' => $cars]);
  }

  public function delete($id)
  {
    $cars = $this->readCSV();
    $cars = array_filter($cars, fn($c) => $c['id'] != $id);
    $this->writeCSV(array_values($cars));
    return response()->json(['success' => true, 'cars' => $cars]);
  }
}
