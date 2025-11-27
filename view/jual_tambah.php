<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header Form -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Input jual</h5>
            <a href="./index.php?aksi=jual&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body Form -->
        <div class="card-body">

            <?php  
            // AMBIL DATA BARANG DARI DATABASE
            $barangList = $fjual->ambil_barang();  
            ?>
            
            <form class="form-horizontal" 
                  action="./index.php?aksi=jual&status=3" 
                  method="post">

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label">Tanggal jual</label>
                    <input type="date" 
                           class="form-control" 
                           name="tanggal" 
                           required>
                </div>

                <!-- PILIH ID BARANG -->
                <div class="mb-3">
                    <label class="form-label">ID Barang</label>
                    <select class="form-select" 
                            id="id_barang" 
                            name="id_barang" 
                            required>
                        <option value="">-- Pilih ID Barang --</option>

                        <?php foreach ($barangList as $b): ?>
                           <option value="<?= $b['id_barang']; ?>" 
                                data-nama="<?= $b['nama_barang']; ?>"
                                data-harga="<?= $b['harga_beli']; ?>">
                            <?= $b['id_barang']; ?> - <?= $b['nama_barang']; ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- NAMA BARANG OTOMATIS -->
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" 
                           class="form-control" 
                           id="nama_barang" 
                           name="nama_barang" 
                           readonly>
                </div>

                <!-- JUMLAH BELI -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Penjualan</label>
                    <input type="number" 
                           class="form-control" 
                           name="jumlah" 
                           placeholder="Masukkan jumlah penjualan"
                           required>
                </div>

                <!-- HARGA BELI -->
          <div class="mb-3">
    <label class="form-label">Harga Jual </label>
    <input type="number" 
           class="form-control"
           id="harga_jual"
           name="harga_jual"
           readonly>
</div>


                <!-- nama_pembeli -->
                <div class="mb-3">
                    <label class="form-label">Nama pembeli</label>
                    <input type="text" 
                           class="form-control" 
                           name="nama_pembeli" 
                           placeholder="Masukkan nama pembeli">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                <button type="reset" class="btn btn-secondary ms-2">Reset</button>

            </form>

        </div>
    </div>
</div>

<!-- SCRIPT: Auto Isi Nama Barang -->
<script>
document.getElementById("id_barang").addEventListener("change", function() {
    let selected = this.options[this.selectedIndex];

    let nama = selected.getAttribute("data-nama");
    let harga_beli = selected.getAttribute("data-harga");

    // Isi Nama Barang
    document.getElementById("nama_barang").value = nama;

    // Hitung harga jual otomatis → harga beli + 10%
    if (harga_beli) {
        let harga_jual = parseFloat(harga_beli) + (parseFloat(harga_beli) * 0.10);
        document.getElementById("harga_jual").value = Math.round(harga_jual);
    } else {
        document.getElementById("harga_jual").value = "";
    }
});
</script>
