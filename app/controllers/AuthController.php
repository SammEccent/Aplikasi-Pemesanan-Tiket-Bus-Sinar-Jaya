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
            'password' => $hashedPassword // Sudah di-hash
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
}   