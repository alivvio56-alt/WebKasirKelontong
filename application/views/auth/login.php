<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Kasir Kelontong</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<style>
    body {
        background: #fff; /* ubah dari gradient ke putih */
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .login-card {
        border: 0;
        border-radius: 22px;
        box-shadow: 0 20px 60px rgba(0,0,0,.28);
    }

    .login-logo {
        width: 76px;
        height: 76px;
        background: linear-gradient(135deg,#2563eb,#7c3aed);
        color: #fff;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 16px;
    }

    .btn-login {
        background: linear-gradient(135deg,#2563eb,#7c3aed);
        border: 0;
        border-radius: 12px;
        padding: 12px;
        font-weight: 700;
    }

    .form-control, .input-group-text {
        border-radius: 10px;
    }

    .alert {
        border-radius: 12px;
    }
</style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card p-4">
                <div class="text-center mb-4">
                    <div class="login-logo"><i class="fa-solid fa-cart-shopping"></i></div>
                    <h4 class="fw-bold mb-1">Kasir Kelontong</h4>
                    <p class="text-muted small mb-0">Login untuk mengelola transaksi toko</p>
                </div>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger py-2 small">
                        <i class="fa-solid fa-circle-exclamation me-1"></i>
                        <?= html_escape($this->session->flashdata('error')) ?>
                    </div>
                <?php endif; ?>

                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger py-2 small">
                        <i class="fa-solid fa-circle-exclamation me-1"></i>
                        <?= validation_errors('', '') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('auth') ?>" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user text-muted"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="<?= html_escape(set_value('username')) ?>" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock text-muted"></i></span>
                            <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Masukkan password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                <i class="fa-solid fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-login w-100 text-white">Login</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.className = input.type === 'password' ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
}
</script>

</body>
</html>