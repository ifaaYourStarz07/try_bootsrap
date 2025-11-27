<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header Form -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Edit pembelian</h5>
            <a href="./index.php?aksi=pembelian&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body Form -->
        <div class="card-body">

            <form class="form-horizontal" 
                  action="./index.php?aksi=pembelian&status=5" 
                  method="post">

                <!-- Hidden field untuk ID pembelian -->
                <input type="text" readonly name="id_pembelian" value="<?= htmlspecialchars($dataku[0]['id_pembelian']); ?>">

                <!-- Pilih barang -->
                <?php $barangList = $fpembelian->get_barang(); ?>
                <div class="mb-3">
                    <label for="id_barang" class="form-label">barang</label>
                    <select class="form-select" id="id_barang" name="id_barang" required>
                        <option value="">-- Pilih barang --</option>
                        <?php foreach ($barangList as $barang): ?>
                            <option value="<?= $barang['id_barang']; ?>" 
                                <?= ($dataku[0]['id_barang'] == $barang['id_barang']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($barang['nama_barang']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Input Kode pembelian -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" 
                           class="form-control" 
                           id="tanggal" 
                           name="tanggal" 
                           value="<?= htmlspecialchars($dataku[0]['tanggal']); ?>" 
                           required>
                </div>

                <!-- Input Nama pembelian -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" 
                           class="form-control" 
                           id="jumlah" 
                           name="jumlah" 
                           value="<?= htmlspecialchars($dataku[0]['jumlah']); ?>" 
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
                    <label for="total" class="form-label">Total</label>
                    <input type="number" 
                           class="form-control" 
                           id="total" 
                           name="total" 
                           value="<?= htmlspecialchars($dataku[0]['total']); ?>" 
                           step="0.01" required>
                </div>

                <!-- Input Satuan -->
                <div class="mb-3">
                    <label for="supplier" class="form-label">Supplier</label>
                    <input type="text" 
                           class="form-control" 
                           id="supplier" 
                           name="supplier" 
                           value="<?= htmlspecialchars($dataku[0]['supplier']); ?>">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-warning" name="update">Update</button>
                <a href="./index.php?aksi=pembelian&status=1" class="btn btn-secondary ms-2">Batal</a>

            </form>

        </div>
    </div>
</div>