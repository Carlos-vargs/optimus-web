<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MantenimientoFalla extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'idMantenimiento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'idFalla' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'observaciones' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => NULL
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => NULL,
                'on_update' => NULL
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('idMantenimiento', 'mantenimientos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idFalla', 'fallas', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('mantenimiento_falla');
    }

    public function down()
    {
        $this->forge->dropTable('mantenimiento_falla');
    }
}
