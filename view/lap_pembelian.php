<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header Form -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Pembelian Barang</h5>
            <a href="./index.php?aksi=pembelian&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body Form -->
        <div class="card-body"> 
            <form class="form-horizontal" 
                  action="./index.php?aksi=laporanbeli&status=2" 
                  method="post">

                <!-- input Tanggal --> 
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>



                 <!-- Pilih Bulan --> 
                <div class="mb-3">
                    <label for="bulan" class="form-label">Bulan</label>
                    <select class="form-select" id="bulan" name="bulan">
                        <option value="">-- Pilih Bulan --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>

 
                <!-- Pilih Tahun --> 
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select class="form-select" id="tahun" name="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>


 
                <!-- Tombol -->
                <button type="submit" class="btn btn-success" name="cetak">Cetak</button>
                <button type="reset" class="btn btn-secondary ms-2">Reset</button>

            </form>

        </div>
    </div>
</div>