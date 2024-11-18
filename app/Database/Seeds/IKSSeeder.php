<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IKSSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            array(
                'faskes' => 'Faskes 1',
                'kalurahan' => 'sidorejo',
                'padukuhan' => 'Rejo 1',
                'iks' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'faskes' => 'Faskes 2',
                'kalurahan' => 'sidorejo',
                'padukuhan' => 'Rejo 2',
                'iks' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'faskes' => 'Faskes 3',
                'kalurahan' => 'sidorejo',
                'padukuhan' => 'Rejo 3',
                'iks' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'faskes' => 'Faskes 1',
                'kalurahan' => 'sidokarto',
                'padukuhan' => 'Karto 1',
                'iks' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'faskes' => 'Faskes 2',
                'kalurahan' => 'sidokarto',
                'padukuhan' => 'Karto 2',
                'iks' => 7,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'faskes' => 'Faskes 3',
                'kalurahan' => 'sidokarto',
                'padukuhan' => 'Karto 3',
                'iks' => 8,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'faskes' => 'Faskes 1',
                'kalurahan' => 'sidoarum',
                'padukuhan' => 'Arum 1',
                'iks' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'faskes' => 'Faskes 2',
                'kalurahan' => 'sidoarum',
                'padukuhan' => 'Arum 2',
                'iks' => 7,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'faskes' => 'Faskes 3',
                'kalurahan' => 'sidoarum',
                'padukuhan' => 'Arum 3',
                'iks' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            )
        );

        foreach ($data as $item) {
            $this->db->table('iks')->insert($item);
        }
    }
}
