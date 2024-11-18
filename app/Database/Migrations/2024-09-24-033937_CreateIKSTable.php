<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIKSTable extends Migration
{
    public function up()
    {
        // create type of enum for kalurahan field
        $this->db->query("DO \$\$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'role_type') THEN
                CREATE TYPE kalurahan_type AS ENUM ('sidokarto', 'sidorejo', 'sidoarum');
            END IF;
        END\$\$");

        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'faskes' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            'kalurahan' => [
                'type' => 'kalurahan_type',
            ],
            'padukuhan' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            'iks' => [
                'type' => 'float',
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('iks');
    }

    public function down()
    {
        $this->forge->dropTable('iks');
    }
}
