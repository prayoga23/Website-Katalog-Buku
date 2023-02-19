<?php
    //$date = new DateTime('now',new DateTimeZone('Asia/Jakarta'));
    $id_kategori_blog = $_POST['kategori_blog'];
    $judul = $_POST['judul'];
    $id_user = $_POST['id_user'];
    $isi = $_POST['isi'];
    $date = $_POST['tanggal'];
    if(empty($id_kategori_blog)){
        header("Location:index.php?include=tambah-blog&data=$id_blog&notif=tambahkosong&jenis=Kategori Blog");
    }else if(empty($judul)){
        header("Location:index.php?include=tambah-blog&data=$id_blog&notif=tambahkosong&jenis=Judul");
    }else if(empty($isi)){
        header("Location:index.php?include=tambah-blog&data=$id_blog&notif=tambahkosong&jenis=Isi");
    }else{
        $sql = "INSERT INTO `blog`
        (`id_kategori_blog`,`id_user`,`tanggal`,`judul`,`isi`)
        VALUES ('$id_kategori_blog','$id_user','$date','$judul','$isi')";
        mysqli_query($koneksi,$sql);
    header("Location:index.php?include=blog&notif=tambahberhasil");
    }
?>