<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use ReflectionException;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'email',
        'password',
        'role',
        'updated_at',
        'deleted_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function login($identity, $password)
    {
        $data = $this->select(['id', 'username', 'email', 'password', 'role'])
            ->where(['email' => $identity])
            ->orWhere(['username' => $identity])->first();

        if ($data) {
            // if password is correct
            if (password_verify($password, $data['password'])) {
                unset($data['password']);
                return $data;
            } else {
                throw new Exception('Identitas atau password anda tidak valid');
            }
        } else {
            throw new Exception('Akun anda belum terdaftar');
        }
    }

    public function register($data)
    {
        $userAlreadyExists = $this->select('id')
            ->where(['email' => $data['email']])
            ->orWhere(['username' => $data['username']])
            ->first();

        if ($userAlreadyExists) {
            throw new Exception('Email atau username sudah terdaftar');
        }

        $newUserData = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->insert($newUserData);
    }

    public function getAllUsers()
    {
        return $this->select('id, username, email, role')
            ->where('deleted_at IS NULL')
            ->findAll();
    }

    public function getById($id)
    {
        $data = $this->select('id, username, email, role')
            ->where('id', $id)
            ->where('deleted_at IS NULL')
            ->first();

        if ($data) {
            return $data;
        }

        throw new Exception('User tidak ditemukan');
    }


    public function getAllRoles()
    {
        $data = $this->db->query("SELECT unnest(enum_range(NULL::role_type))")->getResultArray();
        $data = array_column($data, 'unnest');
        return $data;
    }

    public function updateUser($id, $data)
    {
        $userNotExists = !$this->find($id);
        if ($userNotExists) {
            throw new ReflectionException('User tidak ditemukan');
        }

        $newData = [
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        foreach (['email', 'username', 'role'] as $field) {
            if (isset($data[$field])) {
                $newData[$field] = $data[$field];
            }
        }

        $this->update($id, $newData);
    }

    public function deleteUser($id)
    {
        $userNotExists = !$this->find($id);
        if ($userNotExists) {
            throw new ReflectionException('User tidak ditemukan');
        }

        $data = [
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        $this->update($id, $data);
    }
}
