<?php 
include('database.php'); 

class fbarang extends database {   

public function get_kategori() { 
    $sql = mysqli_query($this->koneksi, "SELECT id_kategori, nama_kategori FROM tbl_kategori ORDER BY nama_kategori ASC"); 
    $result = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $result[] = $row;
    } 
    return $result;
} 


    // ===== Tampilkan semua data barang =====
    function tampil_data()
    {
        $sql = mysqli_query($this->koneksi, "
            SELECT b.*, k.nama_kategori 
            FROM tbl_barang b
            LEFT JOIN tbl_kategori k ON b.id_kategori = k.id_kategori
            ORDER BY b.id_barang ASC
        ");

        if (!$sql) {
            die("Query gagal: " . mysqli_error($this->koneksi));
        }

        $number = mysqli_num_rows($sql);
        if ($number == 0) {
            echo "<div class='alert alert-warning text-center'>Data barang belum ada...</div>";
            return []; 
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // ===== Input data barang =====
    function input_data($id_kategori, $kode_barang, $nama_barang, $satuan) {   
       $id_kategori = (int)$id_kategori;
        $kode_barang = mysqli_real_escape_string($this->koneksi, $kode_barang);
        $nama_barang = mysqli_real_escape_string($this->koneksi, $nama_barang);
        $satuan      = mysqli_real_escape_string($this->koneksi, $satuan);

        $query = "INSERT INTO tbl_barang 
                (id_kategori, kode_barang, nama_barang, satuan) 
                VALUES ('$id_kategori', '$kode_barang', '$nama_barang', '$satuan')";

        $result = mysqli_query($this->koneksi, $query);

        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }


    // ===== Cari data barang berdasarkan ID =====
    public function cari_data($id_barang){ 
        $id_barang = mysqli_real_escape_string($this->koneksi, $id_barang);
        $sql = mysqli_query($this->koneksi, "
            SELECT b.*, k.nama_kategori 
            FROM tbl_barang b
            LEFT JOIN tbl_kategori k ON b.id_kategori = k.id_kategori
            WHERE b.id_barang='$id_barang'
        "); 

        $number = mysqli_num_rows($sql);
        if ($number == 0) {  
            echo "Data tidak ditemukan..."; 
            exit; 
        } 

        $result = [];
        while ($d = mysqli_fetch_assoc($sql)) {
            $result[] = $d;
        } 
        return $result;
    } 

    // ===== Ubah data barang =====
    public function ubah_data($id_barang, $id_kategori, $kode_barang, $nama_barang, $harga_beli, $harga_jual, $stok, $satuan){   
       $query = "UPDATE tbl_barang 
                  SET id_kategori='$id_kategori',
                      kode_barang='$kode_barang',
                      nama_barang='$nama_barang',
                      harga_beli='$harga_beli',
                      harga_jual='$harga_jual',
                      stok='$stok',
                      satuan='$satuan'
                  WHERE id_barang='$id_barang'"; 

        $result = mysqli_query($this->koneksi, $query); 
        if($result){
            return true;
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }

    // ===== Hapus data barang =====
    public function hapus_data($id_barang){ 
        $id_barang = mysqli_real_escape_string($this->koneksi, $id_barang);
        $queryhapus = "DELETE FROM tbl_barang WHERE id_barang='$id_barang'";
        $deleteResult = mysqli_query($this->koneksi, $queryhapus);  

        if ($deleteResult) {
            return true; 
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }

    
    function print_barang()
    {
        $sql = mysqli_query($this->koneksi, "
            SELECT b.*, k.nama_kategori 
            FROM tbl_barang b
            LEFT JOIN tbl_kategori k ON b.id_kategori = k.id_kategori
            ORDER BY b.id_barang ASC
        ");

        if (!$sql) {
            die("Query gagal: " . mysqli_error($this->koneksi));
        }

        $number = mysqli_num_rows($sql);
        if ($number == 0) {
            echo "<div class='alert alert-warning text-center'>Data barang belum ada...</div>";
            return []; 
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
}


?>