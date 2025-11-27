<?php 	 
include('function/fpembelian.php'); 
$fpembelian = new fpembelian();   


 $status=$_GET['status'];



 if($status=='1') 
 { 
      $dataku = $fpembelian->tampil_data();
      include "./view/vpembelian.php";   
 }
  else if($status=='2') 
 { 
      include "./view/pembelian_tambah.php";   
 }
else if ($status == '3') {
// Simpan pembelian baru
    if (isset($_POST['simpan'])) {

        // --- Validasi dasar ---
        $tanggal    = !empty($_POST['tanggal']) ? $_POST['tanggal'] : null;
        $id_barang  = !empty($_POST['id_barang']) ? (int)$_POST['id_barang'] : 0;
        $jumlah     = !empty($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;
        $harga_beli = !empty($_POST['harga_beli']) ? (float)$_POST['harga_beli'] : 0;
        $supplier   = !empty($_POST['supplier']) ? $_POST['supplier'] : '';

        // Cek form wajib diisi
        if ($tanggal == null || $id_barang == 0 || $jumlah == 0 || $harga_beli == 0) {
            $_SESSION['alert'] = [
                'type' => 'danger',
                'message' => 'Semua field wajib diisi!'
            ];
            echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=pembelian&status=2'>";
            exit;
        }

        // Jalankan function simpan pembelian
        $result = $fpembelian->input_pembelian($tanggal, $id_barang, $jumlah, $harga_beli, $supplier);

        if ($result) {
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Pembelian berhasil disimpan'
            ];
        } else {
            $_SESSION['alert'] = [
                'type' => 'danger',
                'message' => 'Pembelian gagal disimpan'
            ];
        }

        // Redirect setelah 1 detik
        echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=pembelian&status=1'>";
    }
   }
else if ($status == '4') {
         // Hapus pembelian
    $id = $_GET['id'];  
    $result = $fpembelian->hapus_data($id);  

    if ($result) {  
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data berhasil dihapus'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data gagal dihapus'];
    }

    header('Location: ./index.php?aksi=pembelian&status=1');
    exit;
     
 }

else if ($status == '5') {  // update data pembelian
       if (isset($_POST['update'])) {
        $id_pembelian   = $_POST['id_pembelian'];
        $id_barang = $_POST['id_barang']; 
        $tanggal = $_POST['tanggal'];
        $jumlah = $_POST['jumlah'];    
        $harga_beli  = $_POST['harga_beli'];
        $total  = $_POST['total'];
        $supplier       = $_POST['supplier'];


        $result = $fpembelian->ubah_data($id_pembelian, $id_barang, $tanggal, $jumlah, $harga_beli, $total, $supplier);

        if ($result) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data berhasil diubah'];
        } else {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data gagal diubah'];
        }

        echo '<meta http-equiv="refresh" content="1;url=?aksi=pembelian&status=1">';
    }
}

else if($status=='6') 
{ 
        $id=$_GET['id'];  
        $result=$fpembelian->hapus_data($id);  
        if($result)
        {  
             $_SESSION['alert'] = $result ;
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data berhasil dihapus'];
        }
        else
        {
           $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data gagal dihapus'];
        }
           //  echo '<meta http-equiv="refresh" content="1;url=?aksi=pembelian&status=1">';
            header('Location: ./index.php?aksi=pembelian&status=1');
            exit;
            
}

else if ($status=='7')
{
   $dataku = $fpembelian->print_pembelian();
   include "./view/vpembelian_print.php";
}

// if(isset($_GET['xaksi']))
// { 
//   $status=$_GET['yaksi']; 

// 	if($status=='1') 
// 	{ 

//       $dataku = $fguru->tampil_data();
//       include "./view/vguru.php";   
// 	}

//   if($status=='2') 
//   {  
//       include "./view/vguru_add.php";   
//   }
  
//   if($status=='3')   // simpan tambah data slide
//       {  
//           if (isset($_POST['simpan']))
//            {  
//                 $nama_guru=$_POST['nama_guru']; 
//                 $email=$_POST['email'];   
//                 $alamat=$_POST['alamat'];   
//                 $telepon=$_POST['telepon'];    

//               // exit;
//                  //poses upload gambar
//                   $target_dir = "../images/guru/";
//                   $gambar = $_FILES['gambar']['name'];
//                   $temp_name = $_FILES['gambar']['tmp_name'];
//                   $imageFileType = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));



//                   // Membuat nama unik untuk file gambar yang akan disimpan
//                   $newFileName = uniqid() . '.' . $imageFileType;
//                   $target_file = $target_dir . $newFileName;

