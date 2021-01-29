<?php
class Upload{
    /*
     * 1. upload
     * 2. cek ukuran gambar
     * 3. mengambil ekstensi file: png, gif, jpeg, jpeg
     * 4. hapus gambar
     */
    
    $targetDirectory = "images/";
    $limit = 500000;
    $error;
    $hasil;
    
    #upload
    function uploadFile($file){
        $ukuran = $this->cekUkuran($file);
        
        #jika ukuran sesuai setting, maka upload
        if( $ukuran < $limit): #sesuai (dibawah ketentuan)
            #upload
        else: #tidak sesuai (diatas ketentuan)
            #tidak diupload
        endif;
    }
    
    #cek ukuran gambar
    function cekUkuran($file){
        return $file['size']; #menampilkan ukuran file
    }
    
    #ambil ekstensi
    function getEkstensi($file){
        
    }
    
    #hapus file
    function hapusFile($file){
        
    }
    
}

