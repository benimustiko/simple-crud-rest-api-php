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
        !empty($data->nama) &&
        !empty($data->email) &&
        !empty($data->umur) &&
        !empty($data->pekerjaan)
    ){
        $karyawan->nama = $data->nama;
        $karyawan->email = $data->email;
        $karyawan->umur = $data->umur;
        $karyawan->pekerjaan = $data->pekerjaan;

        if($karyawan->createKaryawan()){
    
            echo json_encode(array(
                "message" => "Data karyawan berhasil dibuat.",
                "status" => "200"
            ));
        } else{    
            echo json_encode(array(
                "message" => "Data karyawan gagal dibuat.",
                "status" => "400"
            ));
        }
    } else{

        http_response_code(400);

        echo json_encode(array(
            "message" => "Data karyawan gagal dibuat. Data tidak lengkap",
            "status" => "400"
        ));
    }
?>