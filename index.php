<?php

session_start();

require_once "config/Database.php";

require_once "app/controllers/RegistrasiController.php";
require_once "app/controllers/LoginController.php";

$page = $_GET["page"] ?? "login";

// ==========================
// REGISTRASI
// ==========================
if ($page == "registrasi") {

    $controller = new RegistrasiController($conn);
    $error = $controller->registrasi();

    require "app/views/registrasi.php";
}

// ==========================
// LOGIN
// ==========================
elseif ($page == "login") {

    $controller = new LoginController($conn);
    $error = $controller->login();

    require "app/views/login.php";
}

// ==========================
// DASHBOARD PENCARI
// ==========================
elseif ($page == "dashboard_pencari") {

    require "app/views/dashboard_pencari.php";
}

// ==========================
// LOGOUT
// ==========================
elseif ($page == "logout") {

    $controller = new LoginController($conn);
    $controller->logout();
}

// ==========================
// DEFAULT
// ==========================
else {

    echo "<h2>Sistem Booking Kost</h2>";
    echo "<p>Halaman belum tersedia.</p>";
}

?>