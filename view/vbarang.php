<div class="container mt-5">
  <div class="card shadow-sm">

    <!-- Header Card -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tampil Data Barang</h5>
      <div class="d-flex gap-2">
          <a href="#" onclick="printDiv()" class="btn btn-light btn-sm fw-bold">
        <i class="bi bi-printer-fill me-1"></i> Print
      </a>
      <!-- <a href="./index.php?aksi=kategori&status=2" class="btn btn-light btn-sm fw-bold">
        Back
      </a> -->
      <a href="./index.php?aksi=kategori&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
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
            <th scope="col" style="width: 80px;">ID Barang</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Kategori</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Stok</th>
            <th scope="col">Satuan</th>
            <th scope="col" style="width: 150px;">Aksi</th>
          </tr>
        </thead>

       <tbody>
          <?php 
          if (empty($dataku)) { ?>
              <tr>
                <td colspan="10" class="text-center text-danger fw-bold">
                  Data barang belum ada...
                </td>
              </tr>
          <?php 
          } else {
              $no = 1;
              foreach ($dataku as $row) { ?>
                <tr>
                  <td class="text-center"><?= $no++; ?></td>
                  <td class="text-center"><?= htmlspecialchars($row['id_barang']); ?></td>
                  <td><?= htmlspecialchars($row['kode_barang']); ?></td>
                  <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                  <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                  <td class="text-end"><?= number_format($row['harga_beli'], 2, ',', '.'); ?></td>
                  <td class="text-end"><?= number_format($row['harga_jual'], 2, ',', '.'); ?></td>
                  <td class="text-center"><?= htmlspecialchars($row['stok']); ?></td>
                  <td><?= htmlspecialchars($row['satuan']); ?></td>
                  
                  <td class="text-center">
                      <div class="d-flex justify-content-center gap-1">
                          <a href="./index.php?aksi=barang&status=4&id=<?= urlencode($row['id_barang']); ?>" 
                             class="btn btn-warning btn-sm">
                              <i class="bi bi-pencil-square"></i> Edit
                          </a>
                          <a href="./index.php?aksi=barang&status=6&id=<?= urlencode($row['id_barang']); ?>" 
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