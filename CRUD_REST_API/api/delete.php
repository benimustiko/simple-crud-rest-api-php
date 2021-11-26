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
    
    $karyawan->id = $data->id;
    
    if($karyawan->deleteKaryawan()){
        echo json_encode("Karyawan terhapus.");
    } else{
        echo json_encode("Data tidak bisa terhapus");
    }
?>