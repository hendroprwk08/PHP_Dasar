<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jabatan</title>
</head>
<body>
    <?php
    include( 'koneksi.php' );
    
    /* 
    kita akan membuat variable bernama $aksi untuk mendeteksi
    aksi apakah mau tambah data, ubah, hapus atau melihat data
    */

    #metode kondisi tanpa "if" atau ternary
    $aksi = (! isset( $_REQUEST[ 'aksi' ] ) ) ? null : $_REQUEST[ 'aksi' ]; 

    if ( $aksi == 'simpan' ):
        $sql = 'insert into jabatan ( jabatan, honor ) values ';
        $sql .= '( "'. $_REQUEST[ 'jabatan' ].'", '. $_REQUEST[ 'honor' ] .' )';
           
        #ekseksi sql, jika gagal munculkan pesan error
        if(! $mysqli->query( $sql ) )
            die( 'Error: '. $mysqli->error );
        
        #jika berhasil maka redirect ( kembalikan ke halaman awal )
        header( 'location: jabatan.php' );
    elseif( $aksi == 'pilih' ):
        $sql    = 'select * from jabatan where idjabatan = '.$_REQUEST[ 'id' ];
        $data   = $mysqli->query( $sql );
        $dt     = $data->fetch_array();
        
        #edit form
        echo '<form action ="#" method="post">
            <input type="hidden" name="id" value="'. $dt[ 'idjabatan' ] .'" />
            <label>Jabatan</label><input type="text" name="jabatan" value="'. $dt[ 'jabatan' ] .'" /><br/>
            <label>Honor</label><input type="text" name="honor" value="'. $dt[ 'honor' ] .'" /><br/>
            <input type="submit" name="aksi" value="update" />
            <a href="jabatan.php">Batal</a>
        </form>';
    elseif( $aksi == 'update' ):
        $sql = 'update jabatan set jabatan = "'. $_REQUEST[ 'jabatan' ].'", '; 
        $sql .= 'honor = '. $_REQUEST[ 'honor' ] .' '; 
        $sql .= 'where idjabatan = '.$_REQUEST[ 'id' ];

        if(! $mysqli->query( $sql ) )
            die( 'Error: '. $mysqli->error );

        header( 'location: jabatan.php' );
    elseif( $aksi == 'hapus' ):
        $sql = 'delete from jabatan where idjabatan = '.$_REQUEST[ 'id' ];

        if(! $mysqli->query( $sql ) )
            die( 'Error: '. $mysqli->error );

        header( 'location: jabatan.php' );
    else: #tampilkan html
        echo '<form action ="#" method="post">
            <label>Jabatan</label><input type="text" name="jabatan" /><br/>
            <label>Honor</label><input type="text" name="honor" /><br/>
            <input type="submit" name="aksi" value="simpan" />&nbsp;&nbsp;
            <input type="reset" name="reset" value="ulangi" />
        </form>';

        #table
        echo '<table border="1">
            <tr><td>ID</td><td>Jabatan</td><td>Honor</td><td>&nbsp;&nbsp;</td></tr>';
        
        #munculkan data tabel jabatan disini
        $sql    = 'select * from jabatan';
        $data   = $mysqli->query( $sql );
        
        while( $dt = $data->fetch_array() ):
            echo '<tr>
                    <td>'. $dt['idjabatan'] .'</td>
                    <td>'. $dt['jabatan'] .'</td>
                    <td>'. $dt['honor'] .'</td>
                    <td><a href="jabatan.php?aksi=pilih&id='. $dt['idjabatan'] .'">Ubah</a> | 
                        <a href="jabatan.php?aksi=hapus&id='. $dt['idjabatan'] .'">Hapus</a></td>
                </tr>';        
        endwhile;
        echo '</table>';
    endif;
    ?>
</body>
</html>