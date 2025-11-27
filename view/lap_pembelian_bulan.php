<div class="container mt-5">
    <div class="card shadow-sm">

         <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Data Pembelian</h5>
    <div class="d-flex gap-2"> 
      <!-- Tombol Print -->
      <a href="#" onclick="printDiv()" class="btn btn-light btn-sm fw-bold">
        <i class="bi bi-printer-fill me-1"></i> Print
      </a>
      <!-- Tombol Back -->
      <a href="./index.php?aksi=laporanbeli&status=1" class="btn btn-light btn-sm fw-bold">
        <i class="bi bi-arrow-left-circle-fill me-1"></i> Back
      </a>
    </div>
  </div>

        <div class="card-body" id="printArea">

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Pembelian</th>
                        <th>Tanggal</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Total</th>
                        <th>Supplier</th> 
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($dataku as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['id_pembelian']; ?></td>
                        <td><?= $row['tanggal']; ?></td>
                        <td><?= $row['id_barang']; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td><?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                        <td class="fw-bold text-primary">
                            <?= number_format($row['total'], 0, ',', '.'); ?>
                        </td>
                        <td><?= $row['supplier']; ?></td> 
                    </tr>
                    <?php endforeach; ?>
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
    printWindow.document.write('<h3 class="text-center mb-3">Data Pembelian Per Tanggal</h3>');
    printWindow.document.write(isi);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>