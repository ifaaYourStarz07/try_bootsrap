<?php 
include('database.php'); 

class fjual extends database { 

    
    // ==== TAMPIL DATA jual ====
    public function tampil_jual() {
        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_jual, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_jual,
                   (p.jumlah * p.harga_jual) AS total,
                   p.nama_pembeli
            FROM tbl_jual p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            ORDER BY p.id_jual ASC
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
    $sql = mysqli_query($this->koneksi, "
        SELECT id_barang, nama_barang, harga_beli, harga_jual 
        FROM tbl_barang 
        ORDER BY nama_barang ASC
    ");

    $data = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }
    return $data;
}


function input_jual($tanggal, $id_barang, $jumlah, $harga_jual, $nama_pembeli)
    {
        $tanggal     = mysqli_real_escape_string($this->koneksi, $tanggal);
        $id_barang   = (int)$id_barang;
        $jumlah      = (int)$jumlah;
        $harga_jual  = (float)$harga_jual;
        $nama_pembeli    = mysqli_real_escape_string($this->koneksi, $nama_pembeli);

        // --- Hitung harga jual = harga beli + 10% ---
        $harga_jual = $harga_jual + ($harga_jual * 0.10);

        // =====================================================
        // 1) Insert ke tbl_jual
        // =====================================================
        $queryjual = "
            INSERT INTO tbl_jual (tanggal, id_barang, jumlah, harga_jual, nama_pembeli)
            VALUES ('$tanggal', '$id_barang', '$jumlah', '$harga_jual', '$nama_pembeli')
        ";

        $insertjual = mysqli_query($this->koneksi, $queryjual);

        if (!$insertjual) {
            echo "Gagal simpan jual: " . mysqli_error($this->koneksi);
            return false;
        }

        // =====================================================
        // 2) Update barang: tambah stok - update harga beli + harga jual
        // =====================================================
        $queryUpdateBarang = "
            UPDATE tbl_barang 
            SET 
                stok       = stok - $jumlah,
                harga_jual = $harga_jual,
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
    // ===== Hapus data jual =====
    public function hapus_data($id_jual)
    {
        $id_jual = mysqli_real_escape_string($this->koneksi, $id_jual);

        // 1. Ambil ID barang yang terkait dengan jual
        $queryGet = "SELECT id_barang FROM tbl_jual WHERE id_jual='$id_jual'";
        $resultGet = mysqli_query($this->koneksi, $queryGet);
        $data = mysqli_fetch_assoc($resultGet);

        if (!$data) {
            echo "Data jual tidak ditemukan.";
            return false;
        }

        $id_barang = $data['id_barang'];
         $jumlah = $data['jumlah'];

        // 2. Hapus data jual
        $queryhapus = "DELETE FROM tbl_jual WHERE id_jual='$id_jual'";
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



    // ===== Tampilkan semua data jual =====
    function tampil_data()
    {
        $sql = mysqli_query($this->koneksi, "
            SELECT b.*, k.nama_barang 
            FROM tbl_jual b
            LEFT JOIN tbl_barang k ON b.id_barang = k.id_barang
            ORDER BY b.id_jual ASC
        ");

        if (!$sql) {
            die("Query gagal: " . mysqli_error($this->koneksi));
        }

        $number = mysqli_num_rows($sql);
        if ($number == 0) {
            echo "<div class='alert alert-warning text-center'>Data jual belum ada...</div>";
            return []; 
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // ===== Input data jual =====
    function input_data($id_barang, $tanggal, $jumlah, $harga_jual, $total, $nama_pembeli) {   
       $id_barang = (int)$id_barang;
        $tanggal = mysqli_real_escape_string($this->koneksi, $tanggal);
        $jumlah = mysqli_real_escape_string($this->koneksi, $jumlah);
        $harga_jual     = mysqli_real_escape_string($this->koneksi, $harga_jual);
        $total = mysqli_real_escape_string($this->koneksi, $total);
        $nama_pembeli    = mysqli_real_escape_string($this->koneksi, $nama_pembeli);

        $query = "INSERT INTO tbl_jual 
                (id_barang, tanggal, jumlah, harga_jual, total, nama_pembeli) 
                VALUES ('$id_barang', '$tanggal', '$jumlah', '$harga_jual', '$total', '$nama_pembeli')";

        $result = mysqli_query($this->koneksi, $query);

        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }


    // ===== Cari data jual berdasarkan ID =====
    public function cari_data($id_jual){ 
        $id_jual = mysqli_real_escape_string($this->koneksi, $id_jual);
        $sql = mysqli_query($this->koneksi, "
            SELECT b.*, k.nama_barang 
            FROM tbl_jual b
            LEFT JOIN tbl_barang k ON b.id_barang = k.id_barang
            WHERE b.id_jual='$id_jual'
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

    // ===== Ubah data jual =====
    public function ubah_data($id_jual, $id_barang, $tanggal, $jumlah, $harga_jual, $total, $nama_pembeli){   
       $query = "UPDATE tbl_jual 
                  SET id_barang='$id_barang',
                      tanggal='$tanggal',
                      jumlah='$jumlah',
                      harga_jual='$harga_jual',
                      total='$total',
                      nama_pembeli='$nama_pembeli'
                  WHERE id_jual='$id_jual'"; 

        $result = mysqli_query($this->koneksi, $query); 
        if($result){
            return true;
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }

    // // ===== Hapus data jual =====
    // public function hapus_data($id_jual){ 
    //     $id_jual = mysqli_real_escape_string($this->koneksi, $id_jual);
    //     $queryhapus = "DELETE FROM tbl_jual WHERE id_jual='$id_jual'";
    //     $deleteResult = mysqli_query($this->koneksi, $queryhapus);  

    //     if ($deleteResult) {
    //         return true; 
    //     } else {
    //         echo "Error: " . mysqli_error($this->koneksi);
    //         return false;
    //     }
    // }

    public function print_jual() {
        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_jual, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_jual,
                   (p.jumlah * p.harga_jual) AS total,
                   p.nama_pembeli
            FROM tbl_jual p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            ORDER BY p.id_jual ASC
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