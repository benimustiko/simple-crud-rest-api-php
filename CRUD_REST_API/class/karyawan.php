<?php
    class Karyawan{

        // koneksi
        private $conn;

        // tabel
        private $db_table = "Karyawan";

        // kolom
        public $id;
        public $nama;
        public $email;
        public $umur;
        public $pekerjaan;

        // buat koneksi
        public function __construct($db){
            $this->conn = $db;
        }

        // READ
        public function readKaryawan(){
            $sqlQuery = "SELECT id, nama, email, umur, pekerjaan FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createKaryawan(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        email = :email, 
                        umur = :umur, 
                        pekerjaan = :pekerjaan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->umur=htmlspecialchars(strip_tags($this->umur));
            $this->pekerjaan=htmlspecialchars(strip_tags($this->pekerjaan));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":umur", $this->umur);
            $stmt->bindParam(":pekerjaan", $this->pekerjaan);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleKaryawan(){
            $sqlQuery = "SELECT
                        id, 
                        nama, 
                        email, 
                        umur, 
                        pekerjaan
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nama = $dataRow['nama'];
            $this->email = $dataRow['email'];
            $this->umur = $dataRow['umur'];
            $this->pekerjaan = $dataRow['pekerjaan'];
        }        

        // UPDATE
        public function updateKaryawan(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        email = :email, 
                        umur = :umur, 
                        pekerjaan = :pekerjaan
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->umur=htmlspecialchars(strip_tags($this->umur));
            $this->pekerjaan=htmlspecialchars(strip_tags($this->pekerjaan));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":umur", $this->umur);
            $stmt->bindParam(":pekerjaan", $this->pekerjaan);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteKaryawan(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>