<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotifikasiTable extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true,
        'auto_increment' => true
      ],
      'user_id' => [
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true
      ],
      'rps_id' => [
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true
      ],
      'sender_id' => [
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true
      ],
      'pesan' => [
        'type' => 'TEXT'
      ],
      'status' => [
        'type' => 'ENUM',
        'constraint' => ['unread', 'read'],
        'default' => 'unread'
      ],
      'created_at' => [
        'type' => 'DATETIME',
        'null' => true
      ],
      'updated_at' => [
        'type' => 'DATETIME',
        'null' => true
      ]
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('rps_id', 'daftar_rps', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('sender_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('notifikasi');
  }

  public function down()
  {
    $this->forge->dropTable('notifikasi');
  }
}
