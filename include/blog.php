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
  <body>
    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">BLOG</h1>
      </div>
    </section><br><br>
    <section id="blog-list">
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-9 blog-main">
            <?php
              $sql_bl = " SELECT `b`.`id_blog`,`b`.`judul`, 
                          DATE_FORMAT(`b`.`tanggal`, '%M %d, %Y'),`u`.`nama`, `b`.`isi`, `u`.`id_user` 
                          FROM `blog` `b` 
                          INNER JOIN `user` `u` ON `b`.`id_user`=`u`.`id_user`";
              $sql_bl .= "ORDER BY `b`.`tanggal` LIMIT $posisi, $batas";
              $query_bl = mysqli_query($koneksi,$sql_bl);
              while ($data_bl = mysqli_fetch_row($query_bl)) {
                $id_blog = $data_bl[0];
                $judul_blog = $data_bl[1];
                $tanggal_blog = $data_bl[2];
                $nama_blog = $data_bl[3];
                $isi_blog = $data_bl[4];
                $id_user = $data_bl[5];
              
            ?>
            <div class="blog-post">
              <h2 class="blog-post-title">
                <a href="index.php?include=detail-blog&data=<?php echo $id_blog; ?>"><?php echo $judul_blog; ?></a>
              </h2>
              <p class="blog-post-meta"><?php echo $tanggal_blog; ?> 
                by <a href="index.php?include=detail-penulis&penulis=<?php echo $id_user; ?>"><?php echo $nama_blog; ?></a>
              </p>
              <!--<img src="slideshow/slide-1.jpg" class="img-fluid" alt="Responsive image"><br><br>-->
      
              <p>
                <?php echo $isi_blog; ?>
              </p>
              <a href="index.php?include=detail-blog&data=<?php echo $id_blog; ?>" class="btn btn-primary">Continue reading..</a>
            </div><!-- /.blog-post --><br><br>
            <?php } ?>
            <?php
              //hitung jumlah semua data
              $sql_jum = "  SELECT `b`.`id_blog`,`b`.`judul`, 
                            DATE_FORMAT(`b`.`tanggal`, '%M %d, %Y'),`u`.`nama`, `b`.`isi`, `u`.`id_user` 
                            FROM `blog` `b` 
                            INNER JOIN `user` `u` ON `b`.`id_user`=`u`.`id_user` ";
                $sql_jum .= " order by `b`.tanggal";
                $query_jum = mysqli_query($koneksi,$sql_jum);
                $jum_data = mysqli_num_rows($query_jum);
                $jum_halaman = ceil($jum_data/$batas);
            ?>
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <?php
                  if($jum_halaman==0){
                  //tidak ada halaman
                  }else if($jum_halaman==1){
                    echo "<li class='page-item'><a class='page-link'>1</a></li>";
                  }else{
                    $sebelum = $halaman-1;
                    $setelah = $halaman+1;
                    if($halaman!=1){
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=1'>Recently</a></li>";
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=$sebelum'>«</a></li>";
                      }
                      for($i=1; $i<=$jum_halaman; $i++){
                        if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                          if($i!=$halaman){
                            echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=$i'>$i</a></li>";
                          }else{
                            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                          }
                        }
                      }
                      if($halaman!=$jum_halaman){
                        echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=$setelah'>»</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='index.php?include=blog&halaman=$jum_halaman'>Older</a></li>";
                      }
                  }?>
              </ul>
            </div>
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

  </body>