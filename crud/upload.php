<?php
class Upload{
    /*
     * 1. upload
     * 2. cek ukuran gambar
     * 3. mengambil ekstensi file: png, gif, jpeg, jpg
     * 4. hapus gambar
     */
    
    var $targetDirectory = "images/";
    var $limit = 50000; #byte
    var $error;
    var $hasil;
    
    #upload
    function uploadFile($file){
        $ukuran = $this->cekUkuran($file);
        
        #jika ukuran sesuai setting, maka upload
        if( ( $ukuran > 0 ) && ( $ukuran < $this->limit ) ): #sesuai (dibawah ketentuan)
            #upload sebelumnya dilakukan perubahan nama file
            
            #rename file sesuai tanggal dan jam
            $ex = $this->getEkstensi($file["name"]); //output: jpg, png, gif, jpeg
            $namaBaru = "img_". date("Ymd_His") .".". $ex ;
            $targetFile = $this->targetDirectory.$namaBaru;
            
            #cek pastikan nama file belum tersedia sebelumnya
            if( file_exists($targetFile) )
                $this->error = "File sudah ada";
            
            #cek ekstensi 
            if( $ex != "jpg" &&
                $ex != "jpeg" &&
                $ex != "png" &&
                $ex != "gif" )
                $this->error = "Hanya menerima format gambar";
            
            #cek apakah ada error sebelumnya
            if( strlen($this->error) > 0 ):
                $this->hasil = [ "status" => "0", "info" => basename($file["name"]) ];
            else:
                #upload
                if( move_uploaded_file($file["tmp_name"], $targetFile)):
                    $this->hasil = [ "status" => "1", "info" => $namaBaru ];
                else:
                    $this->hasil = [ "status" => "0", "info" => $namaBaru ];
                endif;
            endif;
        elseif($ukuran == 0):    
            $this->hasil = [ "status" => "2", "info" => "Tak ada file yang diunggah" ];
        else: #tidak sesuai (diatas ketentuan)
            #tidak diupload
            $this->hasil = [ "status" => "0", "info" => "Gagal Unggah. diluar ketentuan" ];
        endif;
        
        return $this->hasil;
    }
    
    #cek ukuran gambar
    function cekUkuran($file){
        return $file['size']; #menampilkan ukuran file
    }
    
    #ambil ekstensi
    function getEkstensi($fileName){
        #jpg? jpeg? png?
        $temp = explode('.', $fileName);
        $ekstensi = end($temp);
        return $ekstensi;
    }
    
    #hapus file
    function hapusFile($fileName){
        #hapus file dari folder
        
        #periksa dahulu, apakah file yg akan dihapus tersedia?
        if(file_exists( $this->targetDirectory.$fileName ) ):
            unlink( $this->targetDirectory.$fileName ); //hapus
            
            #beritahu pengguna function ini berupa json
            $this->hasil = array( "status" => "1", "info" => $fileName );
        else:
            $this->hasil = array( "status" => "0", "info" => $fileName );
        endif;
        
        return $this->hasil;
    } 
}