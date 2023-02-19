<?php
    if(isset($_SESSION['id_konten'])){
        $id_konten = $_SESSION['id_konten'];
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $tanggal = $_POST['tanggal'];
        
        if(empty($judul)){
            header("Location:index.php?include=edit-konten&data=$id_konten&notif=editkosong&jenis=Judul");
        }else if(empty($isi)){
            header("Location:index.php?include=edit-konten&data=$id_konten&notif=editkosong&jenis=Isi");
        }else if(empty($tanggal)){
            header("Location:index.php?include=edit-konten&data=$id_konten&notif=editkosong&jenis=Tanggal");
        }else{
            $sql = "UPDATE `konten` 
                    SET `judul`='$judul', `isi`='$isi', `tanggal`='$tanggal'
                    WHERE `konten`.`id_konten`='$id_konten'";
            mysqli_query($koneksi,$sql);
            header("Location:index.php?include=konten&notif=editberhasil");
        }
    }
?>