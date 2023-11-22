<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoMantenimientos extends Migration
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
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => NULL
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => NULL,
                'on_update' => NULL
            ]
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('tipo_mantenimientos');
    }

    public function down()
    {
        $this->forge->dropTable('tipo_mantenimientos');
    }
}