//               // Validasi tipe file yang diperbolehkan
//                   $allowed_file_types = ['jpg', 'jpeg', 'png'];
//                   if (!in_array($imageFileType, $allowed_file_types)) {
//                       echo '<div class="alert alert-danger">Hanya file JPG, JPEG, dan PNG yang diperbolehkan.</div>';
//                   } else {
//                       // Cek apakah file sudah terupload
//                       if (move_uploaded_file($temp_name, $target_file)) {
  
//                           // Simpan data ke database, dengan nama file gambar yang baru
//                           $result = $fguru->input_data($nama_guru, $email,$alamat, $telepon, $newFileName);

//                           if ($result) {
//                               echo '<div class="alert alert-success">Data berhasil ditambah</div>';
//                           } else {
//                               echo '<div class="alert alert-danger">Data gagal ditambah</div>';
//                           }

//                           // Refresh halaman setelah 1 detik
//                           echo '<meta http-equiv="refresh" content="1;url=?aksi=Master&xaksi=guru&yaksi=1">';
//                       } else {
//                           echo '<div class="alert alert-danger">Gagal mengupload gambar.</div>';
//                       }
//                   }
//               }
 
//       }
 
   
//      if($status=='4') 
//       	{ 
//                 $id=$_GET['id'];
//                 $result=$fguru->hapus_data($id);  
//                       if($result)
//                         {  
//                             echo'<div class="alert alert-success">Data Berhasil dihapus</div>';
//                         }
//                         else
//                         {
//                           echo'<div class="alert alert-danger">Data gagal dihapus</div>';  
//                          }
//                           echo '<meta http-equiv="refresh" content="1;url=?aksi=Master&xaksi=guru&yaksi=1">';  
       
//       	}
 

//         if($status=='5') 
//         { 
//             $id=$_GET['id'];
//             $dataku = $fguru->cari_data($id);
//             include "./view/vguru_ubah.php";   
//         }


//      if($status=='6')  // ubah data SPP
//           {   

//             if (isset($_POST['update'])) {
//                 $id = $_POST['id'];
//                 $nama_guru=$_POST['nama_guru']; 
//                 $email=$_POST['email'];   
//                 $alamat=$_POST['alamat'];   
//                 $telepon=$_POST['telepon'];    
//                 $gambar_lama = $_POST['gambar_lama']; // File gambar lama dari database
         

//                 // Cek jika ada gambar baru yang diupload
//                 if ($_FILES['gambar']['name']) {
//                     $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/profile/images/guru/";
//                     $gambar_baru = $_FILES['gambar']['name'];
//                     $temp_name = $_FILES['gambar']['tmp_name'];
//                     $imageFileType = strtolower(pathinfo($gambar_baru, PATHINFO_EXTENSION));

//                     // Membuat nama unik untuk file gambar baru
//                     $newFileName = uniqid() . '.' . $imageFileType;
//                     $target_file = $target_dir . $newFileName;

//                     // Validasi tipe file yang diperbolehkan
//                     $allowed_file_types = ['jpg', 'jpeg', 'png'];
//                     if (!in_array($imageFileType, $allowed_file_types)) {
//                         echo '<div class="alert alert-danger">Hanya file JPG, JPEG, dan PNG yang diperbolehkan.</div>';
//                     } else {
//                         // Cek apakah file sudah terupload
//                         if (move_uploaded_file($temp_name, $target_file)) {
//                             // Hapus gambar lama dari folder jika ada
//                             $filePathLama = $target_dir . $gambar_lama;
//                             if (file_exists($filePathLama)) {
//                                 unlink($filePathLama);
//                             }

//                             // Update data di tabel, termasuk nama gambar baru
//                             $result = $fguru->ubah_data($id, $nama_guru, $email, $alamat, $telepon, $newFileName);
                           
//                             if ($result) {
//                                 echo '<div class="alert alert-success">Data berhasil diubah.</div>';
//                             } else {
//                                 echo '<div class="alert alert-danger">Data gagal diubah.</div>';
//                             }
//                         } else {
//                             echo '<div class="alert alert-danger">Gagal mengupload gambar baru.</div>';
//                         }
//                     }
//                 } else {
//                     // Jika tidak ada gambar baru yang diupload, gunakan gambar lama
//                     $result = $fguru->ubah_data($id, $nama_guru, $email, $alamat, $telepon, $gambar_lama);
//                     if ($result) {
//                         echo '<div class="alert alert-success">Data berhasil diubah.</div>';
//                     } else {
//                         echo '<div class="alert alert-danger">Data gagal diubah.</div>';
//                     }
//                 }

//                 // Refresh halaman setelah 1 detik
//                 echo '<meta http-equiv="refresh" content="1;url=?aksi=Master&xaksi=guru&yaksi=1">';
//             }

//           }
//} 
