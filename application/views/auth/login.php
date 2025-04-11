<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Aplikasi</title>
    <link rel="stylesheet" href="<?= asset_url('css/bootstrap.min.css') ?>"></link>
    <script src="<?= asset_url('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= asset_url('js/sweetalert2@11.js') ?>"></script>
    <script src="<?= asset_url('js/webcam.min.js') ?>"></script>
    <style>
        body {
        background-color: #f8f9fa;
        }

        .login-container {
        max-width: 1200px;
        }

        .form-section {
        padding: 3rem;
        }

        .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .logo-box {
        height: 500px;
        /* background-color: #e2e8f0; */
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        }

        .form-title {
        color: #00AAC1;
        }

        @media (max-width: 992px) {
        .image-section {
            display: none;
        }
        }
    </style>
</head>
<body>
    <div class="container login-container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row bg-white shadow-lg rounded-4 overflow-hidden w-100">
        
        <!-- Form Section -->
        <div class="col-lg-6 col-12 form-section">
            <h1 class="form-title fw-bold mb-2">Sign In</h1>
            <h2 class="h3 mb-4 fw-bold">Endoskopi App</h2>

            <form action="<?= base_url('auth/login') ?>" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                    type="username"
                    class="form-control p-3"
                    id="username"
                    name="username"
                    placeholder="Enter your username"
                    required
                    />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                    type="password"
                    class="form-control p-3"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                    />
                </div>

                <button type="submit" class="btn w-50 py-3 fw-bold" style="background-color: #00AAC1; color: white; font-size: 20px;">
                    Sign In
                </button>
            </form>
        </div>

        <!-- Image Section -->
        <div class="col-lg-6 image-section d-flex align-items-center justify-content-center p-4 bg-light">
            <div class="logo-box w-100">
                <img
                    src="<?= asset_url('img/logo/group.png') ?>"
                    alt="Rslogo"
                    class="img-fluid"
                    style="max-width: 400px;"
                />
            </div>
        </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
