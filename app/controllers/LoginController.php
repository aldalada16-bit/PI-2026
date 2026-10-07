<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/Pengguna.php";

class LoginController
{
    private $pengguna;

    public function __construct($conn)
    {
        $this->pengguna = new Pengguna($conn);
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = trim($_POST["email"]);
            $password = $_POST["password"];

            if (empty($email) || empty($password)) {
                return "Email dan password wajib diisi.";
            }

            $user = $this->pengguna->login($email);

            if ($user && password_verify($password, $user["password"])) {

                $_SESSION["id_pengguna"] = $user["id_pengguna"];
                $_SESSION["nama"] = $user["nama"];
                $_SESSION["role"] = $user["role"];

                header("Location: index.php?page=dashboard_pencari");
                exit;
            }

            return "Email atau password salah.";
        }

        return null;
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: index.php?page=login");
        exit;
    }
}
?>