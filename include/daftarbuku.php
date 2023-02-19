    <section id="blog-header">
      <div class="container">
        <h1 class="text-white">DAFTAR BUKU</h1>
      </div>
    </section><br><br>
    
    <section id="katalog-item">
      <main role="main" class="container">
        <?php 
          if(isset($_GET['include'])){
            $include = $_GET['include'];
            if(isset($_GET['data'])){
              $data = $_GET['data'];
                if($include=='daftar-buku-kategori'){
                  $sql = "SELECT `kategori_buku` 
                          FROM `kategori_buku` 
                          WHERE `id_kategori_buku` = '$data'";
                }else{
                  $sql = "SELECT `tag`
                          FROM `tag` 
                          WHERE `id_tag` = '$data'";
                }
                $query = mysqli_query($koneksi, $sql);
                while($data_b = mysqli_fetch_row($query)){
                  $nama = $data_b[0];
                }
            }
          }
        ?>
        <h2 class="text-primary">
          <?php 
            if($include=='daftar-buku-kategori'){ 
              echo "Categories ";
            }else{ 
              echo "Tag ";
            } ?>:
          <?php echo $nama; ?>
        </h2><br><br>
        <div class="row">
          <div class="col-md-9 katalog-main">
            <div class="row">
              <?php 
                $include = $_GET['include'];
                $data = $_GET['data'];
                if($include=='daftar-buku-kategori'){
                  include('kategori.php');
                }else{
                  include('tag.php');
                }
              ?>
            </div><!-- .row-->
          </div><!-- /.katalog-main -->
          <aside class="col-md-3 katalog-sidebar">
            <div class="pl-4 pb-4">
              <h4 class="font-italic">Kategori</h4>
              <ol class="list-unstyled mb-0">
                <?php 
                  $sql_k = "SELECT `id_kategori_buku`,`kategori_buku` 
                            FROM `kategori_buku` 
                            ORDER BY `kategori_buku`";
                  $query_k = mysqli_query($koneksi, $sql_k);
                  while($data_k = mysqli_fetch_row($query_k)){
                    $id_kat = $data_k[0];
                    $nama_kat = $data_k[1];
                ?>
                <li>
                  <a href="index.php?include=daftar-buku-kategori&data=<?php echo $id_kat; ?>"><?php echo $nama_kat; ?></a>
                </li>
                <?php } ?>
              </ol>
            </div>
            <div class="p-4">
              <h4 class="font-italic">Tag</h4>
              <ol class="list-unstyled">
                <?php 
                  $sql_t = "SELECT `id_tag`,`tag` 
                            FROM `tag` 
                            ORDER BY `tag`";
                  $query_t = mysqli_query($koneksi, $sql_t);
                  while($data_t = mysqli_fetch_row($query_t)){
                    $id_tag = $data_t[0];
                    $nama_tag = $data_t[1];      
                ?>
                <li>
                  <a href="index.php?include=daftar-buku-tag&data=<?php echo $id_tag; ?>"><?php echo $nama_tag; ?></a>
                </li>
                <?php } ?>
              </ol>
            </div>
          </aside> <!-- /.katalog-sidebar -->      
        </div><!-- /.row -->
      </main><!-- /.container -->
    </section><br><br>