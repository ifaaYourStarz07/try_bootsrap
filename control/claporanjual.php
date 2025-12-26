<?php
include('function/flapjual.php');
$flapjual = new flapjual();

$status = $_GET['status'] ?? '';  
if ($status == '1') {
 
    include "./view/lap_jual.php"; 
}
else if ($status == '2') {

    if (isset($_POST['cetak'])) {  

        $tanggal = $_POST['tanggal'];     
        $bulan   = $_POST['bulan'];      
        $tahun   = $_POST['tahun'];         
        // LAPORAN PER TANGGAL 
        if ($tanggal != "") { 
            $dataku = $flapjual->lap_pertanggal(tanggal: $tanggal);
            include "./view/lap_jual_tanggal.php"; 
        }
 

        // LAPORAN PER BULAN
        else if ($tanggal == "" && $bulan != "" && $tahun != "") { 
            $result = $flapjual->lap_perbulan($bulan, $tahun);
            include "./view/lap_jual_bulan.php";
        }

        // LAPORAN PER TAHUN
        else if ($tanggal == "" && $bulan == "" && $tahun != "") { 
            $result = $flapjual->lap_pertahun($tahun);
            include "./view/lap_jual_tahun.php";
        }

    }
}

?>