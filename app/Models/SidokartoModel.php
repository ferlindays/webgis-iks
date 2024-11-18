<?php

namespace App\Models;

use CodeIgniter\Model;

class SidokartoModel extends Model
{
    protected $table            = 'Sidokarto_IKS';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "geom",
        "objectid",
        "shape_leng",
        "shape_area",
        "padukuhan",
        "no",
        "faskes",
        "kalurahan",
        "iks",
        "kategori"
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

    public function getAll()
    {
        $data = $this->select(['id',  "ST_AsGeoJSON(ST_Transform(geom, 4326)) as geom", 'objectid', 'shape_leng', 'shape_area', 'padukuhan', 'no', 'faskes', 'kalurahan', 'iks', 'kategori'])
            ->findAll();

        return $data;
    }
}
