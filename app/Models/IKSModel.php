<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use ReflectionException;

class IKSModel extends Model
{
    protected $table            = 'iks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'faskes',
        'kalurahan',
        'padukuhan',
        'iks',
        'created_at',
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

    public function insertIKS($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->insert($data);
    }

    public function getAll($searchQuery = '')
    {
        return $this->select(['id', 'faskes', 'kalurahan', 'padukuhan', 'iks', 'created_at', 'updated_at'])
            ->where('deleted_at IS NULL')
            ->when(!empty($searchQuery), function ($builder) use ($searchQuery) {
                return $builder
                    ->like('padukuhan', $searchQuery, 'both',  true, true)
                    ->orLike('kalurahan::text', $searchQuery, 'both',  true, true)
                    ->orLike('iks::text', $searchQuery, 'both',  true, true)
                    ->orLike('faskes', $searchQuery, 'both',  true, true);
            })
            ->findAll();
    }

    public function getBarchartData()
    {
        return $this->select('iks.padukuhan, iks.kalurahan, AVG(iks.iks) as iks')
            ->where('deleted_at IS NULL')
            ->groupBy('iks.padukuhan, iks.kalurahan')
            ->findAll();
    }

    public function getAllKalurahan()
    {
        $data = $this->db->query("SELECT unnest(enum_range(NULL::kalurahan_type))")->getResultArray();
        $data = array_column($data, 'unnest');
        return $data;
    }

    public function getPadukuhanBy($kalurahan)
    {
        return array_column($this->db->query("SELECT DISTINCT iks.padukuhan FROM iks WHERE iks.kalurahan = ? AND deleted_at IS NULL", [$kalurahan])->getResultArray(), 'padukuhan');
    }

    public function getBy($id)
    {
        $data = $this->select(['id', 'faskes', 'kalurahan', 'padukuhan', 'iks', 'created_at', 'updated_at'])
            ->where('id', $id)
            ->where('deleted_at IS NULL')
            ->first();

        if ($data) {
            return $data;
        }

        throw new Exception('Data tidak ditemukan');
    }

    public function updateIKS($id, $data)
    {
        $iksNotExists = !$this->find($id);
        if ($iksNotExists) {
            throw new ReflectionException('Data tidak ditemukan');
        }

        $newData = [
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        foreach (['faskes', 'iks', 'kalurahan', 'padukuhan'] as $field) {
            if (isset($data[$field])) {
                $newData[$field] = $data[$field];
            }
        }

        $this->update($id, $newData);
    }

    public function deleteIKS($id)
    {
        $iksNotExists = !$this->find($id);
        if ($iksNotExists) {
            throw new ReflectionException('Data tidak ditemukan');
        }
        $newData = [
            'deleted_at' => date('Y-m-d H:i:s')
        ];

        $this->update($id, $newData);
    }
}
