<?php

class DashboardController
{
    public function tampilkan()
    {
        if (!isset($_SESSION["id_pengguna"])) {
            header("Location: index.php?page=login");
            exit;
        }

        $role = $_SESSION["role"];

        if ($role == "Pencari Kost") {

            require "app/views/dashboard_pencari.php";

        } elseif ($role == "Pemilik Kost") {

            require "app/views/dashboard_pemilik.php";

        } elseif ($role == "Admin") {

            require "app/views/dashboard_admin.php";

        } else {

            echo "Role tidak dikenali.";

        }
    }
}
?>