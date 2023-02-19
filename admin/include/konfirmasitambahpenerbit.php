<?php
    $penerbit = $_POST['penerbit'];
    $alamat = $_POST['alamat'];
    
    if(empty($penerbit)){
        header("Location:index.php?include=tambah-penerbit&data=$id_penerbit&notif=tambahkosong&jenis=Penerbit");
    }else if(empty($alamat)){
        header("Location:index.php?include=tambah-penerbit&data=$id_penerbit&notif=tambahkosong&jenis=Alamat");
    }else{
        $sql = "INSERT INTO `penerbit`(`penerbit`, `alamat`)
                VALUES ('$penerbit','$alamat')";
        mysqli_query($koneksi,$sql);
        header("Location:index.php?include=penerbit&notif=tambahberhasil");
    }
?>