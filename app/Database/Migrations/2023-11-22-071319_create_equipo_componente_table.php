<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EquipoComponente extends Migration
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
            'idEquipo' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'idComponente' => [
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
        $this->forge->addForeignKey('idEquipo', 'equipos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idComponente', 'componentes', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('equipo_componente');
    }

    public function down()
    {
        $this->forge->dropTable('equipo_componente');
    }
}
