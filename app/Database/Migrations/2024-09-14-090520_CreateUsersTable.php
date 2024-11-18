<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        // create type of enum for role
        $this->db->query("DO \$\$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'role_type') THEN
                CREATE TYPE role_type AS ENUM ('admin', 'operator');
            END IF;
        END\$\$");

        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'role' => [
                'type' => 'role_type',
                'default' => 'operator',
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
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
