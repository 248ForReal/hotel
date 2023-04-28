<?php

$query="SELECT max(kode_pemesanan) as terbesar from pemesanan";
				$hasil=mysqli_query($config,$query);
				$data =mysqli_fetch_array($hasil);
				$terbesar=$data['terbesar'];

				$urutan=(int)substr($terbesar, 10, 4);

				$urutan++;
				$huruf="LM".date("Ymd");
				$kode=$huruf.sprintf("%04s",$urutan);
	if(isset($_GET['i'])) {
		$noktp = $_GET['Noktp'];
		 $getNamaKamar = $_GET['i'];
		 $arraykamar = explode("-", $getNamaKamar);
		 $kamar = $arraykamar[0];
		 $stok = $arraykamar[1];
		 ?>
		
<div class="content p-5 bg-white bg-s">
	<h3 class="kamar-title"><?= $kamar; ?></h3>
	<form method="post" class="d-flex gap-5 mt-5">
		<div class="row">
			<div class="mb-3">
				<label>Kode Pemesanan</label>
				<input type="text" name="kode_pemesanan" class="form-control" value="<?= $kode; ?>" readonly>
			</div>
			<div class="mb-3">
				<label>Tanggal Check in</label>
				<input type="date" name="tgl_check_in" class="form-control">
			</div>
			<div class="mb-3">
				<label>Tanggal Check out</label>
				<input type="date" name="tgl_check_out" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="mb-3">
				<label>Jenis Hari</label>
				<select id="jenis_hari" name="jenis_hari" class="form-select" onchange="changeValue(this.value)">
		 		<?php 
		 			$sql1 = "SELECT * FROM tipe_kamar where nama_kamar = '$kamar'";
		 			$hasil1 = mysqli_query($config,$sql1);
		 			while ($data1 = mysqli_fetch_array($hasil1)) { ?>
		 		<option value="<?= $data1['jenis_hari']; ?>" ><?= $data1['jenis_hari']; ?></option>
		 		<?php 
		 			$a .= "harga['" .$data1['jenis_hari']. "'] = {harga:'" .addslashes($data1['Harga'])."'};\n"; 
		 			$b .= "id_tipe_kamar['" .$data1['jenis_hari']. "'] = {id_tipe_kamar:'" .addslashes($data1['id_tipe_kamar'])."'};\n"; 
		 		} ?>
		 	</select>
			</div>
			<div class="mb-3">
				<label>Tipe Kamar</label>
				<input type="text" name="id_tipe_kamar" class="form-control" id="id_tipe_kamar">
			</div>
			<div class="mb-3">
				<label>Harga</label>
				<input type="text" name="hargaKamar" class="form-control" id="harga">
			</div>
		 	<?php
		    $sql3 = "SELECT * FROM tambahan";
		    $hasil3 = mysqli_query($config,$sql3);
		    while ($data3 = mysqli_fetch_array($hasil3)) { ?>
		        <div class="form-group">
		            <div class="form-check">
		                <input type="checkbox" name="tmbhn[]" class="form-check-input" value="<?= $data3['nama']."|".$data3['harga']; ?>">
		                <label class="form-check-label"><?= $data3['nama']; ?> (<?= $data3['harga']; ?>)</label>
		            </div>
		            <div class="form-group">
		                <label for="jumlah">Jumlah:</label>
		                <input type="number" name="tmbhn_<?= $data3['nama'] ?>_jml" id="jumlah" min="0" max="10" step="1" value="0">
		            </div>
		        </div>
   		 	<?php } ?>
   		 	 <input type="hidden" name="total" id="total" value="0">
		<div class="d-flex justify-content-end mt-5 gap-3">
			<a href="index.php?hal=pemesanankamar" class="btn btn-secondary">Kembali</a>
			<input type="submit" name="byr" value="Kirim" class="btn btn-pk">
		</div>
		</div>
		 	
		 	
   		</form>
</div>

		<?php 
		date_default_timezone_set("Asia/Jakarta");
		if (isset($_POST['byr'])) {
			$kodepemesanan = $_POST['kode_pemesanan'];
			$idtipekamar = $_POST['id_tipe_kamar'];
			$checkin = $_POST['tgl_check_in'];
			$checkout = $_POST['tgl_check_out'];
			$jenishari = $_POST['jenis_hari'];
			$hargakamar = $_POST['hargaKamar'];
			$selected_items = $_POST['tmbhn'];
    		$totaltmbhn = $_POST['total'];
			$diskon = 0;
		  $tglIn = new DateTime($checkin);
		 $tglOut = new DateTime($checkout);
		 $diff = $tglIn->diff($tglOut);
		 $totalinap = $diff->days;
		 $pajak = 0.10;
		 $sub_total = ($hargakamar*$totalinap) + $totaltmbhn;
		 $hPajak = $sub_total * $pajak;
		 $totalharga = $sub_total + $hPajak;
		 $waktuorder = date("Y-m-d H:i:s");
		 $proses = "Berlangsung";
		
    

    // Siapkan string untuk menyimpan data yang dipilih
    $selected_items_str = "";

    // Loop melalui data yang dipilih
    foreach ($selected_items as $selected_item) {
        $item_info = explode("|", $selected_item);
        $nama = $item_info[0];
        $harga = $item_info[1];
        $jml = $_POST["tmbhn_".$nama."_jml"];
        
        // Jika jumlah > 0, tambahkan ke string
        if($jml > 0) {
            $selected_items_str .= $nama." (".$jml.") - Rp".$harga*$jml.", ";
        }
    }

    // Bersihkan koma di akhir string
    $selected_items_str = rtrim($selected_items_str, ", ");
		 
		 if($stok != 0){   
			$insert = mysqli_query($config, "INSERT INTO pemesanan VALUES ('$noktp','$kodepemesanan', '$idtipekamar', '$kamar',  '$checkin', '$checkout', '$totalinap', '$jenishari', '$hargakamar', '$selected_items_str', '$totaltmbhn', '$diskon ', '$hPajak', '$totalharga', '$waktuorder','$proses')");
			$stok = $stok-1;
		 	$update = mysqli_query($config, "UPDATE stok_kamar SET stok='$stok' where nama_kamar = '$kamar'");
			echo "<script>alert('Data berhasil ditambahkan!');document.location.href='index.php?hal=pemesanankamar';</script>";
		 }
		 else{
			echo "STOK KAMAR HABIS";
			echo "<script>document.location.href='index.php?hal=pemesanankamar';</script>";
		 }
		}


		 ?>

<?php } ?>

<script type="text/javascript">
	<?= $a.$b; ?>
	function changeValue(id) {
		document.getElementById('harga').value = harga[id].harga;
		document.getElementById('id_tipe_kamar').value = id_tipe_kamar[id].id_tipe_kamar;
	}
	// Fungsi untuk menghitung total harga tambahan yang dipilih
function hitungTotal() {
    var checkboxes = document.getElementsByName("tmbhn[]");
    var total = 0;
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            var harga = checkboxes[i].value.split("|")[1];
            var jml = document.getElementsByName("tmbhn_" + checkboxes[i].value.split("|")[0] + "_jml")[0].value;
            total += harga * jml;
        }
    }
    document.getElementById("total").value = total;
}

// Panggil fungsi hitungTotal saat form disubmit
document.querySelector("form").addEventListener("submit", hitungTotal);
</script>