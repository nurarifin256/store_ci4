<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiAlterAlamat extends Migration
{
	public function up()
	{
		$fields = [
			'alamat' => [
				'type' => 'text'
			],
			'ongkir' => [
				'type' => 'int'
			],
			'status' => [
				'type' => 'int',
				'constrait' => 1
			]
		];
		$this->forge->addColumn('transaksi', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('transaksi', ['alamat', 'ongkir', 'status']);
	}
}
