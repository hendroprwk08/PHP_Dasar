<!DOCTYPE html>
<html>
    <head>
        <title>PHP DASAR</title>
    </head>
    <body>
    
    <?php
    //variable nama
    $nama = "Suhendar";

    #cetak dalam bentuk html
    echo "<p>Hai, aku <b>$nama</b></p>";
    ECHO "<p>Hai, aku <b>$nama</b></p>";

    /*
    Materi dibawah akan membahas
    penggunaan variable pada
    pemprograman PHP
    */

    $variabel;
    $sekolah = "SMK Indonesia"; #String
    $usia = 10; #integer ( tanpa koma )
    $koma = 5.2; #double atau float ( ada koma )
    $sudahMakan = true; #boolean

    #memiliki banyak nilai dalam satu variabel
    $arrTeman = array("Bambang", "Yunita", "Wira");

    echo "Namaku $nama, Sekolah di $sekolah";

    //boleh juga dengan cara seperti dibawah ini
    echo "<p>Usiaku saat ini ". $usia ." tahun</p>"; #dengan titik
    
    /*
    - Variable selalu diawali dengan tanda dollar $
    - harus dimulai dengan huruf
    - hanya berlaku untuk (A-z, 0-9 dan _)
    - bersifat sensitif
    */

    $teman = "Andi Ibnu";
    $_temanku = "Yosefin";
    $teman_baru = "Dinata";
    $temanBaru = "Azkadela";
    
    $nilai_1 = 5;
    $nilai_2 = 10;
    echo "Hasil penjumlahan $nilai_1 dan $nilai_2 adalah ". ( $nilai_1 + $nilai_2 ); 

    #OPERATOR ARITMATIKA
    /*
    + = penjumlahan, 
    - = pengurangan, 
    * = perkalian, 
    / = pembagian, 
    % = modulus,
    ** = exponensial
    */

    echo "<h2>OPERATOR ARITMATIKA</h2>";

    $nl_1 = 4;
    $nl_2 = 3;

    echo "Penjumlahan $nl_1 dan $nl_2 adalah ". ( $nl_1 + $nl_2 );
    echo "<br/>Pengurangan $nl_1 dan $nl_2 adalah ". ( $nl_1 - $nl_2 );
    echo "<br/>Perkalian $nl_1 dan $nl_2 adalah ". ( $nl_1 * $nl_2 );
    echo "<br/>Pembagian $nl_1 dan $nl_2 adalah ". ( $nl_1 / $nl_2 );
    echo "<br/>Modulus $nl_1 dan $nl_2 adalah ". ( $nl_1 % $nl_2 );
    echo "<br/>Exponen $nl_1 dan $nl_2 adalah ". ( $nl_1 ** $nl_2 );

    echo "<h2>ASSIGMENT / PENUGASAN / PELIMPAHAN NILAI</h2>";

    /*
    x = y : artinya, nilai y dilimpahkan kepada x
    x += y : artinya, x = x + y ( begitu juga *, -, /, % )
        contoh: x *= y
    */

    echo "Nilai awal adalah $nl_1";

    $nl_2 = $nl_1;
    echo "<br/>Nilai kedua sama dengan nilai pertama, yaitu $nl_2";

    echo "<h3>Assigment dengan Operator</h3>";

    $nl_2 += $nl_1;
    #hasil : 8, karena $nl_2 nilainya sudah disamakan dengan $nl_1
    echo "Assigment dengan penjumlahan $nl_2"; 

    echo "<h2>KOMPARASI</h2>";

    /*
    == : sama dengan, 
    === : identik,
    != : tidak sama dengan,
    <> : tidak sama dengan,
    !== : tidak identik,
    > : lebih besar,
    < : lebih kecil,
    >= : lebih besar atau sama dengan,
    <= : lebih kecil atau sama dengan,
    <=> : ( hanya PHP 7 ) jarak atau diantara, 
    */

    $nl_3 = 12;
    $nl_4 = 16;

    var_dump ($nl_3 < $nl_4);

    #FUNCTION UNTUK STRING
    echo "<h2>FUNCTION PADA STRING </h2>";

    $namaGuru = "Asmuni Sunandar";

    echo "Jumlah $namaGuru = ". strlen($namaGuru);
    echo "<br/>Jika dibalik menjadi ". strrev($namaGuru);
    echo "<br/>Jumlah kata ". str_word_count($namaGuru);
    echo "<br/>Ganti Asmuni menjadi Ahmad ". str_replace("Asmuni", "Ahmad", $namaGuru);

    echo "<h2>CONSTANT</h2>";

    #fungsi constant mirip seperti alias
    define("AKU", "Hermawan Darsana");
    echo AKU;

    define("ARR_TEMANS", ["Indah", "Rama", "Sri"]); #berupa array
    echo "<br/>". ARR_TEMANS[0];
    echo "<br/>". ARR_TEMANS[1];
    echo "<br/>". ARR_TEMANS[2];

    #IF
    echo "<h2>IF</h2>";

    /*
    if (kondisi) {
	  kode yang berjalan saat kondisi terpenuhi atau benar atau sesuai
	}
    */
    
    $harga = 50000;

    if($harga > 50000){
        echo "Mahal<br/>";
    }else{
        echo "Murah<br/>";
    }

    #model one line / ternary
    echo ($harga > 50000)? "Mahal<br/>" : "Murah<br/>";

    /*
    if (kondisi) {
	  kode yang berjalan saat kondisi terpenuhi;
	} elseif (condition) {
	  jika if diatas tak terpenuhi maka dicoba dengan kondisi ini;
	} else {
	  jika seluruh kondisi tak terpenuhi;
	}
    */

    /* 
    contoh kasus:
    jika nilai diatas 64.9 maka lulus dengan grade C
    65 - 79.9 grade B
    diatas 79.9 grade A
    selain itu maka D
    */

    $nilaiUjian = 65;

    if($nilaiUjian > 64.9){
        echo "C";
    }elseif($nilaiUjian >= 65 && $nilaiUjian <= 79.9){
        echo "B";
    }elseif($nilaiUjian > 79.9){
        echo "A";
    }else{
        echo "D";
    }

    #SWITCH
    #sama dengan IF fungsinya untuk memproses kondisi
    
    echo "<h2>SWITCH</h2>";

    switch($nilaiUjian){
        case $nilaiUjian >= 60:
            echo "Lulus";
            break;
        default:
            echo "Tidak Lulus";
    }

    #LOOPING

    /*
    - while - loops berjalan selama kondisi "true"
	- do...while - loops jalan kode pertama, jika bernilai true, maka dilanjutkan
	- for - loops loop sesuai jumlah putaran
	- foreach - loops sesuai jumlah putaran khusus array
    */

    echo "<h2>LOOPING</h2>";
    echo "<h3>WHILE</h3>";

    $x = 1;

    while($x <= 10){
        echo "Nilai x adalah $x <br/>";
        $x++;
    }

    echo "<h3>DO..WHILE</h3>";

    $x = 1; #reset nilai x
    do{
        echo "Nilai x adalah $x <br/>";
        $x++;
    }while($x <= 10);

    echo "<h3>FOR</h3>";

    for($x = 1; $x <= 10; $x++){
        echo "Nilai x adalah $x <br/>";
    }

    echo "<h3>FOREACH - UNTUK ARRAY</h3>";

    $musisi = array ("Ariel", "Rich Brian", "Tulus", "Iwan Fals", "Raisa");

    foreach($musisi as $value){
        echo "$value <br/>";
    }

    #pada array asosiatif

    $vokalis = array ("Noah" => "ariel", 
                    "Sheila on 7" => "duta",
                    "Slank" => "Kaka",
                    "Dewa" => "Elfonda mekel");

    foreach($vokalis as $key => $value){
        echo $key. ", vokalis ". $value. "<br/>";
    }    

    echo "<h3>FUNCTION</h3>";

    /*
    PHP memiliki ribuan function, seperti: var_dump(), print(), str_replace()
    dan lainnya.

    Namun kita juga bisa membuat function sendiri sesuai kebutuhan
    */

    function namaKu(){
        echo "Muhammad Baihaqi";
    }

    namaKu();

    #function dengan parameter
    function namaMu($value){
        echo "<br/>Hai, $value";
    }

    namaMu("Andi");
    namaMu("Dzikri");
    namaMu("Johan");

    #function dengan parameter bernilai default (bawaan)
    function status($nama, $nilai = 60){ #60 merupakan nilai bawaan
        echo "<br/>Hai, $nama. Nilai ujianmu $nilai";
    }

    status("Iriana", 75); #set nilai 75
    status("Malik"); #menggunakan nilai bawaan, yaitu 60

    #function yang menghasilkan nilai "keluaran" / "hasil"
    function tambah($a, $b): int{ #output berupa integer
        return $a + $b;
    }

    echo "<br/>". tambah(20, 13);
    ?>
    </body>
</html>