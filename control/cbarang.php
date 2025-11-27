<?php 	 
include('function/fbarang.php'); 
$fbarang = new fbarang();   


 $status=$_GET['status'];



 if($status=='1') 
 { 
      $dataku = $fbarang->tampil_data();
      include "./view/vbarang.php";   
 }
  else if($status=='2') 
 {    //form tambah barang
      include "./view/barang_tambah.php";   
 }
else if ($status == '3') {
   // Simpan data baru
    if (isset($_POST['simpan'])) {  
        $id_kategori = $_POST['id_kategori']; 
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];    
        $satuan      = $_POST['satuan'];

        $result = $fbarang->input_data($id_kategori, $kode_barang, $nama_barang, $satuan);

        if ($result) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Berhasil menyimpan data barang.'];
        } else {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal menyimpan data barang.'];
        }

        // Refresh kembali ke halaman daftar barang
        echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=barang&status=1'>";
    }
   }
else if ($status == '4') {
            $id=$_GET['id'];
            $dataku = $fbarang->cari_data($id);
            include "./view/barang_ubah.php";   
     
 }

else if ($status == '5') {// Update data barang
    if (isset($_POST['update'])) {
        $id_barang   = $_POST['id_barang'];
        $id_kategori = $_POST['id_kategori']; 
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];    
        $harga_beli  = $_POST['harga_beli'];
        $harga_jual  = $_POST['harga_jual'];
        $stok        = $_POST['stok'];
        $satuan      = $_POST['satuan'];

        $result = $fbarang->ubah_data($id_barang, $id_kategori, $kode_barang, $nama_barang, $harga_beli, $harga_jual, $stok, $satuan);

        if ($result) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data berhasil diubah'];
        } else {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data gagal diubah'];
        }

        echo '<meta http-equiv="refresh" content="1;url=?aksi=barang&status=1">';
    }
}

else if($status=='6') 
{ 
       // Hapus barang
    $id = $_GET['id'];  
    $result = $fbarang->hapus_data($id);  

    if ($result) {  
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data berhasil dihapus'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data gagal dihapus'];
    }

    header('Location: ./index.php?aksi=barang&status=1');
    exit;
            
}

else if ($status=='7')
{
   $dataku = $fbarang->print_barang();
   include "./view/vbarang_print.php";
}

