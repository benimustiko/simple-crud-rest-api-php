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
    $data = json_decode(file_get_contents("php://input"));
    
    if(
        !empty($data->id)
    ) {
        $karyawan->id = $data->id;

        if($karyawan->deleteKaryawan()){
            echo json_encode(
                array(
                    "message" => "Data karyawan berhasil terhapus.",
                    "status" => "200")
            );
        } else{
            echo json_encode(
                array(
                    "message" => "Data karyawan gagal terhapus.",
                    "status" => "400")
            );
        }

    } else {
       echo json_encode(array(
           "message" => "Data karyawan gagal diupdate. Data tidak lengkap",
           "status" => "400")
        );
    }
?>