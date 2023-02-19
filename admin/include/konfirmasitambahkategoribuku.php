<?php
    $id_kategori_buku = $_POST['id_kategori_buku'];
    $kategori_buku = $_POST['kategori_buku'];
    
    if(empty($kategori_buku)){
        header("Location:index.php?include=tambah-kategori-buku&notif=tambahkosong&jenis=Kategori Buku");
    }else{
        $sql = "INSERT INTO `kategori_buku` (`id_kategori_buku`,`kategori_buku`)
                VALUES ('$id_kategori_buku', '$kategori_buku')";
        mysqli_query($koneksi,$sql);
        header("Location:index.php?include=kategori-buku&notif=tambahberhasil");
    }
?>