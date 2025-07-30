<h1 style="text-align: center;">PHP Laravel</h1>

<p align="center">
    ข้อมูลเก็บใน ไฟล์ CSV ข้อมูลผู้ใช้ ที่ชื่อว่า <code>users.csv</code> และ ข้อมูลรถยนต์ <code>cars.csv</code>
</p>

<h2>ข้อมูล Admin และ User</h2>

<ul>
    <li>
        <strong>Admin</strong>: <code>admin@owasp.org</code> | <strong>รหัสผ่าน</strong>: <code>123456</code>
    </li>
    <li>
        <strong>User</strong>: <code>user@owasp.org</code> | <strong>รหัสผ่าน</strong>: <code>123456</code>
    </li>
</ul>

<h2>คำสั่ง.Clear Cache and Routes</h2>

<pre><code>
composer dump-autoload
php artisan config:clear
php artisan route:clear
php artisan route:list
</code></pre>

