<?php
defined('BASEURL') or exit('No direct script access allowed');
require_once __DIR__ . '/../templates/header.php';
?>

<main class="profile-page">
    <div class="profile-container">
        <div class="profile-card glass">
            <div class="profile-header">
                <h1 class="profile-title">Edit Profile</h1>
                <p class="profile-subtitle">Perbarui informasi akun Anda di bawah ini.</p>
            </div>

            <form action="<?= BASEURL ?>auth/processEditProfile" method="POST" class="profile-form">
                <div class="form-group-profile">
                    <label for="fullname">Nama Lengkap</label>
                    <input type="text" id="fullname" name="fullname" class="profile-input" value="<?= htmlspecialchars($user['fullname']) ?>" required>
                </div>

                <div class="form-group-profile">
                    <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" id="nik" name="nik" class="profile-input" value="<?= htmlspecialchars($user['nik']) ?>" required pattern="\d{16}" title="NIK harus terdiri dari 16 digit angka" maxlength="16">
                </div>

                <div class="form-group-profile">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="profile-input" value="<?= htmlspecialchars($user['tanggal_lahir']) ?>" required>
                </div>

                <div class="form-group-profile">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="profile-input" value="<?= htmlspecialchars($user['email']) ?>" disabled>
                    <small class="form-field-description">Email tidak dapat diubah.</small>
                </div>

                <div class="profile-actions form-actions">
                    <a href="<?= BASEURL ?>auth/profile" class="btn-profile-action secondary">Batal</a>
                    <button type="submit" class="btn-profile-action">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>