<div class="container mt-5">
  <div class="card shadow-sm">

    <!-- Header Card -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tampil Data pembelian</h5>
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
    <div class="card-body" id="printArea">
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

<script>
function printDiv() {
   var isi = document.getElementById("printArea").innerHTML;

   var printWindow = window.open('', '', 'width=850,height=1100');

    printWindow.document.write('<html><head>');
    printWindow.document.write('<title>Data Kategori</title>');
    printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h3 class="text-center mb-3">Data Kategori</h3>');
    printWindow.document.write(isi);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>