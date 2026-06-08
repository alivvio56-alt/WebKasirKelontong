<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-1">Detail Transaksi</h4>
            <div class="text-muted small">Sistem Informasi Kasir Toko Kelontong</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Nota Transaksi</strong>
            <div>
                <a href="<?= site_url('transaksi') ?>" class="btn btn-primary btn-sm">Transaksi Baru</a>
                <button onclick="window.print()" class="btn btn-secondary btn-sm">Cetak</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-1">Toko Kelontong</h5>
                    <div class="text-muted small">Sistem Informasi Kasir Toko Kelontong</div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div><strong>No:</strong> <?= html_escape($transaksi->no_transaksi) ?></div>
                    <div><strong>Tanggal:</strong> <?= tanggal_indonesia($transaksi->tanggal) ?></div>
                    <div><strong>Kasir:</strong> <?= html_escape($transaksi->nama_user ?: '-') ?></div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-end">Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail as $d): ?>
                        <tr>
                            <td><?= html_escape($d->nama_produk) ?></td>
                            <td class="text-end rupiah"><?= rupiah($d->harga_satuan) ?></td>
                            <td class="text-center"><?= $d->qty ?></td>
                            <td class="text-end rupiah"><?= rupiah($d->subtotal) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th class="text-end rupiah"><?= rupiah($transaksi->total) ?></th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Bayar</th>
                            <th class="text-end rupiah"><?= rupiah($transaksi->bayar) ?></th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Kembalian</th>
                            <th class="text-end rupiah"><?= rupiah($transaksi->kembalian) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .sidebar,
    .navbar,
    .topbar,
    .btn,
    .menu,
    aside,
    nav {
        display: none !important;
    }

    body, .container, .container-fluid, .card {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        box-shadow: none !important;
    }

    .card {
        border: none !important;
    }
}
</style>

<?php $this->load->view('templates/footer'); ?>