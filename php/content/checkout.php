<?php
require_once('../lib/Connect.php');

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'keluar') {
    $nama         = $_GET['nama_kamar'];
    $kode       =$_GET['kode_pemesanan'];
    $sql2       = "SELECT stok FROM stok_kamar where nama_kamar = '$nama'";
    $q2         = mysqli_query($connect,$sql2);
    $r2 = mysqli_fetch_array($q2);
    $stok = $r2['stok'];
    $stok = $stok + 1;
    $sql1       = "UPDATE stok_kamar SET stok = '$stok'  where nama_kamar = '$nama' ";
    $q1         = mysqli_query($connect, $sql1);
    $sql3       = "UPDATE pemesanan SET proses = 'SELESAI' where kode_pemesanan = '$kode'";
    $q3         = mysqli_query($connect,$sql3);
    header("refresh:5;url=checkout.php");
}
?>
<div class="card-header text-white bg-dark m-2">
<i class="fa-sharp fa-solid fa-clipboard"></i>
    Daftar Kamar Berlangsung
            </div>
                <div class="card-body m-2">
                <table class="table" id="daftar-saya">
                    <thead>
                        <tr>
                        
                            <th scope="col">Kode Pemesanan</th>
                            <th scope="col">Id Kamar</th>
                            <th scope="col">Tipe kamar</th>
                            <th scope="col">Tanggal Check In</th>
                            <th scope="col">Tanggal Check Out</th>
                            <th scope="col">PROSES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "SELECT * FROM pemesanan where proses = 'Berlangsung'";
                        $q2     = mysqli_query($connect, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $kodepemesanan         = $r2['kode_pemesanan'];
                            $idtipekamar       = $r2['id_tipe_kamar'];
                            $namakamar        = $r2['nama_kamar'];
                            $checkin       = $r2['tgl_check_in'];
                            $checkout    = $r2['tgl_check_out'];
                            $total      = $r2['total_harga'];

                        
                            

                        ?>
                            <tr class="table-info">    
                                <td scope="row"><?php echo $kodepemesanan ?></td>
                                <td scope="row"><?php echo $idtipekamar ?></td>
                                <td scope="row"><?php echo $namakamar ?></td>
                                <td scope="row"><?php echo $checkin ?></td>
                                <td scope="row"><?php echo $checkout ?></td>
                                <td scope="row">
                                    <a href="checkout.php?op=keluar&nama_kamar=<?php echo $namakamar ?>&kode_pemesanan=<?php echo $kodepemesanan ?>"><button type="button" class="btn btn-success btn-sm">Check Out</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
                </div>

