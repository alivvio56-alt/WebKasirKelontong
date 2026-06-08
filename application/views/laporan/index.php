<?php $this->load->view('templates/header'); $this->load->view('templates/sidebar'); ?>

<div class="card mb-4">
    <div class="card-header bg-white fw-bold">Filter Laporan</div>
    <div class="card-body">
        <form method="get" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="<?= html_escape($tanggal_mulai) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="<?= html_escape($tanggal_selesai) ?>">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">Tampilkan</button>
                <a href="<?= site_url('laporan') ?>" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <strong>Data Penjualan</strong>
        <span class="badge text-bg-success">Total: <?= rupiah($total_pendapatan) ?></span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th class="text-end">Total</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($laporan)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada transaksi pada periode ini.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($laporan as $row): ?>
                    <tr>
                        <td><?= html_escape($row->no_transaksi) ?></td>
                        <td><?= tanggal_indonesia($row->tanggal) ?></td>
                        <td><?= html_escape($row->nama_user ?: '-') ?></td>
                        <td class="text-end rupiah"><?= rupiah($row->total) ?></td>
                        <td class="text-end">
                            <a href="<?= site_url('transaksi/detail/' . $row->id) ?>" class="btn btn-info btn-sm text-white">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
