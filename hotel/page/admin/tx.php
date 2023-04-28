<?php
require_once('../../lib/config.php');
session_start();
// Ambil API hari libur nasional
$url = 'https://api-harilibur.vercel.app/api';

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
));
$response = curl_exec($curl);

curl_close($curl);

// Ubah json ke array
$array_data = json_decode($response, true);


if(isset($_POST['getTgl'])){
    $getTgl = $_POST['getTgl'];
    $getT = $_POST['getT'];
    //lakukan operasi lain dengan getTgl jika diperlukan
    // Ambil tgl untuk tahun baru
  $getDays = substr($getTgl, 5);

  // mengubah string tanggal menjadi format waktu
  $timestamp = strtotime($getTgl);

  // mengambil informasi hari dari tanggal
  $weekday = date("l", $timestamp);

  // Membuat kondisi untuk membandingkan jika tanggal < 10
  // hilangkan string 0 diawal tanggal
  if ($getTgl[8] == 0) {
    $delKosong = substr($getTgl, 0, 8). substr($getTgl, 9);
    $hasilTgl = $delKosong;
  }  else{
    $hasilTgl = $getTgl;

  }

  $biasa = 'Hari Biasa';
  $besar = 'Hari Besar';
  $weekend = 'Akhir Pekan';
  $tahunBaru = 'Tahun Baru';
  $found = false;

  foreach($array_data as $i=>$value){
    $libur = $value['holiday_date'];
    if ($hasilTgl == $libur) {
      $found = true;
      break;
    }
  };

if ($getDays == '01-01') {
  echo $tahunBaru;
} else if ($found && $weekday == "Saturday" || $weekday == "Sunday") {
    echo $besar;
} else if($found && !($weekday == "Saturday" || $weekday == "Sunday")){
    echo $besar;
} else if(!$found && $weekday == "Saturday" || $weekday == "Sunday"){
    echo $weekend;
} else {
    echo $biasa;
}

}

?>