<?php $this->load->view('templates/header'); $this->load->view('templates/sidebar'); ?>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <strong>Data Produk</strong>
        <a href="<?= site_url('produk/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Produk</a>
    </div>
    <div class="card-body">
        <input type="text" id="searchProduk" class="form-control mb-3" placeholder="Cari produk berdasarkan nama, kode, atau kategori...">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="tabelProduk">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th class="text-end">Harga Beli</th>
                        <th class="text-end">Harga Jual</th>
                        <th class="text-center">Stok</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produk as $p): ?>
                    <tr>
                        <td><?= html_escape($p->kode_produk) ?></td>
                        <td class="fw-semibold"><?= html_escape($p->nama_produk) ?></td>
                        <td><?= html_escape($p->nama_kategori ?: '-') ?></td>
                        <td class="text-end rupiah"><?= rupiah($p->harga_beli) ?></td>
                        <td class="text-end rupiah"><?= rupiah($p->harga_jual) ?></td>
                        <td class="text-center">
                            <span class="badge <?= $p->stok <= 10 ? 'text-bg-danger' : 'text-bg-success' ?>"><?= $p->stok ?></span>
                        </td>
                        <td class="text-end">
                            <a href="<?= site_url('produk/edit/' . $p->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= site_url('produk/hapus/' . $p->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('searchProduk').addEventListener('keyup', function(){
    const keyword = this.value.toLowerCase();
    document.querySelectorAll('#tabelProduk tbody tr').forEach(function(row){
        row.style.display = row.innerText.toLowerCase().includes(keyword) ? '' : 'none';
    });
});
</script>

<?php $this->load->view('templates/footer'); ?>
