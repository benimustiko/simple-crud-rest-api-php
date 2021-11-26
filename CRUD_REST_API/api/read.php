<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/karyawan.php';

    $database = new Database();
    $db = $database->getConnection();
    $karyawan = new Karyawan($db);
    $stmt = $karyawan->readKaryawan();
    $karyawanCount = $stmt->rowCount();

    if($karyawanCount > 0){
        
        $karyawanArr = array();
        $karyawanArr["body"] = array(
                "status" => "200",
                "data" => $karyawanCount);
        $karyawanArr["data"] = array();


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                    "id" => $id,
                    "nama" => $nama,
                    "email" => $email,
                    "umur" => $umur,
                    "pekerjaan" => $pekerjaan
                );

            array_push($karyawanArr["data"], $e);
        }

        echo json_encode($karyawanArr);
    } else{
        echo json_encode(
            array(
                "message" => "Tidak ada data.",
                "status" => "400")
        );
    }
?>