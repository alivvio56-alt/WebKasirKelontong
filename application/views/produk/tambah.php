<?php $this->load->view('templates/header'); $this->load->view('templates/sidebar'); ?>

<div class="card">
    <div class="card-header bg-white fw-bold">Form Tambah Produk</div>
    <div class="card-body">
        <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
        <form method="post">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" value="<?= set_value('kode_produk') ?>" placeholder="Contoh: PRD011" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" value="<?= set_value('nama_produk') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-select" required>
                        <option value="">Pilih kategori</option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k->id ?>" <?= set_select('id_kategori', $k->id) ?>><?= html_escape($k->nama_kategori) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= set_value('stok', 0) ?>" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" value="<?= set_value('harga_beli', 0) ?>" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control" value="<?= set_value('harga_jual') ?>" min="1" required>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('produk') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
