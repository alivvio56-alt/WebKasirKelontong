<?php $this->load->view('templates/header'); $this->load->view('templates/sidebar'); ?>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header bg-primary text-white fw-bold">Pilih Produk</div>
            <div class="card-body">
                <input type="text" id="searchProduk" class="form-control mb-3" placeholder="Cari nama produk...">
                <div class="row g-2" id="daftarProduk">
                    <?php foreach ($produk as $p): ?>
                    <div class="col-md-6 produk-item" data-nama="<?= strtolower(html_escape($p->nama_produk)) ?>">
                        <form method="post" action="<?= site_url('transaksi/tambah_keranjang') ?>">
                            <input type="hidden" name="id_produk" value="<?= $p->id ?>">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="btn btn-outline-primary w-100 text-start p-3 h-100">
                                <div class="d-flex justify-content-between gap-2">
                                    <div>
                                        <div class="fw-semibold small"><?= html_escape($p->nama_produk) ?></div>
                                        <div class="text-muted" style="font-size:.75rem">Stok: <?= $p->stok ?>, <?= html_escape($p->nama_kategori ?: '-') ?></div>
                                    </div>
                                    <div class="text-success fw-bold small rupiah"><?= rupiah($p->harga_jual) ?></div>
                                </div>
                            </button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
                <span>Keranjang</span>
                <a href="<?= site_url('transaksi/kosongkan') ?>" class="btn btn-sm btn-outline-light" onclick="return confirm('Kosongkan keranjang?')">Kosongkan</a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($keranjang)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-cart-shopping fa-3x mb-3 opacity-25 d-block"></i>
                        Keranjang masih kosong<br>
                        <small>Klik produk di sebelah kiri untuk menambahkan.</small>
                    </div>
                <?php else: ?>
                    <table class="table table-sm mb-0 align-middle">
                        <thead><tr><th>Produk</th><th class="text-center">Qty</th><th class="text-end">Subtotal</th><th></th></tr></thead>
                        <tbody>
                            <?php foreach ($keranjang as $id => $item): ?>
                            <tr>
                                <td>
                                    <div class="fw-semibold small"><?= html_escape($item['nama_produk']) ?></div>
                                    <div class="text-muted small"><?= rupiah($item['harga_satuan']) ?></div>
                                </td>
                                <td class="text-center"><?= $item['qty'] ?></td>
                                <td class="text-end rupiah"><?= rupiah($item['subtotal']) ?></td>
                                <td class="text-end">
                                    <a href="<?= site_url('transaksi/hapus_item/' . $id) ?>" class="btn btn-sm btn-outline-danger">x</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <th colspan="2">Total</th>
                                <th class="text-end rupiah"><?= rupiah($total) ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </div>
            <?php if (!empty($keranjang)): ?>
            <div class="card-footer bg-white">
                <form method="post" action="<?= site_url('transaksi/proses') ?>">
                    <label class="form-label fw-semibold">Uang Bayar</label>
                    <input type="number" name="bayar" class="form-control mb-3" min="<?= $total ?>" placeholder="Masukkan uang bayar" required>
                    <button class="btn btn-success w-100">Simpan Transaksi</button>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.getElementById('searchProduk').addEventListener('keyup', function(){
    const keyword = this.value.toLowerCase();
    document.querySelectorAll('.produk-item').forEach(function(item){
        item.style.display = item.dataset.nama.includes(keyword) ? '' : 'none';
    });
});
</script>

<?php $this->load->view('templates/footer'); ?>
