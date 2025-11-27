<?php 
include('database.php'); 
class fkategori extends  database {   


function tampil_data()
{
    $sql = mysqli_query($this->koneksi, "SELECT * FROM tbl_kategori ORDER BY id_kategori ASC");
    // Cek apakah query berhasil
    if (!$sql) {
        die("Query gagal: " . mysqli_error($this->koneksi));
    }
    $number = mysqli_num_rows($sql);
    if ($number == 0) {
        echo "<div class='alert alert-warning text-center'>Data kategori belum ada...</div>";
        return []; // kembalikan array kosong agar aman saat dipanggil
    }
    $hasil = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $hasil[] = $row;
    }
    return $hasil;
}


// ===== Tambahkan fungsi input_data untuk tbl_kategori =====
    function input_data($nama_kategori, $keterangan) {   
        $query = "INSERT INTO tbl_kategori (nama_kategori, keterangan) 
                  VALUES ('$nama_kategori', '$keterangan')";
        $result = mysqli_query($this->koneksi, $query);

        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        } 
        $this->koneksi->close(); 
    }   

  //cari data   
public function cari_data ($id){ 
        $sql = mysqli_query($this->koneksi,"select * from tbl_kategori where id_kategori='$id'"); 
        $number = mysqli_num_rows($sql);
        if ($number==0) {  echo "Data tidak ditemukan..."; exit; } 
        while ($d = mysqli_fetch_array($sql,MYSQLI_ASSOC))
        {
            $result[] = $d;
        } 
        return $result;
    } 

public function ubah_data($id_kategori, $nama_kategori, $keterangan){   
    $result = mysqli_query(
        $this->koneksi,
        "UPDATE tbl_kategori 
         SET nama_kategori='$nama_kategori',
             keterangan='$keterangan' 
         WHERE id_kategori='$id_kategori'"
    ); 

    if($result){
        return true;
    }else{
        return false;
    } 

    $this->koneksi->close(); 
}

public function hapus_data($id_kategori){ 
    // Hapus data kategori dari database
    $queryhapuskategori = "DELETE FROM tbl_kategori WHERE id_kategori='$id_kategori'";
    $deleteResult = mysqli_query($this->koneksi, $queryhapuskategori);  
    if ($deleteResult) {
        return true; // Berhasil menghapus data
    } else {
        return false; // Gagal menghapus data
    }
}

function print_kategori()
{
    $sql = mysqli_query($this->koneksi, "SELECT * FROM tbl_kategori ORDER BY id_kategori ASC");
    // Cek apakah query berhasil
    if (!$sql) {
        die("Query gagal: " . mysqli_error($this->koneksi));
    }
    $number = mysqli_num_rows($sql);
    if ($number == 0) {
        echo "<div class='alert alert-warning text-center'>Data kategori belum ada...</div>";
        return []; // kembalikan array kosong agar aman saat dipanggil
    }
    $hasil = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $hasil[] = $row;
    }
    return $hasil;
}

//  function hapus_data($id){ 
//  	// Ambil nama file gambar yang akan dihapus
//     $query = "SELECT gambar FROM tbl_guru WHERE id='$id'";
//     $result = mysqli_query($this->koneksi, $query);
//     $data = mysqli_fetch_assoc($result);
    
//     if ($data) {
//         $gambar = $data['gambar'];

//         // Hapus data dari database
//         $deleteQuery = "DELETE FROM tbl_guru WHERE id='$id'";
//         $deleteResult = mysqli_query($this->koneksi, $deleteQuery);  
//         if ($deleteResult) {
//             // Tentukan path lengkap file gambar
//             $filePath = $_SERVER['DOCUMENT_ROOT'] . "/profile/images/guru/" . $gambar; 

//             // Cek apakah file gambar ada, lalu hapus
//             if (file_exists($filePath)) {
//                 unlink($filePath); // Hapus file gambar dari folder
//             }

//             return true; // Berhasil menghapus data dan file gambar
//         } else {
//             return false; // Gagal menghapus data dari database
//         }
//     } else {
//         return false; // Gagal menemukan data dengan ID yang diberikan
//     } 
// }

 // function ubah_data($id,$nama_guru,$email,$alamat,$telepon,$gambar){  
 //  $id_user=$_SESSION['id_user']; 	 
 // $result = mysqli_query($this->koneksi,"update  tbl_guru 
 // 	set  nama_guru='$nama_guru',email='$email',alamat='$alamat',telepon='$telepon',gambar='$gambar',id_user='$id_user'  where id='$id'"); 
 //        if($result){
 //            return true;
 //        }else{
 //            return false;
 //        } 
 //   	   $this->koneksi->close(); 
// 	}	

   
 // public function cari_data ($id){ 
// 		$sql = mysqli_query($this->koneksi,"select * from tbl_guru where id='$id'"); 
// 		$number = mysqli_num_rows($sql);
// 		if ($number==0) {  echo "Data tidak ditemukan..."; exit; } 
// 		while ($d = mysqli_fetch_array($sql,MYSQLI_ASSOC))
// 		{
// 			$result[] = $d;
// 		} 
// 		return $result;
// 	} 

}
?>