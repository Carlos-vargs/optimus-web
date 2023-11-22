<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Equipos extends Migration
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
            'idTipoEquipo' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'idMarca' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'idEstado' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'fechaDeAdquisicion' => [
                'type' => 'DATE',
            ],
            'ultimoMantenimiento' => [
                'type' => 'DATE',
            ],
            'proximoMantenimiento' => [
                'type' => 'DATE',
            ],
            'codigoInventario' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => TRUE,
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

        $this->forge->createTable('equipos');

        $this->forge->addForeignKey('idTipoEquipo', 'tipo_equipos', 'id');
        $this->forge->addForeignKey('idMarca', 'Marcas', 'id');
        $this->forge->addForeignKey('idEstado', 'Estados', 'id');
    }

    public function down()
    {
        $this->forge->dropForeignKey('equipos', 'equipos_idTipoEquipo_foreign');
        $this->forge->dropForeignKey('equipos', 'equipos_idMarca_foreign');
        $this->forge->dropForeignKey('equipos', 'equipos_idEstado_foreign');

        $this->forge->dropTable('equipos');
    }
}
