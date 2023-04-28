<?php 
if(empty($_GET['Noktp'])){
	return;
}
$noktp = $_GET['Noktp']; 

?>

<div class="head-title">
	<span>Pages/</span>
	<h3>Pemesanan Kamar</h3>
	<p>ID Pelanggan : <span><?= $noktp; ?></span></p>
</div>

<div class="content d-flex gap-3 flex-wrap p-5 bg-white bg-s">
	<?php  
		$sql = "SELECT * FROM stok_kamar";
		$hasil = mysqli_query($config,$sql);
			while ($data = mysqli_fetch_array($hasil)) { ?>

		<div class="cards_pk p-4 rounded-4 border border-light-subtle d-flex gap-3">
			<div class="img_cards rounded-4">
				<img src="../../assets/img/kamar/<?= $data['kamar_gambar']; ?>" height="230">
			</div>
			<div class="d-flex flex-column justify-content-between w-100">
				<div class="content_cards">
					<span class="title_cards"><?= $data['nama_kamar']; ?></span class="title_cards">
					<p>Sisa Kamar : <?= $data['stok']; ?></p>
					<div class="fw-semibold">Harga</div>
					<ul class="price_cards">
						<li>Hari biasa : <?= 'Rp. '.$data['biasa']; ?></li>
						<li>Hari Besar : <?= 'Rp. '.$data['besar']; ?></li>
						<li>Akhir Pekan : <?= 'Rp. '.$data['akhir_pekan']; ?></li>
						<li>Tahun Baru : <?= 'Rp. '.$data['tahun_baru']; ?></li>
					</ul>
				</div>
			<div class="button_cards text-end">
				<a href="index.php?hal=pemesanankamar&aksi=input&i=<?= $data['nama_kamar']."-".$data['stok']; ?>&Noktp=<?=$noktp?>" class="btn btn-pk" id="linkTo">Pilih</a>
			</div>
			</div>
		</div>
		
	<br>
	<?php } ?>
</div>