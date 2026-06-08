<?php $uri = $this->uri->segment(1) ?: 'dashboard'; ?>
<div class="col-md-2 sidebar">
    <div class="brand-box text-center mb-3">
        <i class="fa-solid fa-cart-shopping me-1"></i> Kasir Kelontong
    </div>
    <div class="small text-secondary text-uppercase mb-2 px-2">Menu</div>
    <a class="<?= $uri == 'dashboard' ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
        <i class="fa-solid fa-gauge me-2"></i> Dashboard
    </a>
    <a class="<?= $uri == 'produk' ? 'active' : '' ?>" href="<?= site_url('produk') ?>">
        <i class="fa-solid fa-box me-2"></i> Produk
    </a>
    <a class="<?= $uri == 'kategori' ? 'active' : '' ?>" href="<?= site_url('kategori') ?>">
        <i class="fa-solid fa-tags me-2"></i> Kategori
    </a>
    <a class="<?= $uri == 'transaksi' ? 'active' : '' ?>" href="<?= site_url('transaksi') ?>">
        <i class="fa-solid fa-cash-register me-2"></i> Transaksi
    </a>
    <a class="<?= $uri == 'laporan' ? 'active' : '' ?>" href="<?= site_url('laporan') ?>">
        <i class="fa-solid fa-chart-line me-2"></i> Laporan
    </a>
    <hr class="text-secondary">
    <a href="<?= site_url('auth/logout') ?>" onclick="return confirm('Keluar dari sistem?')">
        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
    </a>
</div>
<div class="col-md-10 content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0"><?= isset($judul) ? $judul : 'Kasir Kelontong' ?></h3>
            <div class="text-muted small">Sistem Informasi Kasir Toko Kelontong</div>
        </div>
        <div class="text-end small">
            <div class="fw-semibold"><?= $this->session->userdata('nama') ?: $this->session->userdata('username') ?></div>
            <span class="badge text-bg-primary"><?= strtoupper($this->session->userdata('role')) ?></span>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
