<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoEquipos extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nombre' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => NULL
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => NULL
            )
        ));

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('tipo_equipos');
    }

    public function down()
    {
        $this->forge->dropTable('tipo_equipos');
    }
}
