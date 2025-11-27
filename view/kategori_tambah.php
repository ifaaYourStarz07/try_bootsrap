<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header Form -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Input Kategori</h5>
            <a href="./index.php?aksi=kategori&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body Form -->
        <div class="card-body">

            <form class="form-horizontal" 
                  action="./index.php?aksi=kategori&status=3" 
                  method="post">

                <!-- Input Nama Kategori -->
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" 
                           class="form-control" 
                           id="nama_kategori" 
                           name="nama_kategori" 
                           placeholder="Masukkan nama kategori" 
                           required>
                </div>

                <!-- Input Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" 
                           class="form-control" 
                           id="keterangan" 
                           name="keterangan" 
                           placeholder="Masukkan keterangan">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                <button type="reset" class="btn btn-secondary ms-2">Reset</button>
            </form>

        </div>
    </div>
</div>
