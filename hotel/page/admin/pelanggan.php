<?php
require_once('../../lib/config.php');

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'hapus'){
    $noktp = $_GET['Noktp'];
    $sql   = mysqli_query($config,"DELETE FROM pelanggan where Noktp = $noktp") ;
    header("refresh:1;url=?hal=pelanggan");
}

if ($op == 'checkout') {
    $nama         = $_GET['nama_kamar'];
    $noktp       =$_GET['Noktp'];
    $kodepemesanan = $_GET['kode_pemesanan'];
    $sql2       = "SELECT stok FROM stok_kamar where nama_kamar = '$nama'";
    $q2         = mysqli_query($config,$sql2);
    $r2 = mysqli_fetch_array($q2);
    $stok = $r2['stok'];
    $stok = $stok + 1;
    $sql1       = "UPDATE stok_kamar SET stok = '$stok'  where nama_kamar = '$nama' ";
    $q1         = mysqli_query($config, $sql1);
    $sql3       = "UPDATE pemesanan SET proses = 'SELESAI' where Noktp = '$noktp' AND kode_pemesanan = '$kodepemesanan'";
    $q3         = mysqli_query($config,$sql3);
    header("refresh:1;url=?hal=pelanggan");
}

?>

<div class="head-title">
	<span>Pages/</span>
	<h3>Pelanggan</h3>
</div>
<div class="content p-5 bg-white bg-s">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <form action="" method="post">
		<div class="mb-3">
            <label for="namapelanggan">Nama Pelanggan</label>
            <input type="text" name="namapelanggan" id="namapelanggan" class="form-control" required>      
        </div>
        <div class="mb-3">
            <label for="noktp">No KTP</label>
            <input type="text" name="noktp" id="noktp" class="form-control" required>
        </div>
		<div class="mb-5">
            <label for="notelp">No Telepon</label>
            <input type="text" name="notelp" id="notelp" class="form-control" required>      
        </div>
        <div class="d-flex justify-content-end">
            <input type="submit" value="tambah" name="tambah" class="btn btn-pk">
        </div>
	</form>
</div>
    
<?php
    
    if(isset($_POST['tambah'])){
        $nama = $_POST['namapelanggan'];
        $noktp = $_POST['noktp'];
        $notelp = $_POST['notelp'];

        $hasil = mysqli_query($config, "INSERT INTO pelanggan VALUES ('$nama',  '$noktp', '$notelp')");
        header("refresh:1;url=?hal=pelanggan");
    }
    
?>

<!-- Data Pelanggan -->
<div class="head-title mt-5 mb-4">
    <h3>Data Pelanggan</h3>
</div>
<div class="p-5 bg-white bg-s">
                <table class="table" id="daftar-saya">
                    <thead>
                        <tr>
                        
                            <th scope="col">Nama</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">No Telp</th>
                            <th scope="col" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "SELECT * FROM pelanggan";
                        $q2     = mysqli_query($config, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $nama       = $r2['nama'];
                            $noktp        = $r2['Noktp'];
                            $notelp       = $r2['Notelp']; ?>
                            <tr>      
                                <td scope="row"><?=$nama ?></td>
                                <td scope="row"><?=$noktp ?></td>
                                <td scope="row"><?=$notelp ?></td>
                                <td scope="row">
                                    <div class="d-flex gap-3 justify-content-center">
                                        <a href="?hal=pemesanankamar&Noktp=<?=$noktp ?>"><button type="button" class="btn btn-success btn-sm">Tambah</button></a>
                                        <a href="?hal=pelanggan&op=detail&Noktp=<?=$noktp ?>"><button type="button" class="btn btn-success btn-sm">Detail</button></a>
                                        <a href="?hal=pelanggan&op=hapus&Noktp=<?=$noktp ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                    </div>
                                </td>
                            </tr>
                            
                        <?php } ?>
                    </tbody>
                </table>
</div>
    
<?php

if($op == 'detail'){
    $noktp = $_GET['Noktp'];
    $sql   = "SELECT * FROM pelanggan where Noktp = $noktp";
        $q     = mysqli_query($config, $sql);
        while ($r = mysqli_fetch_array($q)) {
                $nama       = $r['nama'];
                $noktp        = $r['Noktp'];
                $notelp       = $r['Notelp'];
                echo "Nama : ".$nama."<br>";
                echo "No KTP : ".$noktp."<br>";
                echo "No Telepon : ".$notelp."<br>";
                }
    ?>
    <table class="table" id="daftar-saya">
                    <thead>
                        <tr>
                        
                            <th scope="col">Kode Pemesanan</th>
                            <th scope="col">Tanggal Check In</th>
                            <th scope="col">Proses</th>
                            <th scope="col">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql1 = "SELECT * FROM pemesanan where Noktp = $noktp";
                        $q1 = mysqli_query($config, $sql1);
                        while ($r1 = mysqli_fetch_array($q1)) {
                                $kodepemesanan = $r1['kode_pemesanan'];
                                $checkin = $r1['tgl_check_in'];
                                $namakamar = $r1['nama_kamar'];
                                $proses = $r1['proses'];
                                ?>
                                            <tr class="table-info">    
                                                <td scope="row"><?php echo $kodepemesanan; ?></td>
                                                <td scope="row"><?php echo $checkin; ?></td>
                                                <td scope="row"><?php echo $proses; ?></td>
                                                <?php
                                                if($r1['proses']== 'Belum Dibayar'){
                                                    ?>
                                                <td scope="row">
                                                    <a href="?hal=pembayaran&op=detail&Noktp=<?php echo $noktp ?>&kode_pemesanan=<?php echo $kodepemesanan ?>"><button type="button" class="btn btn-success btn-sm">Bayar</button></a>
                                                </td>
                                                <?php
                                                }
                                                else if($r1['proses']=='Berlangsung'){
                                                ?>
                                                <td scope="row">
                                                    <a href="?hal=pelanggan&op=checkout&Noktp=<?php echo $noktp ?>&kode_pemesanan=<?php echo $kodepemesanan ?>&nama_kamar=<?=$namakamar; ?>"><button type="button" class="btn btn-success btn-sm">Check Out</button></a>
                                                </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                }
                        ?>
                    </tbody>
                </table>
    <?php

}
?>
