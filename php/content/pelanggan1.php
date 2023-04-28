<?php
require_once('../lib/Connect.php');

if (isset($_GET['hal'])) {
    $hal = $_GET['hal'];
} else {
    $hal = "";
}

if ($hal == 'checkout') {
    $nama         = $_GET['nama_kamar'];
    $noktp       =$_GET['Noktp'];
    $kodepemesanan = $_GET['kode_pemesanan'];
    $sql2       = "SELECT stok FROM stok_kamar where nama_kamar = '$nama'";
    $q2         = mysqli_query($connect,$sql2);
    $r2 = mysqli_fetch_array($q2);
    $stok = $r2['stok'];
    $stok = $stok + 1;
    $sql1       = "UPDATE stok_kamar SET stok = '$stok'  where nama_kamar = '$nama' ";
    $q1         = mysqli_query($connect, $sql1);
    $sql3       = "UPDATE pemesanan SET proses = 'SELESAI' where Noktp = '$noktp' AND kode_pemesanan = '$kodepemesanan'";
    $q3         = mysqli_query($connect,$sql3);
    header("refresh:2;url=pelanggan1.php");
}

?>
<form action="" method="post">
		<label for="namapelanggan">NAMA PELANGGAN</label><br>
		<input type="text" name="namapelanggan" id="namapelanggan"><br>

		<label for="noktp">NO KTP</label><br>
		<input type="text" name="noktp" id="noktp"><br>

		<label for="notelp">NO TELPON</label><br>
		<input type="text" name="notelp" id="notelp"><br>

        <br>
        <input type="submit" value="tambah" name="tambah">
	</form>
    <?php
    if(isset($_POST['tambah'])){
        $nama = $_POST['namapelanggan'];
        $noktp = $_POST['noktp'];
        $notelp = $_POST['notelp'];

        $hasil = mysqli_query($connect, "INSERT INTO pelanggan VALUES ('$nama',  '$noktp', '$notelp')");
        header("refresh:1;url=pelanggan1.php");
    }
    
    ?>
<div class="card-header text-white bg-dark m-2">
<i class="fa-sharp fa-solid fa-clipboard"></i>
    Data Pelanggan
            </div>
                <div class="card-body m-2">
                <table class="table" id="daftar-saya">
                    <thead>
                        <tr>
                        
                            <th scope="col">Nama</th>
                            <th scope="col">NO KTP</th>
                            <th scope="col">NO Telp</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "SELECT * FROM pelanggan";
                        $q2     = mysqli_query($connect, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $nama       = $r2['nama'];
                            $noktp        = $r2['Noktp'];
                            $notelp       = $r2['Notelp'];


                            
                                echo '<tr class="table-info">';
                            

                        ?>
                                     
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $noktp ?></td>
                                <td scope="row"><?php echo $notelp ?></td>
                                <td scope="row">
                                    <a href="pemesanan.php?Noktp=<?php echo $noktp ?>"><button type="button" class="btn btn-success btn-sm">Tambah Pesanan</button></a>
                                    <a href="pelanggan1.php?hal=detail&Noktp=<?php echo $noktp ?>"><button type="button" class="btn btn-success btn-sm">Detail</button></a>
                                </td>
                            </tr>
                            
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
                </div>
                <br>
                <br>
    
<?php
if($hal == 'detail'){
    $noktp = $_GET['Noktp'];
    $sql   = "SELECT * FROM pelanggan where Noktp = $noktp";
        $q     = mysqli_query($connect, $sql);
        while ($r = mysqli_fetch_array($q)) {
                $nama       = $r['nama'];
                $noktp        = $r['Noktp'];
                $notelp       = $r['Notelp'];
                echo "NAMA : ".$nama."<br>";
                echo "NO KTP : ".$noktp."<br>";
                echo "NO Telepon : ".$notelp."<br>";
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
                        $sql1      = "SELECT * FROM pemesanan where Noktp = $noktp";
                        $q1     = mysqli_query($connect, $sql1);
                        while ($r1 = mysqli_fetch_array($q1)) {
                                $kodepemesanan = $r1['kode_pemesanan'];
                                $checkin = $r1['tgl_check_in'];
                                $namakamar = $r1['nama_kamar'];
                                $proses = $r1['proses'];
                                ?>
                                            <tr class="table-info" style="text-align: center;">    
                                                <td scope="row"><?php echo $kodepemesanan; ?></td>
                                                <td scope="row"><?php echo $checkin; ?></td>
                                                <td scope="row"><?php echo $proses; ?></td>
                                                <?php
                                                if($r1['proses']== 'Belum Dibayar'){
                                                    ?>
                                                <td scope="row">
                                                    <a href="pembayaran.php?hal=detail&Noktp=<?php echo $noktp ?>&kode_pemesanan=<?php echo $kodepemesanan ?>"><button type="button" class="btn btn-success btn-sm">Bayar</button></a>
                                                </td>
                                                <?php
                                                }
                                                else if($r1['proses']=='Berlangsung'){
                                                ?>
                                                <td scope="row">
                                                    <a href="pelanggan1.php?hal=checkout&Noktp=<?php echo $noktp ?>&kode_pemesanan=<?php echo $kodepemesanan ?>&nama_kamar=<?=$namakamar; ?>"><button type="button" class="btn btn-success btn-sm">Check Out</button></a>
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
