<div class="container mt-5">
  <div class="card shadow-sm">

    <!-- Header Card -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tampil Data jual</h5>
      <div class="d-flex gap-2">
      <a href="./index.php?aksi=jual&status=7" class="btn btn-light btn-sm fw-bold">
        + cetak
      </a>
      <a href="./index.php?aksi=jual&status=2" class="btn btn-light btn-sm fw-bold">
        + jual
      </a>
    </div>
</div>

    <?php 
        if(isset($_SESSION['alert'])) {
            $type = $_SESSION['alert']['type'];
            $message = $_SESSION['alert']['message'];
            echo "<div id='autoAlert' class='alert alert-$type alert-dismissible fade show' role='alert'>
                    $message
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
            unset($_SESSION['alert']); // Hapus session setelah ditampilkan
        }
        ?>

    <!-- Body Card -->
    <div class="card-body">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr class="text-center">
            <th scope="col" style="width: 50px;">No</th>
            <th scope="col" style="width: 80px;">ID jual</th>
            <th scope="col">Tanggal</th>
           <th scope="col" style="width: 80px;">ID barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Nama barang</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Total</th>
            <th scope="col">Nama pembeli</th>
            <th scope="col" style="width: 150px;">Aksi</th>
          </tr>
        </thead>

       <tbody>
          <?php 
          if (empty($dataku)) { ?>
              <tr>
                <td colspan="10" class="text-center text-danger fw-bold">
                  Data jual belum ada...
                </td>
              </tr>
          <?php 
          } else {
              $no = 1;
              foreach ($dataku as $row) { ?>
                <tr>
                  <td class="text-center"><?= $no++; ?></td>
                  <td class="text-center"><?= htmlspecialchars($row['id_jual']); ?></td>
                  <td><?= htmlspecialchars($row['tanggal']); ?></td>
                  <td class="text-center"><?= htmlspecialchars($row['id_barang']); ?></td>
                  <td><?= htmlspecialchars($row['jumlah']); ?></td>
                  <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                  <td class="text-end"><?= number_format($row['harga_jual'], 2, ',', '.'); ?></td>
                  <td class="text-end"><?= number_format($row['total'], 2, ',', '.'); ?></td>
                  <td class="text-center"><?= htmlspecialchars($row['nama_pembeli']); ?></td>
                  
                  <td class="text-center">
                      <div class="d-flex justify-content-center gap-1">
                          <a href="./index.php?aksi=jual&status=4&id=<?= urlencode($row['id_jual']); ?>" 
                             class="btn btn-warning btn-sm">
                              <i class="bi bi-pencil-square"></i> Edit
                          </a>
                          <a href="./index.php?aksi=jual&status=6&id=<?= urlencode($row['id_jual']); ?>" 
                             class="btn btn-danger btn-sm"
                             onclick="return confirm('Yakin ingin menghapus data ini?');">
                              <i class="bi bi-trash"></i> Hapus
                          </a>
                      </div>
                  </td>
                </tr>
          <?php 
              } 
          } 
          ?>
        </tbody>
      </table>
    </div>

  </div>
</div>