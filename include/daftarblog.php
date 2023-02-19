<?php
    include('includes/fungsi.php');
    $batas = 2;
    if(!isset($_GET['halaman'])){
      $posisi = 0;
      $halaman = 1;
    }else{
      $halaman = $_GET['halaman'];
      $posisi = ($halaman-1) * $batas;
    }
?>
<section id="blog-header">
    <div class="container">
        <h1 class="text-white">BLOG</h1>
    </div>
</section><br><br>
<section id="blog-list">
    <main role="main" class="container">
        <?php 
            if(isset($_GET['include'])){
                $include = $_GET['include'];
                if(isset($_GET['data'])){
                    $data = $_GET['data'];
                    if($include=='daftar-blog-arsip'){
                        $ex = explode("-",$data);
                        $bulan = $ex[0];
                        $tahun = $ex[1];
                        $sql = "SELECT 
                                DATE_FORMAT(`tanggal`,'%c-%Y') 
                                AS `tgl` 
                                FROM `blog` 
                                WHERE MONTH(`tanggal`) = $bulan 
                                AND YEAR(`tanggal`) = $tahun";
                    }else{
                        $sql = "SELECT `kategori_blog` 
                                FROM `kategori_blog` 
                                WHERE `id_kategori_blog` = $data";
                    }
                    $query = mysqli_query($koneksi, $sql);
                    while($data_b = mysqli_fetch_row($query)){
                        $nama = $data_b[0];
                    }
                }
            }
        ?>
        <h2 class="text-dark">
            <?php 
                if($include=='daftar-blog-arsip'){ 
                    echo "Archives : ", BulanIndo($nama);
                }else{ 
                    echo "Categories : $nama";
                } 
            ?>
        </h2><br><br>
        <div class="row">
            <div class="col-md-9 blog-main">
                <?php
                    if(isset($_GET['data'])){
                        $data = $_GET['data'];
                        $include = $_GET['include'];
                        if($include == 'daftar-blog-arsip'){
                            include('arsip.php');
                        }elseif($include == 'daftar-blog-kategori'){
                            include('kategoriblog.php');
                        }else{
                            echo "<h3>Blog Tidak Tersedia</h3>"; 
                        }
                    }
                ?>
            </div><!-- /.blog-main -->

            <aside class="col-md-3 blog-sidebar">
                <div class="p-4">
                    <h4 class="font-italic">Categories</h4>
                    <ol class="list-unstyled mb-0">
                        <?php
                        $sql_k = "SELECT `id_kategori_blog`,`kategori_blog`
                                    FROM `kategori_blog`
                                    ORDER BY `kategori_blog`";
                        $query_k = mysqli_query($koneksi,$sql_k);
                        while($data_k = mysqli_fetch_row($query_k)){
                            $id_kat = $data_k[0];
                            $nama_kat = $data_k[1];
                        ?>
                        <li><a href="index.php?include=daftar-blog-kategori&data=<?php echo $id_kat;?>">
                        <?php echo $nama_kat;?></a></li>
                        <?php } ?>
                    </ol> 
                </div>
                <div class="p-4">
                    <h4 class="font-italic">Archives</h4>
                    <ol class="list-unstyled mb-0">
                        <?php
                        $date= "  SELECT `id_blog`, 
                                    DATE_FORMAT(`tanggal`, '%m-%Y') 
                                    AS `tgl` 
                                    FROM `blog` 
                                    GROUP BY `tgl`";
                        $query_a = mysqli_query($koneksi,$date);
                        while($data_a = mysqli_fetch_row($query_a)){
                            $id_b = $data_a[0];
                            $tanggal = $data_a[1];
                        ?>

                        <li><a href="index.php?include=daftar-blog-arsip&data=<?php echo $tanggal; ?>">
                        <?php echo BulanIndo($tanggal);?></a></li>
                        <?php }?>
                    </ol>
                </div>
            </aside><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </main><!-- /.container -->

</section><br><br>