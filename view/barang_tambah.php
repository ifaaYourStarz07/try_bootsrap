<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header Form -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Input Barang</h5>
            <a href="./index.php?aksi=barang&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body Form -->
        <div class="card-body">

            <form class="form-horizontal" 
                  action="./index.php?aksi=barang&status=3" 
                  method="post">

                <!-- Pilih Kategori -->
                    <?php
                    $kategoriList = $fbarang->get_kategori(); // atau $fkategori->get_kategori() jika pakai class kategori
                    ?>
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="id_kategori" name="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoriList as $kategori): ?>
                                <option value="<?= $kategori['id_kategori']; ?>" 
                                    <?= (isset($dataku[0]['id_kategori']) && $dataku[0]['id_kategori'] == $kategori['id_kategori']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($kategori['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                <!-- Input Kode Barang -->
                <div class="mb-3">
                    <label for="kode_barang" class="form-label">Kode Barang</label>
                    <input type="text" 
                           class="form-control" 
                           id="kode_barang" 
                           name="kode_barang" 
                           placeholder="Masukkan kode barang" 
                           required>
                </div>

                <!-- Input Nama Barang -->
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" 
                           class="form-control" 
                           id="nama_barang" 
                           name="nama_barang" 
                           placeholder="Masukkan nama barang" 
                           required>
                </div>

                <!-- Input Satuan -->
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" 
                           class="form-control" 
                           id="satuan" 
                           name="satuan" 
                           placeholder="Masukkan satuan, misal pcs/box">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                <button type="reset" class="btn btn-secondary ms-2">Reset</button>

            </form>

        </div>
    </div>
</div>