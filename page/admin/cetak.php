<?php 
	
	require_once('../../lib/config.php');
	if (isset($_GET['op'])) {
		$op = $_GET['op'];
	} else {
		$op = "";
	}
	
 
		
		if($op == 'cetak'){
			$id_pemesanan = $_GET['id_pemesanan'];
			$sql = "SELECT * FROM pembayaran where id_pemesanan = '$id_pemesanan'";
			$q     = mysqli_query($config, $sql);
			while ($r = mysqli_fetch_array($q)) {
				$namakamar = $r['nama_kamar'];
                $checkin = $r['tgl_check_in'];
		        $checkout = $r['tgl_check_out'];
                $totalinap = $r['total_inap'];
                $hargakamar = $r['harga_kamar'];
                $tambahan = $r['item_tambahan'];
                $hargatambahan = $r['harga_tambahan'];
                $subtotal = $r['sub_total'];
                $diskon = $r['diskon'];
                $pajak = $r['pajak'];
                $total = $r['total_harga'];
			}
		}
		
		


		echo '
<div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 2%; background-color: #fff; border: 1px solid #ddd; font-family: Arial, sans-serif;">
    <h1 style="font-size: 4vw; font-weight: normal; margin-bottom: 1.67%; text-align:center;">Invoice</h1>
    <div style="display: flex; justify-content: space-between; font-size: 1.33vw; margin-bottom:    3.33%;">
         <div>
            <p><strong> ID Pemesanan :'  . $id_pemesanan . '</strong></p>
            <p>ROOM :' . $totalinap . '</p>
            <p>Type : ' . $namakamar. '</p>
        </div>
        <div>	  
            <p><strong>Tanggal Check-in:</strong> ' . date('d F Y', strtotime($checkin)) . '</p>
            <p><strong>Tanggal Check-out:</strong> ' . date('d F Y', strtotime($checkout)) . '</p>
        </div>
    </div>
    <img src="../../assets/img/logo.png" alt="Hotel Logo" style="display: block; margin: 0 auto 3.33%; width: 50%;">
    <table style="width: 100%; margin-bottom:34%; font-size: 1.33vw; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 1.67% 0; text-align: left; border-bottom: 0.17vw solid #ddd;">Deskripsi</th>
                <th style="padding: 1.67% 0; text-align: right; border-bottom: 0.17vw solid #ddd;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 1.67% 0; text-align: left;">' . $namakamar . ' x ' . $totalinap . ' malam</td>
                <td style="padding: 1.67% 0; text-align: right;">Rp ' . number_format($hargakamar, 0, ',', '.') . '</td>
                </tr>
                <tr>
                <td style="padding: 1.67% 0; text-align: left;">Item Tambahan</td>
                <td style="padding: 1.67% 0; text-align: right;">'.$tambahan.'</td> 
                </tr>
                <tr>
                <td style="padding: 1.67% 0; text-align: left;">Sub Total</td>
                <td style="padding: 1.67% 0; text-align: right;">Rp ' . number_format($subtotal, 0, ',', '.') . '</td>

            </tr>
                <tr>
                    <td style="padding: 1.67% 0; text-align: left; border-bottom: 0.17vw solid #ddd">Discount</td>
                    <td style="padding: 1.67% 0; text-align: right; border-bottom: 0.17vw solid #ddd">- Rp ' . number_format($diskon, 0, ',', '.') . '</td>
                </tr>
                <tr>
                    <td style="padding: 1.67% 0; text-align: left;">Pajak (10%)</td>
                    <td style="padding: 1.67% 0; text-align: right;">Rp ' . number_format($pajak, 0, ',', '.') . '</td>
                </tr>
                <tr>
                    <td style="padding: 1.67% 0; text-align: left; font-weight: bold;">Total Biaya</td>
                    <td style="padding: 1.67% 0; text-align: right; font-weight: bold;">Rp ' . number_format($total, 0, ',', '.') . '</td>
                </tr>
            </tbody>
        </table>

        <div style="font-size: 1.33vw; text-align:center;">
        <p><strong>Terima kasih, Datang Kembali</strong> </p>
        </div>
    </div>';
 
	
 
?>
<script>
		window.print();
</script>