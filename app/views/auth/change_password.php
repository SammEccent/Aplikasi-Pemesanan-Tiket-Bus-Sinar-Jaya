<?php
defined('BASEURL') or exit('No direct script access allowed');
require_once __DIR__ . '/../templates/header.php';
?>

<main class="profile-page">
    <div class="profile-container">
        <div class="profile-card glass">
            <div class="profile-header">
                <h1 class="profile-title">Change Password</h1>
                <p class="profile-subtitle">Buat kata sandi baru yang kuat.</p>
            </div>

            <form action="<?= BASEURL ?>auth/processChangePassword" method="POST" class="profile-form">
                <div class="form-group-profile">
                    <label for="current_password">Kata Sandi Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="profile-input" required>
                </div>

                <div class="form-group-profile">
                    <label for="new_password">Kata Sandi Baru</label>
                    <input type="password" id="new_password" name="new_password" class="profile-input" required minlength="8">
                </div>

                <div class="form-group-profile">
                    <label for="confirm_new_password">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password" class="profile-input" required>
                </div>

                <div class="profile-actions form-actions">
                    <a href="<?= BASEURL ?>auth/profile" class="btn-profile-action secondary">Batal</a>
                    <button type="submit" class="btn-profile-action">Ubah Kata Sandi</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>