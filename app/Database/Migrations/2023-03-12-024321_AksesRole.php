<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AksesRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'id_role' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_menu' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('akses_role');
    }

    public function down()
    {
        //
    }
}
