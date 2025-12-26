<?php 	 
include('function/fkategori.php'); 
$fkategori = new fkategori();   


 $status=$_GET['status'];



 if($status=='1') 
 { 
      $dataku = $fkategori->tampil_data();
      include "./view/vkategori.php";   
 }
  else if($status=='2') 
 { 
      include "./view/kategori_tambah.php";   
 }
else if ($status == '3') {
    // Proses simpan data
    // echo $_POST['nama_kategori'];
    // exit;

    if (isset($_POST['simpan']))
           {  
                $nama_kategori = $_POST['nama_kategori']; 
                $keterangan    = $_POST['keterangan'];    

                $result = $fkategori->input_data($nama_kategori, $keterangan);

                if ($result) {
                   echo "Berhasil menyimpan data kategori.";

                } else {
                  echo "Gagal menyimpan data kategori.";
                }

                // Refresh kembali ke halaman data kategori
                echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=kategori&status=1'>";
   }
}  
else if ($status == '4') {
            $id=$_GET['id'];
            $dataku = $fkategori->cari_data($id);
            include "./view/kategori_ubah.php";   
     
 }

else if ($status == '5') {  // update data kategori
    if (isset($_POST['update'])) {
        $id_kategori = $_POST['id_kategori'];
        $nama_kategori = $_POST['nama_kategori'];
        $keterangan = $_POST['keterangan'];

        // Panggil function ubah_data di class Kategori
        $result = $fkategori->ubah_data($id_kategori, $nama_kategori, $keterangan);

   if($result)
        {  
             $_SESSION['alert'] = $result ;
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data berhasil diubah'];
        }
        else
        {
           $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data gagal diubah'];
        }
           //  echo '<meta http-equiv="refresh" content="1;url=?aksi=kategori&status=1">';
            header('Location: ./index.php?aksi=kategori&status=1');
            exit;
    }
}

else if($status=='6') 
{ 
        $id=$_GET['id'];  
        $result=$fkategori->hapus_data($id);  
        if($result)
        {  
             $_SESSION['alert'] = $result ;
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data berhasil dihapus'];
        }
        else
        {
           $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data gagal dihapus'];
        }
           //  echo '<meta http-equiv="refresh" content="1;url=?aksi=kategori&status=1">';
            header('Location: ./index.php?aksi=kategori&status=1');
            exit;
            
}  

else if ($status=='7')
{
   $dataku = $fkategori->print_kategori();
   include "./view/vkategori_print.php";
}