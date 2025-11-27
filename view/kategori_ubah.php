<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header Form -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Edit Kategori</h5>
            <a href="./index.php?aksi=kategori&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body Form -->
        <div class="card-body">

           <!-- Horizontal Form -->
              <form class="form-horizontal" action="./index.php?aksi=kategori&status=5" method="post">
                <?php foreach($dataku as $row) { ?> 

                    <!-- Hidden ID Kategori -->
                    <input type="hidden"  class="form-control" value="<?= htmlspecialchars($row['id_kategori']); ?>" name="id_kategori" id="id_kategori">

                    <!-- Nama Kategori -->
                    <div class="row mb-3">
                      <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" 
                               value="<?= htmlspecialchars($row['nama_kategori']); ?>" required>
                      </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="row mb-3">
                      <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" 
                               value="<?= htmlspecialchars($row['keterangan']); ?>">
                      </div>
                    </div>

                <?php } ?>

                <div class="text-center">
                  <button type="submit" id="update" name="update" class="btn btn-primary">Update</button>
                  <button type="reset" class="btn btn-secondary">Clear</button>
                </div>
              </form>

        </div>
    </div>
</div>