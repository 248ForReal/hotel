<?php
require_once('../lib/Connect.php');

if (isset($_GET['hal'])) {
    $hal = $_GET['hal'];
} else {
    $hal = "";
}

if($hal == 'bayar'){
	$noktp = $_GET['Noktp'];
	$kodepemesanan = $_GET['kode_pemesanan'];
	$sql1       = "UPDATE pemesanan SET proses = 'Berlangsung'  where Noktp = '$noktp' AND kode_pemesanan = '$kodepemesanan' ";
    $q1         = mysqli_query($connect, $sql1);
	header("refresh:1;url=pelanggan1.php");
}

if($hal == 'detail'){
    $noktp = $_GET['Noktp'];
    $sql   = "SELECT * FROM pelanggan where Noktp = $noktp  ";
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
                            <th scope="col">Id Kamar</th>
                            <th scope="col">Nama Kamar</th>
                            <th scope="col">Total Inap</th>
                            <th scope="col">Harga Kamar</th>
                            <th scope="col">Harga Tambahan</th>
                            <th scope="col">Pajak</th>
                            <th scope="col">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql1      = "SELECT * FROM pemesanan where Noktp = '$noktp' AND proses = 'Belum Dibayar'";
                        $q1     = mysqli_query($connect, $sql1);
                        while ($r1 = mysqli_fetch_array($q1)) {
                                $kodepemesanan = $r1['kode_pemesanan'];
                                $idtipekamar = $r1['id_tipe_kamar'];
                                $namakamar = $r1['nama_kamar'];
                                $totalinap = $r1['total_inap'];
                                $hargakamar = $r1['harga_kamar'];
                                $hargatambahan = $r1['harga_tambahan'];
                                $pajak = $r1['pajak'];
                                $total = $r1['total_harga'];
                                ?>
                                            <tr class="table-info" style="text-align: center;">    
                                                <td scope="row"><?php echo $kodepemesanan; ?></td>
                                                <td scope="row"><?php echo $idtipekamar; ?></td>
                                                <td scope="row"><?php echo $namakamar ;?></td>
                                                <td scope="row"><?php echo $totalinap ;?></td>
                                                <td scope="row"><?php echo $hargakamar ;?></td>
                                                <td scope="row"><?php echo $hargatambahan; ?></td>
                                                <td scope="row"><?php echo $pajak; ?></td>
                                                <td scope="row"><?php echo $total ;?></td>
                                            </tr>
                                        <?php
                                }
                        ?>
                    </tbody>
                </table>
				<a href="pembayaran.php?hal=bayar&Noktp=<?php echo $noktp ?>&kode_pemesanan=<?php echo $kodepemesanan ?>"><button type="button" class="btn btn-success btn-sm">Bayar</button></a>

    <?php

}
?>
