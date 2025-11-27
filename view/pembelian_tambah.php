<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header Form -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Input Pembelian</h5>
            <a href="./index.php?aksi=pembelian&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body Form -->
        <div class="card-body">

            <?php  
            // AMBIL DATA BARANG DARI DATABASE
            $barangList = $fpembelian->ambil_barang();  
            ?>
            
            <form class="form-horizontal" 
                  action="./index.php?aksi=pembelian&status=3" 
                  method="post">

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Pembelian</label>
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
                                    data-nama="<?= $b['nama_barang']; ?>">
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
                    <label class="form-label">Jumlah Beli</label>
                    <input type="number" 
                           class="form-control" 
                           name="jumlah" 
                           placeholder="Masukkan jumlah beli"
                           required>
                </div>

                <!-- HARGA BELI -->
                <div class="mb-3">
                    <label class="form-label">Harga Beli</label>
                    <input type="number" 
                           class="form-control" 
                           name="harga_beli" 
                           placeholder="Masukkan harga beli"
                           required>
                </div>

                <!-- SUPPLIER -->
                <div class="mb-3">
                    <label class="form-label">Nama Supplier</label>
                    <input type="text" 
                           class="form-control" 
                           name="supplier" 
                           placeholder="Masukkan nama supplier">
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
    let nama = this.options[this.selectedIndex].getAttribute("data-nama");
    document.getElementById("nama_barang").value = nama;
});
</script>