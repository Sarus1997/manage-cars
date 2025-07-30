<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
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

  public function showLogin()
  {
    return view('auth.login');
  }

  public function login(Request $req)
  {
    $users = $this->readCSV();
    foreach ($users as $user) {
      if (
        $user['email'] === $req->email &&
        Hash::check($req->password, $user['password']) &&
        $user['status'] === 'active'
      ) {
        Session::put('user', $user);
        return redirect('/dashboard');
      }
    }
    return back()->withErrors(['อีเมลหรือรหัสผ่านไม่ถูกต้อง หรือบัญชีถูกปิดใช้งาน']);
  }

  public function resetPassword(Request $req)
  {
    $users = $this->readCSV();
    foreach ($users as &$user) {
      if ($user['email'] === $req->email) {
        $user['password'] = Hash::make('123456');
      }
    }
    $this->writeCSV($users);
    return back()->with('msg', 'Password ถูกรีเซตเป็น 123456 แล้ว');
  }

  public function showRegister()
  {
    return view('auth.register');
  }

  public function register(Request $req)
  {
    $users = $this->readCSV();
    foreach ($users as $u) {
      if ($u['email'] === $req->email) {
        return back()->withErrors(['Email นี้ถูกใช้แล้ว']);
      }
    }

    $id = count($users) + 1;
    $newUser = [
      'id' => $id,
      'name' => $req->name,
      'email' => $req->email,
      'password' => Hash::make($req->password),
      'role' => 'user',
      'status' => 'active'
    ];

    $users[] = $newUser;
    $this->writeCSV($users);

    return redirect('/login')->with('register_success', 'สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ');
  }

  public function logout()
  {
    Session::forget('user');
    return redirect('/login');
  }
}
