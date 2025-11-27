<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header Form -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Edit Barang</h5>
            <a href="./index.php?aksi=barang&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body Form -->
        <div class="card-body">

            <form class="form-horizontal" 
                  action="./index.php?aksi=barang&status=5" 
                  method="post">

                <!-- Hidden field untuk ID Barang -->
                <input type="text" readonly name="id_barang" value="<?= htmlspecialchars($dataku[0]['id_barang']); ?>">

                <!-- Pilih Kategori -->
                <?php $kategoriList = $fbarang->get_kategori(); ?>
                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="id_kategori" name="id_kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategoriList as $kategori): ?>
                            <option value="<?= $kategori['id_kategori']; ?>" 
                                <?= ($dataku[0]['id_kategori'] == $kategori['id_kategori']) ? 'selected' : ''; ?>>
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
                           value="<?= htmlspecialchars($dataku[0]['kode_barang']); ?>" 
                           required>
                </div>

                <!-- Input Nama Barang -->
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" 
                           class="form-control" 
                           id="nama_barang" 
                           name="nama_barang" 
                           value="<?= htmlspecialchars($dataku[0]['nama_barang']); ?>" 
                           required>
                </div>

                <!-- Input Harga Beli -->
                <div class="mb-3">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input type="number" 
                           class="form-control" 
                           id="harga_beli" 
                           name="harga_beli" 
                           value="<?= htmlspecialchars($dataku[0]['harga_beli']); ?>" 
                           step="0.01" required>
                </div>

                <!-- Input Harga Jual -->
                <div class="mb-3">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input type="number" 
                           class="form-control" 
                           id="harga_jual" 
                           name="harga_jual" 
                           value="<?= htmlspecialchars($dataku[0]['harga_jual']); ?>" 
                           step="0.01" required>
                </div>

                <!-- Input Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" 
                           class="form-control" 
                           id="stok" 
                           name="stok" 
                           value="<?= htmlspecialchars($dataku[0]['stok']); ?>" 
                           required>
                </div>

                <!-- Input Satuan -->
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" 
                           class="form-control" 
                           id="satuan" 
                           name="satuan" 
                           value="<?= htmlspecialchars($dataku[0]['satuan']); ?>">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-warning" name="update">Update</button>
                <a href="./index.php?aksi=barang&status=1" class="btn btn-secondary ms-2">Batal</a>

            </form>

        </div>
    </div>
</div>