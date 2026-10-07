<?php

require_once '../core/Database.php';

class Kost
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllKost()
    {
        $query = "SELECT * FROM kost";
        $result = $this->db->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKostById($id_kost)
    {
        $stmt = $this->db->conn->prepare(
            "SELECT * FROM kost WHERE id_kost = ?"
        );

        $stmt->bind_param("i", $id_kost);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function tambahKost($id_pengguna, $nama_kost, $alamat, $deskripsi, $foto_kost, $fasilitas)
    {
        $stmt = $this->db->conn->prepare(
            "INSERT INTO kost 
            (id_pengguna, nama_kost, alamat, deskripsi, foto_kost, fasilitas)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "isssss",
            $id_pengguna,
            $nama_kost,
            $alamat,
            $deskripsi,
            $foto_kost,
            $fasilitas
        );

        return $stmt->execute();
    }

    public function updateKost($id_kost, $nama_kost, $alamat, $deskripsi, $foto_kost, $fasilitas)
    {
        $stmt = $this->db->conn->prepare(
            "UPDATE kost SET
            nama_kost = ?,
            alamat = ?,
            deskripsi = ?,
            foto_kost = ?,
            fasilitas = ?
            WHERE id_kost = ?"
        );

        $stmt->bind_param(
            "sssssi",
            $nama_kost,
            $alamat,
            $deskripsi,
            $foto_kost,
            $fasilitas,
            $id_kost
        );

        return $stmt->execute();
    }

    public function hapusKost($id_kost)
    {
        $stmt = $this->db->conn->prepare(
            "DELETE FROM kost WHERE id_kost = ?"
        );

        $stmt->bind_param("i", $id_kost);

        return $stmt->execute();
    }
}