<?php
// Data Hotel
$namaHotel = "Hotel Santika";
$alamatHotel = "Jl. Sudirman No. 123, Jakarta Selatan";
$teleponHotel = "021-1234567";
$emailHotel = "info@hotelsantika.com";

// Data Tamu
$namaTamu = "Budi Santoso";
$alamatTamu = "Jl. Gatot Subroto No. 456, Jakarta Selatan";

// Data Reservasi
$nomorReservasi = "123456789";
$tanggalCheckin = "2023-04-01";
$tanggalCheckout = "2023-04-03";
$nomorkamor = 127;
$jenisKamar = "Deluxe Room";
$hargaKamar = 1500000;
$jumlahKamar = 2;

// Hitung Total Biaya
$jumlahMalam = (strtotime($tanggalCheckout) - strtotime($tanggalCheckin)) / (60 * 60 * 24);
$subTotal = $hargaKamar * $jumlahKamar * $jumlahMalam ;
$discount = $subTotal * 0.1;
$totaldiscount = $subTotal - $discount;

$biayaPajak = $totaldiscount * 0.1;
$totalBiaya = $totaldiscount + $biayaPajak;

// Tampilkan Struk Invoice
echo '
<div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 2%; background-color: #fff; border: 1px solid #ddd; font-family: Arial, sans-serif;">
    <h1 style="font-size: 4vw; font-weight: normal; margin-bottom: 1.67%; text-align:center;">Invoice</h1>
    <div style="display: flex; justify-content: space-between; font-size: 1.33vw; margin-bottom: 3.33%;">
         <div>
            <p><strong> Guest:' . $namaTamu . '</strong></p>
            <p>ROOM :' . $nomorkamor . '</p>
            <p>Type : ' . $jenisKamar. '</p>
        </div>
        <div>
            <p><strong>Tanggal Check-in:</strong> ' . date('d F Y', strtotime($tanggalCheckin)) . '</p>
            <p><strong>Tanggal Check-out:</strong> ' . date('d F Y', strtotime($tanggalCheckout)) . '</p>
        </div>
    </div>
    <img src="https://i.ibb.co/nD5gJKT/hotel-logo.png" alt="Hotel Logo" style="display: block; margin: 0 auto 3.33%; width: 25%;">
    <table style="width: 100%; margin-bottom:34%; font-size: 1.33vw; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 1.67% 0; text-align: left; border-bottom: 0.17vw solid #ddd;">Deskripsi</th>
                <th style="padding: 1.67% 0; text-align: right; border-bottom: 0.17vw solid #ddd;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 1.67% 0; text-align: left;">' . $jenisKamar . ' x ' . $jumlahKamar . ' kamar x ' . $jumlahMalam . ' malam</td>
                </tr>
                <tr>
                    <td style="padding: 1.67% 0; text-align: left;">Subtotal</td>
                    <td style="padding: 1.67% 0; text-align: right;">Rp ' . number_format($subTotal, 0, ',', '.') . '</td>
                </tr>
                <tr>
                    <td style="padding: 1.67% 0; text-align: left;">Discount (10%)</td>
                    <td style="padding: 1.67% 0; text-align: right;">Rp ' . number_format($totaldiscount, 0, ',', '.') . '</td>
                </tr>
                <tr>
                    <td style="padding: 1.67% 0; text-align: left;">Pajak (10%)</td>
                    <td style="padding: 1.67% 0; text-align: right;">Rp ' . number_format($biayaPajak, 0, ',', '.') . '</td>
                </tr>
                <tr>
                    <td style="padding: 1.67% 0; text-align: left; font-weight: bold;">Total Biaya</td>
                    <td style="padding: 1.67% 0; text-align: right; font-weight: bold;">Rp ' . number_format($totalBiaya, 0, ',', '.') . '</td>
                </tr>
            </tbody>
        </table>

        <div style="font-size: 1.33vw; text-align:center;">
        <p><strong>Terimaksih, Datang Kembali</strong> </p>
        </div>
    </div>';
    