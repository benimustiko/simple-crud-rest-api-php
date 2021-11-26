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


    echo json_encode($karyawanCount);

    if($karyawanCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["karyawanCount"] = $karyawanCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nama" => $nama,
                "email" => $email,
                "umur" => $umur,
                "pekerjaan" => $pekerjaan
            );

            array_push($employeeArr["body"], $e);
        }
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Tidak ada data.")
        );
    }
?>