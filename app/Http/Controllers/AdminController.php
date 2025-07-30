<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
  private $file = "app/data/users.csv";

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
    $users = $this->readCSV();
    return view('admin.users', compact('users'));
  }

  public function reset($id)
  {
    $users = $this->readCSV();
    foreach ($users as &$u) {
      if ($u['id'] == $id) {
        $u['password'] = Hash::make('123456');
      }
    }
    $this->writeCSV($users);
    return back()->with('msg', 'User password reset');
  }

  public function block($id)
  {
    $users = $this->readCSV();
    foreach ($users as &$u) {
      if ($u['id'] == $id) {
        $u['status'] = 'blocked';
      }
    }
    $this->writeCSV($users);
    return back()->with('msg', 'User blocked');
  }
}
