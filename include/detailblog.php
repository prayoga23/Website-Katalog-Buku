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
        <div class="row">
          <div class="col-md-9 blog-main">
            <div class="blog-post">
              <?php
                  if(isset($_GET['data'])){
                    $id_blog = $_GET['data']; 
                    $sql_blog = " SELECT `b`.`judul`, 
                                  DATE_FORMAT(`b`.`tanggal`, '%M %d, %Y'), `b`.`isi`, `u`.`nama` 
                                  FROM `blog` `b` 
                                  INNER JOIN `user` `u` ON `b`.`id_user` = `u`.`id_user` 
                                  WHERE `b`.`id_blog` = $id_blog";
                    $query_blog = mysqli_query($koneksi, $sql_blog);
                    while($data_blog = mysqli_fetch_row($query_blog)){
                        $judul = $data_blog[0];
                        $tanggal = $data_blog[1];
                        $isi = $data_blog[2];
                        $penulis = $data_blog[3];
                    }
                  }
              ?>
              <h2 class="blog-post-title"><?php echo $judul; ?></h2>
              <p class="blog-post-meta"><?php echo $tanggal; ?> by <a href="#"><?php echo $penulis; ?></a></p>
              <p><?php echo $isi;?></p>
            </div><br><br><!-- /.blog-post -->

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