<?php
defined('BASEURL') or exit('No direct script access allowed');
require_once __DIR__ . '/../templates/header.php';
?>

<main class="profile-page">
    <div class="profile-container">
        <div class="profile-card glass">
            <div class="profile-header">
                <svg class="profile-avatar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                </svg>
                <h1 class="profile-title"><?= htmlspecialchars($user['fullname']) ?></h1>
                <p class="profile-subtitle">Selamat datang! Kelola detail akun Anda di sini.</p>
            </div>

            <div class="profile-details">
                <div class="detail-item">
                    <span class="detail-label">Nama Lengkap</span>
                    <span class="detail-value"><?= htmlspecialchars($user['fullname']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Alamat Email</span>
                    <span class="detail-value"><?= htmlspecialchars($user['email']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Nomor Induk Kependudukan (NIK)</span>
                    <?php
                    // Menyembunyikan sebagian NIK untuk privasi, hanya menampilkan 4 digit terakhir
                    $maskedNik = '************' . substr($user['nik'], -4);
                    ?>
                    <span class="detail-value"><?= htmlspecialchars($maskedNik) ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tanggal Lahir</span>
                    <span class="detail-value"><?= htmlspecialchars(date('d F Y', strtotime($user['tanggal_lahir']))) ?></span>
                </div>
            </div>

            <div class="profile-actions">
                <a href="<?= BASEURL ?>auth/editProfile" class="btn-profile-action">Edit Profile</a>
                <a href="<?= BASEURL ?>auth/changePassword" class="btn-profile-action secondary">Change Password</a>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>