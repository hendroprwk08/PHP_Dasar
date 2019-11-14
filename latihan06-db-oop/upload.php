<?php 
class Upload{
    var $target_directory = "images/"; //tempat penyimpanan file
    var $limit = 50000000; //batas ukuran file yang diupload
    var $error; //penampung error
    var $hasil; 

    public function __construct() {}

    public function uploadFile($file){
        if ($file["size"] == 0) { //kalo filenya ga ada
            $this->hasil = array("status" => "1", "info" => null); 
        }else{ //kalo filenya ada
            $target_file = $this->target_directory . basename($file["name"]);

            //ambil format file
            $extention = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
            // jika file sudah ada
            if (file_exists($target_file)) {
                $this->error = "file sudah ada";
            }
    
            // cek ukuran file
            if ($file["size"] > $this->limit) {
                $this->error = "ukuran file melebihi ". $this->limit . " byte";
            }
    
            // Allow certain file formats
            if($extention != "jpg" && $extention != "png" && $extention != "jpeg"
            && $extention != "gif" ) {
                $this->error = "hanya JPG, JPEG, PNG & GIF yang diperbolehkan.";
            }
    
            // apakah ada error?
            if (strlen($this->error) > 0) {
                $this->hasil = array("status" => "0", "info" => "Kesalahan: ".$this->error);
            } else { // jika tidak maka lanjutkan proses upload
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    $this->hasil = array("status" => "1", "info" => basename( $file["name"])); 
                } else {
                    $this->hasil = array("status" => "0", "info" => "Gagal upload: ".$this->error);
                }
            }
        }
        return $this->hasil;
    }

    public function fileSize($file){
        return $file["size"];
    }

    public function hapusFile($filename){
        //die($this->target_directory.$filename);
        // jika file sudah ada
        if (file_exists($this->target_directory.$filename)) {
            unlink($this->target_directory.$filename);
            $this->hasil = array("status" => "1", "info" => $filename. " dihapus.");
        }else{
            $this->hasil = array("status" => "0", "info" => $filename. " tak ditemukan.");
        }

        return $this->hasil;
    }
}