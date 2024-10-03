<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class UsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ]
        ]);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}