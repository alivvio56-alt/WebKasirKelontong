<?php $this->load->view('templates/header'); $this->load->view('templates/sidebar'); ?>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <strong>Data Kategori</strong>
        <a href="<?= site_url('kategori/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th width="80">No</th><th>Nama Kategori</th><th width="180" class="text-end">Aksi</th></tr></thead>
            <tbody>
                <?php $no = 1; foreach ($kategori as $k): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= html_escape($k->nama_kategori) ?></td>
                    <td class="text-end">
                        <a href="<?= site_url('kategori/edit/' . $k->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= site_url('kategori/hapus/' . $k->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
