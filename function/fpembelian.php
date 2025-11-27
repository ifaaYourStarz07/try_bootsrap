<?php 
include('database.php'); 

class fpembelian extends database { 

    
    // ==== TAMPIL DATA PEMBELIAN ====
    public function tampil_pembelian() {
        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_pembelian, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_beli,
                   (p.jumlah * p.harga_beli) AS total,
                   p.supplier
            FROM tbl_pembelian p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            ORDER BY p.id_pembelian ASC
        ");

        if (!$sql) {
            die('Query Error: ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    public function ambil_barang()
        {
            $sql = mysqli_query($this->koneksi, "SELECT id_barang, nama_barang FROM tbl_barang ORDER BY nama_barang ASC");

            $data = [];
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
            return $data;
        }

function input_pembelian($tanggal, $id_barang, $jumlah, $harga_beli, $supplier)
    {
        $tanggal     = mysqli_real_escape_string($this->koneksi, $tanggal);
        $id_barang   = (int)$id_barang;
        $jumlah      = (int)$jumlah;
        $harga_beli  = (float)$harga_beli;
        $supplier    = mysqli_real_escape_string($this->koneksi, $supplier);

        // --- Hitung harga jual = harga beli + 10% ---
        $harga_jual = $harga_beli + ($harga_beli * 0.10);

        // =====================================================
        // 1) Insert ke tbl_pembelian
        // =====================================================
        $queryPembelian = "
            INSERT INTO tbl_pembelian (tanggal, id_barang, jumlah, harga_beli, supplier)
            VALUES ('$tanggal', '$id_barang', '$jumlah', '$harga_beli', '$supplier')
        ";

        $insertPembelian = mysqli_query($this->koneksi, $queryPembelian);

        if (!$insertPembelian) {
            echo "Gagal simpan pembelian: " . mysqli_error($this->koneksi);
            return false;
        }

        // =====================================================
        // 2) Update barang: tambah stok + update harga beli + harga jual
        // =====================================================
        $queryUpdateBarang = "
            UPDATE tbl_barang 
            SET 
                stok       = stok + $jumlah,
                harga_beli = $harga_beli,
                harga_jual = $harga_jual
            WHERE id_barang = $id_barang
        ";

        $updateBarang = mysqli_query($this->koneksi, $queryUpdateBarang);

        if (!$updateBarang) {
            echo "Gagal update barang: " . mysqli_error($this->koneksi);
            return false;
        }

        return true;
    }
    // ===== Hapus data pembelian =====
    public function hapus_data($id_pembelian)
    {
        $id_pembelian = mysqli_real_escape_string($this->koneksi, $id_pembelian);

        // 1. Ambil ID barang yang terkait dengan pembelian
        $queryGet = "SELECT id_barang FROM tbl_pembelian WHERE id_pembelian='$id_pembelian'";
        $resultGet = mysqli_query($this->koneksi, $queryGet);
        $data = mysqli_fetch_assoc($resultGet);

        if (!$data) {
            echo "Data pembelian tidak ditemukan.";
            return false;
        }

        $id_barang = $data['id_barang'];
         $jumlah = $data['jumlah'];

        // 2. Hapus data pembelian
        $queryhapus = "DELETE FROM tbl_pembelian WHERE id_pembelian='$id_pembelian'";
        $deleteResult = mysqli_query($this->koneksi, $queryhapus);

        if (!$deleteResult) {
            echo "Error Delete: " . mysqli_error($this->koneksi);
            return false;
        }

        // 3. Update stok & harga barang
        $queryUpdateBarang = "
            UPDATE tbl_barang 
            SET stok = 0 WHERE id_barang = '$id_barang'
        ";
        $updateResult = mysqli_query($this->koneksi, $queryUpdateBarang);

        if (!$updateResult) {
            echo "Error Update Barang: " . mysqli_error($this->koneksi);
            return false;
        }

        return true;
    }
public function get_barang() { 
    $sql = mysqli_query($this->koneksi, "SELECT id_barang, nama_barang FROM tbl_barang ORDER BY nama_barang ASC"); 
    $result = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $result[] = $row;
    } 
    return $result;
} 


    // ===== Tampilkan semua data pembelian =====
    function tampil_data()
    {
        $sql = mysqli_query($this->koneksi, "
            SELECT b.*, k.nama_barang 
            FROM tbl_pembelian b
            LEFT JOIN tbl_barang k ON b.id_barang = k.id_barang
            ORDER BY b.id_pembelian ASC
        ");

        if (!$sql) {
            die("Query gagal: " . mysqli_error($this->koneksi));
        }

        $number = mysqli_num_rows($sql);
        if ($number == 0) {
            echo "<div class='alert alert-warning text-center'>Data pembelian belum ada...</div>";
            return []; 
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // ===== Input data pembelian =====
    function input_data($id_barang, $tanggal, $jumlah, $harga_beli, $total, $supplier) {   
       $id_barang = (int)$id_barang;
        $tanggal = mysqli_real_escape_string($this->koneksi, $tanggal);
        $jumlah = mysqli_real_escape_string($this->koneksi, $jumlah);
        $harga_beli     = mysqli_real_escape_string($this->koneksi, $harga_beli);
        $total = mysqli_real_escape_string($this->koneksi, $total);
        $supplier    = mysqli_real_escape_string($this->koneksi, $supplier);

        $query = "INSERT INTO tbl_pembelian 
                (id_barang, tanggal, jumlah, harga_beli, total, supplier) 
                VALUES ('$id_barang', '$tanggal', '$jumlah', '$harga_beli', '$total', '$supplier')";

        $result = mysqli_query($this->koneksi, $query);

        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }


    // ===== Cari data pembelian berdasarkan ID =====
    public function cari_data($id_pembelian){ 
        $id_pembelian = mysqli_real_escape_string($this->koneksi, $id_pembelian);
        $sql = mysqli_query($this->koneksi, "
            SELECT b.*, k.nama_barang 
            FROM tbl_pembelian b
            LEFT JOIN tbl_barang k ON b.id_barang = k.id_barang
            WHERE b.id_pembelian='$id_pembelian'
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

    // ===== Ubah data pembelian =====
    public function ubah_data($id_pembelian, $id_barang, $tanggal, $jumlah, $harga_beli, $total, $supplier){   
       $query = "UPDATE tbl_pembelian 
                  SET id_barang='$id_barang',
                      tanggal='$tanggal',
                      jumlah='$jumlah',
                      harga_beli='$harga_beli',
                      total='$total',
                      supplier='$supplier'
                  WHERE id_pembelian='$id_pembelian'"; 

        $result = mysqli_query($this->koneksi, $query); 
        if($result){
            return true;
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }

    // // ===== Hapus data pembelian =====
    // public function hapus_data($id_pembelian){ 
    //     $id_pembelian = mysqli_real_escape_string($this->koneksi, $id_pembelian);
    //     $queryhapus = "DELETE FROM tbl_pembelian WHERE id_pembelian='$id_pembelian'";
    //     $deleteResult = mysqli_query($this->koneksi, $queryhapus);  

    //     if ($deleteResult) {
    //         return true; 
    //     } else {
    //         echo "Error: " . mysqli_error($this->koneksi);
    //         return false;
    //     }
    // }

    public function print_pembelian() {
        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_pembelian, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_beli,
                   (p.jumlah * p.harga_beli) AS total,
                   p.supplier
            FROM tbl_pembelian p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            ORDER BY p.id_pembelian ASC
        ");

        if (!$sql) {
            die('Query Error: ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

}
?>