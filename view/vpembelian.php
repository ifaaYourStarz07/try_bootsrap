<div class="container mt-5">
  <div class="card shadow-sm">

    <!-- Header Card -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tampil Data pembelian</h5>
      <div class="d-flex gap-2">
      <a href="./index.php?aksi=pembelian&status=7" class="btn btn-light btn-sm fw-bold">
        + cetak data
      </a>
      <a href="./index.php?aksi=pembelian&status=2" class="btn btn-light btn-sm fw-bold">
        + pembelian
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
            <th scope="col" style="width: 80px;">ID pembelian</th>
            <th scope="col">Tanggal</th>
           <th scope="col" style="width: 80px;">ID barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Nama barang</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Total</th>
            <th scope="col">Supplier</th>
            <th scope="col" style="width: 150px;">Aksi</th>
          </tr>
        </thead>

       <tbody>
          <?php 
          if (empty($dataku)) { ?>
              <tr>
                <td colspan="10" class="text-center text-danger fw-bold">
                  Data pembelian belum ada...
                </td>
              </tr>
          <?php 
          } else {
              $no = 1;
              foreach ($dataku as $row) { ?>
                <tr>
                  <td class="text-center"><?= $no++; ?></td>
                  <td class="text-center"><?= htmlspecialchars($row['id_pembelian']); ?></td>
                  <td><?= htmlspecialchars($row['tanggal']); ?></td>
                  <td class="text-center"><?= htmlspecialchars($row['id_barang']); ?></td>
                  <td><?= htmlspecialchars($row['jumlah']); ?></td>
                  <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                  <td class="text-end"><?= number_format($row['harga_beli'], 2, ',', '.'); ?></td>
                  <td class="text-end"><?= number_format($row['total'], 2, ',', '.'); ?></td>
                  <td class="text-center"><?= htmlspecialchars($row['supplier']); ?></td>
                  
                  <td class="text-center">
                      <div class="d-flex justify-content-center gap-1">
                          <a href="./index.php?aksi=pembelian&status=4&id=<?= urlencode($row['id_pembelian']); ?>" 
                             class="btn btn-warning btn-sm">
                              <i class="bi bi-pencil-square"></i> Edit
                          </a>
                          <a href="./index.php?aksi=pembelian&status=6&id=<?= urlencode($row['id_pembelian']); ?>" 
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