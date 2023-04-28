<?php
  require_once('../lib/Connect.php');
  $query="SELECT max(id_pelanggan) as terbesar from pelanggan";
  $hasil=mysqli_query($connect,$query);
  $data =mysqli_fetch_array($hasil);
  $terbesar=$data['terbesar'];

  $urutan=(int)substr($terbesar,2,3);

  $urutan++;
  $huruf="ID".date("Ymd");
  $kode=$huruf . sprintf("%03s",$urutan);
?>
  <div class="col-md-6 col-md-offset-3">
    <div class="card">
      <div class="header">
        <h4 class="title">Pelanggan</h4>
      </div>
      <div class="content">
        <form method="post"?>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="id"  value="<?php echo $kode?> " readonly>
                <label>Nama</label>
                <input type="text" name="nama" class="form-control border-input" placeholder="Nama" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No KTP</label>
                <input type="text" name="Noktp" class="form-control border-input" placeholder="No KTP" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No Telp</label>
                <input type="text" name="Notelp" class="form-control border-input" placeholder="No Telp" value="">
              </div>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-info btn-fill btn-wd" name="submit">Tambah Pelanggan</button>
          </div>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
  <div class="col-md-12">
<div class="card">
  <div class="content">
    <div class="content table-responsive table-full-width">
      <?php if (empty($pelanggan)): ?>
      <h3>Data Pelanggan kosong !</h3>
      <?php else: ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No KTP</th>
            <th>Telepon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pelanggan as $k => $v): ?>
          <tr>
            <td>
              <?php echo $v['id_pelanggan']; ?> 
            </td>
            <td>
              <?php echo $v['nama']; ?> 
            </td>
            <td>
              <?php echo $v['Noktp']; ?> 
            </td>
            <td>
              <?php echo $v['Notelp']; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
  </div>
  </div>
  <?php
  if(isset($_POST['submit'])) {
    $id_pelanggan = $_POST['id']; 
    $nama = $_POST['nama'];
    $Noktp = $_POST['Noktp'];
    $Notelp = $_POST['Notelp'];

    $hasil = mysqli_query($connect, "INSERT INTO pelanggan VALUES ('$id_pelanggan','$nama',  '$Noktp', '$Notelp')");
    
  header('location:pelanggan.php');
  }
?>


