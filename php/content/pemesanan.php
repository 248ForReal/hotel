<?php 
require_once('../lib/Connect.php');
$noktp = $_GET['Noktp'];
$query="SELECT max(kode_pemesanan) as terbesar from pemesanan";
				$hasil=mysqli_query($connect,$query);
				$data =mysqli_fetch_array($hasil);
				$terbesar=$data['terbesar'];

				$urutan=(int)substr($terbesar, 10, 4);

				$urutan++;
				$huruf="LM".date("Ymd");
				$kode=$huruf.sprintf("%04s",$urutan);
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>pemesanan</title>
</head>
<body>
		<label for="idpelanggan">ID PELANGGAN</label>
		<input type="text" name="idpelanggan" id="idpelanggan" value="<?php echo $noktp; ?>"><br>

	<label>jenis Kamar</label><br>
	<?php  
		$sql = "SELECT * FROM stok_kamar";
		$hasil = mysqli_query($connect,$sql);
			while ($data = mysqli_fetch_array($hasil)) {?>
		
		<a href="?Noktp=<?php echo $noktp; ?>&i=<?php echo $data['nama_kamar']."|".$data['stok']; ?>"><span>
			<?php echo $data['nama_kamar']."|".$data['stok']; ?>
		</span></a>
	<br>
	<?php } ?>

<?php
	if(isset($_GET['i'])) {

		 $getNamaKamar = $_GET['i'];
		 $arraykamar = explode("|", $getNamaKamar);
		 $kamar = $arraykamar[0];
		 $stok = $arraykamar[1];
		 echo $kamar.$stok;	?>
		<form method="post">
		 	<br><br>
		 	<input type="text" name="kode_pemesanan" value="<?= $kode; ?>" readonly><br><br>
		 	
		 	<label>Tipe Kamar</label><br>
		 	<input type="text" name="id_tipe_kamar" id="id_tipe_kamar"><br><br>
		 	
		 	<label>Tanggal Check in</label><br>
		 	<input type="date" name="tgl_check_in"><br><br>

		 	<label>Tanggal Check out</label><br>
		 	<input type="date" name="tgl_check_out"><br><br>

		 	<label>Jenis Hari</label><br>
		 	<select id="jenis_hari" name="jenis_hari" onchange="changeValue(this.value)">
		 		<?php 
		 			$sql1 = "SELECT * FROM tipe_kamar where nama_kamar = '$kamar'";
		 			$hasil1 = mysqli_query($connect,$sql1);
		 			while ($data1 = mysqli_fetch_array($hasil1)) { ?>
		 		<option value="<?php echo $data1['jenis_hari']; ?>" >	<?php echo $data1['jenis_hari']; ?>
		 		</option>
		 		<?php 
		 			$a .= "harga['" .$data1['jenis_hari'] . "'] = {harga:'" .addslashes($data1['Harga'])."'};\n"; 
		 			$b .= "id_tipe_kamar['" .$data1['jenis_hari'] . "'] = {id_tipe_kamar:'" .addslashes($data1['id_tipe_kamar'])."'};\n"; 
		 		} ?>
		 	</select>
		 	<br><br>
		 	
		 	<label>Harga</label><br>
		 	<input type="text" name="hargaKamar" id="harga">
		 	<br><br>
		 	<?php 
		 		$sql3 = "SELECT * FROM tambahan";
		 			$hasil3 = mysqli_query($connect,$sql3);
		 			while ($data3 = mysqli_fetch_array($hasil3)) { ?>
		 	<label><?= $data3['nama']; ?></label><br>
		 	<input type="checkbox" name="tmbhn" value="<?= $data3['nama']."|".$data3['harga']; ?>"><br>

		 <?php } ?>
		 <input type="submit" name="pilih" value="Kirim">
		</form>

		<?php 
		date_default_timezone_set("Asia/Jakarta");
		if (isset($_POST['pilih'])) {

			$kodepemesanan = $_POST['kode_pemesanan'];
			$idtipekamar = $_POST['id_tipe_kamar'];
			$checkin = $_POST['tgl_check_in'];
			$checkout = $_POST['tgl_check_out'];
			$jenishari = $_POST['jenis_hari'];
			$hargakamar = $_POST['hargaKamar'];
			$getTmbhn = $_POST['tmbhn'];
		 $arrayTmbhn = explode("|", $getTmbhn);
		 $tambahan = $arrayTmbhn[0];
		 $hargaTmbhn = $arrayTmbhn[1];
		  $tglIn = new DateTime($checkin);
		 $tglOut = new DateTime($checkout);
		 $diff = $tglIn->diff($tglOut);
		 $totalinap = $diff->days;
		 $pajak = 0.10;
		 $sub_total = ($hargakamar*$totalinap) + $hargaTmbhn;
		 $hPajak = $sub_total * $pajak;
		 $totalharga = $sub_total + $hPajak;
		 $waktuorder = date("Y-m-d H:i:s");
		 $proses = "Belum Dibayar";
		
		 
		 if($stok != 0){
			echo $kamar."<br>";
			echo $kodepemesanan.'<br>'.$tambahan.$hargaTmbhn.'<br>'.$idtipekamar.'<br>'.$hargakamar.'<br>'.$checkin.'<br>'.$checkout.'<br>'.$jenishari.'<br>'.$hPajak.'<br>'.$sub_total.'<br>'.$totalharga;
   
			$insert = mysqli_query($connect, "INSERT INTO pemesanan VALUES ('$noktp','$kodepemesanan', '$idtipekamar', '$kamar',  '$checkin', '$checkout', '$totalinap', '$jenishari', '$hargakamar', '$tambahan', '$hargaTmbhn', ' ', '$hPajak', '$totalharga', '$waktuorder','$proses')");
			$stok = $stok-1;
		 	$update = mysqli_query($connect, "UPDATE stok_kamar SET stok='$stok' where nama_kamar = '$kamar'");
			header("refresh:1;url=pelanggan1.php?");
		 }
		 else{
			echo "STOK KAMAR HABIS";
			header("refresh:1;url=pemesanan.php?Noktp=$noktp");
		 }
		}


		 ?>
		 		
<?php } ?>

<script type="text/javascript">
	<?php echo $a.$b ?>
	function changeValue(id) {
		document.getElementById('harga').value = harga[id].harga;
		document.getElementById('id_tipe_kamar').value = id_tipe_kamar[id].id_tipe_kamar;
	}
</script>
</body>
</html>
