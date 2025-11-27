<?php
include('function/flappembelian.php');
$flappembelian = new flappembelian();

$status = $_GET['status'] ?? '';  
if ($status == '1') {
 
    include "./view/lap_pembelian.php"; 
}
else if ($status == '2') {
     if (isset($_POST['cetak'])) {  
          $tanggal = $_POST['tanggal'];     
        $bulan   = $_POST['bulan'];      
        $tahun   = $_POST['tahun'];         
        // LAPORAN PER TANGGAL 
        if ($tanggal != "") { 
            $dataku = $flappembelian->lap_pertanggal(tanggal: $tanggal);
            include "./view/lap_pembelian_tanggal.php"; 
          }
          
          
          //    // LAPORAN PER BULAN
          //    // syarat: tanggal kosong, bulan & tahun terisi 
          else if ($tanggal == "" && $bulan != "" && $tahun != "") { 
               $result = $flappembelian->lap_perbulan($bulan, $tahun);
               include "./view/lap_pembelian_bulan.php"; 
        }
 
     //    // LAPORAN PER TAHUN
     //    // syarat: tanggal kosong, bulan kosong, tahun terisi 
     //    else if ($tanggal == "" && $bulan == "" && $tahun != "") { 
     //        $result = $flappembelian->lap_pertahun($tahun);
     //    }
        
    }
    
}

?>