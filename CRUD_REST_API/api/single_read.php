<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/karyawan.php';

    $database = new Database();
    $db = $database->getConnection();
    $karyawan = new Karyawan($db);
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $karyawan->id = $id;

    if($id != "") {
        $karyawan->getSingleKaryawan();

        if($karyawan->nama != null){
            $karyawanArr = array();
            $karyawanArr["body"] = array(
                    "status" => "200");
            $karyawanArr["data"] = array(
                "id" =>  $karyawan->id,
                "nama" => $karyawan->nama,
                "email" => $karyawan->email,
                "umur" => $karyawan->umur,
                "pekerjaan" => $karyawan->pekerjaan
            );
                  
            echo json_encode($karyawanArr);
            } else{
            echo json_encode(
                array(
                    "message" => "Tidak ada data.",
                    "status" => "400")
            );
            }
        } else {
            echo json_encode(array(
                "message" => "Data karyawan gagal diupdate. Data tidak lengkap",
                 "status" => "400"));
        }
?>