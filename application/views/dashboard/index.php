<?php $this->load->view('templates/header'); $this->load->view('templates/sidebar'); ?>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Total Produk</div>
            <div class="h3 fw-bold mb-0"><?= $total_produk ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Stok Menipis</div>
            <div class="h3 fw-bold mb-0"><?= $stok_menipis ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Transaksi Hari Ini</div>
            <div class="h3 fw-bold mb-0"><?= $transaksi_hari_ini ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Pendapatan Hari Ini</div>
            <div class="h5 fw-bold mb-0 rupiah"><?= rupiah($pendapatan_hari_ini) ?></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-white fw-bold">Produk Terbaru</div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Produk</th><th>Kategori</th><th class="text-end">Stok</th></tr></thead>
                    <tbody>
                        <?php foreach ($produk_terbaru as $p): ?>
                        <tr>
                            <td><?= html_escape($p->nama_produk) ?></td>
                            <td><?= html_escape($p->nama_kategori ?: '-') ?></td>
                            <td class="text-end"><?= $p->stok ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-white fw-bold">Transaksi Terbaru</div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>No</th><th>Tanggal</th><th class="text-end">Total</th></tr></thead>
                    <tbody>
                        <?php foreach ($transaksi_terbaru as $t): ?>
                        <tr>
                            <td><a href="<?= site_url('transaksi/detail/' . $t->id) ?>"><?= html_escape($t->no_transaksi) ?></a></td>
                            <td><?= tanggal_indonesia($t->tanggal) ?></td>
                            <td class="text-end rupiah"><?= rupiah($t->total) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
