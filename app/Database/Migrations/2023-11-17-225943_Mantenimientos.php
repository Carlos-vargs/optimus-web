<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mantenimientos extends Migration
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
            'idTipoDeMantenimiento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'solucionesImplementadas' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
            ],
            // El campo 'ticket' es un campo virtual generado que se construirá en la aplicación.
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('Mantenimientos');

        $this->forge->addForeignKey('idEquipo', 'Equipos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idTipoDeMantenimiento', 'TipoMantenimientos', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('Mantenimientos', 'Mantenimientos_idEquipo_foreign');
        $this->forge->dropForeignKey('Mantenimientos', 'Mantenimientos_idTipoDeMantenimiento_foreign');

        $this->forge->dropTable('Mantenimientos');
    }
}
