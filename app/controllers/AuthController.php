<?php

//model UserModel
require_once __DIR__ . '/../Models/UserModel.php';

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Method untuk menampilkan halaman login
    public function login()
    {
        $this->view('auth/login');
    }

    // register method
    public function register()
    {
        $this->view('auth/register');
    }

    // Method untuk memproses login
    public function processLogin()
    {
        // Ambil data dari form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Cari user berdasarkan email
        $user = $this->userModel->findUserByEmail($email, $email);

        if ($user && password_verify($password, $user['password'])) {
            // Login berhasil
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header('Location: ' . BASEURL);
            exit;
        } else {
            // Login gagal
            $_SESSION['error'] = 'Invalid email or password.';
            header('Location: ' . BASEURL . 'auth/login');
            exit;
        }
    }

    // process register method
    public function processRegister()
    {
        // Ambil data dari form
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $nik = $_POST['nik'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $terms = isset($_POST['terms']) ? true : false;

        // Validasi password dan konfirmasi password
        if ($password !== $confirm_password) {
            $_SESSION['error'] = 'Password and Confirm Password do not match.';
            header('Location: ' . BASEURL . 'auth/register');
            exit;
        }

        // Validasi persetujuan syarat dan ketentuan
        if (!$terms) {
            $_SESSION['error'] = 'You must agree to the Terms & Conditions.';
            header('Location: ' . BASEURL . 'auth/register');
            exit;
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // 1. Kumpulkan data menjadi satu array asosiatif
        $data_to_save = [
            'fullname' => $fullname,
            'email' => $email,
            'nik' => $nik,
            'tanggal_lahir' => $tanggal_lahir,
            'password' => $hashedPassword
            // Pastikan kunci array ini cocok dengan yang diakses di UserModel->createUser()
        ];

        // 2. Simpan user baru ke database dengan Meneruskan SATU array data
        if ($this->userModel->createUser($data_to_save)) {
            // Redirect ke halaman login setelah registrasi sukses
            $_SESSION['success'] = 'Registration successful. Please log in.';
            header('Location: ' . BASEURL . 'auth/login');
        } else {
            // Handle kegagalan, misalnya email sudah terdaftar
            $_SESSION['error'] = 'Registration failed. Please try again.';
            header('Location: ' . BASEURL . 'auth/register');
        }
        exit;
    }

    // Method untuk menampilkan halaman profil
    public function profile()
    {
        // Pastikan pengguna sudah login
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . 'auth/login');
            exit;
        }

        // Ambil data pengguna dari database berdasarkan user_id di session
        $user = $this->userModel->findUserById($_SESSION['user_id']);

        // Siapkan data untuk dikirim ke view
        $data = [
            'pageTitle' => 'My Profile',
            'user' => $user
        ];

        $this->view('auth/profile', $data);
    }

    // Method untuk menampilkan halaman edit profil
    public function editProfile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . 'auth/login');
            exit;
        }

        $user = $this->userModel->findUserById($_SESSION['user_id']);

        $data = [
            'pageTitle' => 'Edit Profile',
            'user' => $user
        ];

        $this->view('auth/edit_profile', $data);
    }

    // Method untuk memproses update profil
    public function processEditProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        $data = [
            'id' => $_SESSION['user_id'],
            'fullname' => $_POST['fullname'],
            'nik' => $_POST['nik'],
            'tanggal_lahir' => $_POST['tanggal_lahir']
        ];

        if ($this->userModel->updateUser($data)) {
            // Update session fullname jika berubah
            $_SESSION['fullname'] = $data['fullname'];
            $_SESSION['success'] = 'Profil berhasil diperbarui.';
            header('Location: ' . BASEURL . 'auth/profile');
        } else {
            $_SESSION['error'] = 'Gagal memperbarui profil. Silakan coba lagi.';
            header('Location: ' . BASEURL . 'auth/editProfile');
        }
        exit;
    }

    // Method untuk menampilkan halaman ganti password
    public function changePassword()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . 'auth/login');
            exit;
        }

        $this->view('auth/change_password', ['pageTitle' => 'Change Password']);
    }

    // Method untuk memproses ganti password
    public function processChangePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];

        // 1. Validasi password baru
        if ($new_password !== $confirm_new_password) {
            $_SESSION['error'] = 'Kata sandi baru dan konfirmasi tidak cocok.';
            header('Location: ' . BASEURL . 'auth/changePassword');
            exit;
        }

        // 2. Verifikasi password saat ini
        $user = $this->userModel->findUserById($_SESSION['user_id']);
        if (!$user || !password_verify($current_password, $user['password'])) {
            $_SESSION['error'] = 'Kata sandi saat ini salah.';
            header('Location: ' . BASEURL . 'auth/changePassword');
            exit;
        }

        // 3. Update password baru
        $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
        if ($this->userModel->updatePassword($_SESSION['user_id'], $hashedPassword)) {
            $_SESSION['success'] = 'Kata sandi berhasil diubah.';
            header('Location: ' . BASEURL . 'auth/profile');
        } else {
            $_SESSION['error'] = 'Gagal mengubah kata sandi. Silakan coba lagi.';
            header('Location: ' . BASEURL . 'auth/changePassword');
        }
        exit;
    }

    // Method untuk memproses logout
    public function logout()
    {
        // Hapus semua variabel session
        $_SESSION = array();

        // Hancurkan session
        session_destroy();

        // Redirect ke halaman utama
        header('Location: ' . BASEURL);
        exit;
    }
}
