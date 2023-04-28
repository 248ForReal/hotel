<div class="head-title">
	<span>Pages/</span>
	<h3>Pembayaran</h3>
</div>
<div class="content">
<?php
require_once('../../lib/config.php');

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'bayar'){
	$noktp        = $_GET['Noktp'];
	$kodepemesanan = $_GET['kode_pemesanan'];
	$namakamar = $_GET['nama_kamar'];
    $checkin = $_GET['tgl_check_in'];
	$checkout = $_GET['tgl_check_out'];
    $totalinap = $_GET['total_inap'];
	$hargakamar = $_GET['harga_kamar'];
	$tambahan = $_GET['item_tambahan'];
    $hargatambahan = $_GET['harga_tambahan'];
    $subtotal = $_GET   ['sub_total'];
    $diskon = $_GET['diskon'];
	$pajak = $_GET['pajak'];
	$total = $_GET['total_harga'];
	$sql1       = "UPDATE pemesanan SET proses = 'Berlangsung'  where Noktp = '$noktp' AND kode_pemesanan = '$kodepemesanan' ";
    $q1         = mysqli_query($config, $sql1);
    $insert = mysqli_query($config, "INSERT INTO pembayaran VALUES ('$kodepemesanan','$namakamar','$checkin','$checkout', '$totalinap','$hargakamar','$tambahan', '$hargatambahan','$subtotal','$diskon','$pajak','$total')");
	header("refresh:1;url=?hal=pembayaran&op=detail&Noktp=$noktp&kode_pemesanan=$kodepemesanan");
}   

if($op == 'cetak'){
	header("refresh:1;url=?hal=index.php");
    
}

if($op == 'detail'){
    $noktp = $_GET['Noktp'];
    $sql   = "SELECT * FROM pelanggan where Noktp = $noktp  ";
        $q     = mysqli_query($config, $sql);
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
                            <th scope="col">Nama Kamar</th>
                            <th scope="col">Tanggal Check-in</th>
                            <th scope="col">Tanggal Check-out</th>
                            <th scope="col">Total Inap</th>
                            <th scope="col">Harga Kamar</th>
                            <th scope="col">Item Tambahan</th>
                            <th scope="col">Harga Tambahan</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Pajak</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Proses</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $sql1      = "SELECT * FROM pemesanan where Noktp = '$noktp'";
                        $q1     = mysqli_query($config, $sql1);
                        while ($r1 = mysqli_fetch_array($q1)) {
                                $kodepemesanan = $r1['kode_pemesanan'];
                                $namakamar = $r1['nama_kamar'];
                                $checkin = $r1['tgl_check_in'];
		                        $checkout = $r1['tgl_check_out'];
                                $totalinap = $r1['total_inap'];
                                $hargakamar = $r1['harga_kamar'];
                                $tambahan = $r1['item_tambahan'];
                                $hargatambahan = $r1['harga_tambahan'];
                                $subtotal = $r1['sub_total'];
                                $diskon = $r1['diskon'];
                                $pajak = $r1['pajak'];
                                $total = $r1['total_harga'];
                                $proses = $r1['proses'];
                        }
                                ?>   			
                                        <?php
										if($proses == 'Belum Dibayar'){
											?>
                                               <tr class="table-info" style="text-align: center;">    
                                                <td scope="row"><?php echo $kodepemesanan; ?></td>
                                                <td scope="row"><?php echo $namakamar ;?></td>
                                                <td scope="row"><?php echo $checkin ;?></td>
                                                <td scope="row"><?php echo $checkout ;?></td>
                                                <td scope="row"><?php echo $totalinap ;?></td>
                                                <td scope="row"><?php echo $hargakamar ;?></td>
                                                <td scope="row"><?php echo $tambahan ;?></td>
                                                <td scope="row"><?php echo $hargatambahan; ?></td>
                                                <td scope="row"><?php echo $subtotal; ?></td>
                                                <td scope="row"><?php echo $diskon; ?></td>
                                                <td scope="row"><?php echo $pajak; ?></td>
                                                <td scope="row"><?php echo $total ;?></td>
                                                <td scope="row"><?php echo $proses ;?></td>
                                            </tr>
											<a href="?hal=pembayaran&op=bayar&Noktp=<?php echo $noktp ?>&kode_pemesanan=<?php echo $kodepemesanan ?>&nama_kamar=<?=$namakamar?>&tgl_check_in=<?=$checkin?>&tgl_check_out=<?=$checkout?>&total_inap=<?=$totalinap?>&harga_kamar=<?=$hargakamar?>&item_tambahan=<?=$tambahan?>&harga_tambahan=<?=$hargatambahan?>&sub_total=<?=$subtotal?>&diskon=<?=$diskon?>&pajak=<?=$pajak?>&total_harga=<?=$total?>"><button type="button" class="btn btn-success btn-sm">Bayar</button></a>
											<?php
										} else if($proses == 'Berlangsung'){
                                            $sql2      = "SELECT * FROM pembayaran";
                                            $q2     = mysqli_query($config, $sql2);
                                            while ($r2 = mysqli_fetch_array($q2)) {
                                                    $id_pemesanan = $r2['id_pemesanan'];
                                            }
                            
                                            ?>
                                            
                                              <tr class="table-info" style="text-align: center;">    
                                              <td scope="row"><?php echo $kodepemesanan; ?></td>
                                                <td scope="row"><?php echo $namakamar ;?></td>
                                                <td scope="row"><?php echo $checkin ;?></td>
                                                <td scope="row"><?php echo $checkout ;?></td>
                                                <td scope="row"><?php echo $totalinap ;?></td>
                                                <td scope="row"><?php echo $hargakamar ;?></td>
                                                <td scope="row"><?php echo $tambahan ;?></td>
                                                <td scope="row"><?php echo $hargatambahan; ?></td>
                                                <td scope="row"><?php echo $subtotal; ?></td>
                                                <td scope="row"><?php echo $diskon; ?></td>
                                                <td scope="row"><?php echo $pajak; ?></td>
                                                <td scope="row"><?php echo $total ;?></td>
                                                <td scope="row"><?php echo $proses ;?></td>
                                            
                                            </tr>
                                    
                                            <a href="cetak.php?op=cetak&id_pemesanan=<?php echo $id_pemesanan ?>"target="_blank"><button type="button" class="btn btn-success btn-sm">Cetak</button></a>
											<?php
										}
                        
                        ?>
                    </tbody>
                </table>

    <?php

}
?>

</div>  