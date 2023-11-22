<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Componentes extends Migration
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
            'idTipoComponente' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'idMarca' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'codigoInventario' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => TRUE,
            ],
            'fechaDeAdquisicion' => [
                'type' => 'DATE',
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

        $this->forge->createTable('Componentes');

        $this->forge->addForeignKey('idTipoComponente', 'TipoComponentes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idMarca', 'Marcas', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('Componentes', 'Componentes_idTipoComponente_foreign');
        $this->forge->dropForeignKey('Componentes', 'Componentes_idMarca_foreign');

        $this->forge->dropTable('Componentes');
    }
}
