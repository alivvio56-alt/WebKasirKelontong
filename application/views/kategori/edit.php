<?php $this->load->view('templates/header'); $this->load->view('templates/sidebar'); ?>

<div class="card">
    <div class="card-header bg-white fw-bold">Form Edit Kategori</div>
    <div class="card-body">
        <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="<?= set_value('nama_kategori', $kategori->nama_kategori) ?>" required>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="<?= site_url('kategori') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
