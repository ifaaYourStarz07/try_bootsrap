<?php
include('database.php');

class flappembelian extends database {
  // 1. LAPORAN PER TANGGAL 
    public function lap_pertanggal($tanggal)
    { 
        $tanggal = mysqli_real_escape_string($this->koneksi, $tanggal);
        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_pembelian, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_beli,
                   (p.jumlah * p.harga_beli) AS total,
                   p.supplier
            FROM tbl_pembelian p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            WHERE p.tanggal = '$tanggal'
            ORDER BY p.id_pembelian ASC
        ");

        if (!$sql) {
            die('Query Error (pertanggal): ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    // 2. LAPORAN PER BULAN 
    public function lap_perbulan($bulan, $tahun)
    {
        $bulan = mysqli_real_escape_string($this->koneksi, $bulan);
        $tahun = mysqli_real_escape_string($this->koneksi, $tahun);

        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_pembelian, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_beli,
                   (p.jumlah * p.harga_beli) AS total,
                   p.supplier
            FROM tbl_pembelian p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            WHERE MONTH(p.tanggal) = '$bulan'
              AND YEAR(p.tanggal) = '$tahun'
            ORDER BY p.id_pembelian ASC
        ");

        if (!$sql) {
            die('Query Error (perbulan): ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

 
    // 3. LAPORAN PER TAHUN 
    public function lap_pertahun($tahun)
    {
        $tahun = mysqli_real_escape_string($this->koneksi, $tahun); 
        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_pembelian, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_beli,
                   (p.jumlah * p.harga_beli) AS total,
                   p.supplier
            FROM tbl_pembelian p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            WHERE YEAR(p.tanggal) = '$tahun'
            ORDER BY p.id_pembelian ASC
        ");

        if (!$sql) {
            die('Query Error (pertahun): ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }
}
?>