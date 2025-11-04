<?php

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->fetch();
    }

    // Create new user
    public function createUser($data)
    {
        // Cek: Pastikan $data adalah array
        if (!is_array($data)) {
            throw new InvalidArgumentException("Data must be an array.");
        }

        $this->db->prepare("INSERT INTO user (fullname, email, password) VALUES (:fullname, :email, :password)");
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        return $this->db->execute();
    }
}
