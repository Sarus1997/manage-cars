<h1 style="text-align: center; font-family: Arial, sans-serif; color: #2c3e50;">PHP Laravel</h1>

<h2 style="color: #2980b9;">รายละเอียด</h2>

<p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">ระบบจัดการรถยนต์</p>

<p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">ใช้ Laravel 12</p>

<p align="center" style="font-style: italic; color: #34495e;">
    ข้อมูลเก็บใน ไฟล์ CSV ข้อมูลผู้ใช้ ที่ชื่อว่า <code>users.csv</code> และ ข้อมูลรถยนต์ <code>cars.csv</code>
</p>

<h2 style="color: #2980b9;">ข้อมูล Admin และ User</h2>

<ul style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <li>
        <strong>Admin</strong>: <code>admin@owasp.org</code> | <strong>รหัสผ่าน</strong>: <code>123456</code>
    </li>
    <li>
        <strong>User</strong>: <code>user@owasp.org</code> | <strong>รหัสผ่าน</strong>: <code>123456</code>
    </li>
</ul>

<h2 style="color: #2980b9;">คำสั่ง Clear Cache and Routes</h2>

<pre style="background-color: #f4f4f4; padding: 10px; border-radius: 5px;"><code>
composer dump-autoload
php artisan config:clear
php artisan route:clear
php artisan route:list
</code></pre>

