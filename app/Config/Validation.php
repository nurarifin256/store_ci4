<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $register = [
		'username' => [
			'rules' => 'required|min_length[5]'
		],
		'password' => [
			'rules' => 'required|min_length[5]|max_length[10]'
		],
		'repeatpassword' => [
			'rules' => 'required|matches[password]'
		],

	];

	public $register_errors = [
		'username' => [
			'required'   => '{field} Harus diisi',
			'min_length' => '{field} Minimal Lima Karakter'
		],
		'password' => [
			'required' => '{field} Harus diisi',
			'min_length' => '{field} Minimal Lima Karakter',
			'max_length' => '{field} Maksimal 10 karakter'
		],
		'repeatpassword' => [
			'required' => '{field} Harus diisi',
			'matches'  => '{field} harus sama dengan password'
		]
	];

	public $login = [
		'username' => [
			'rules' => 'required'
		],
		'password' => [
			'rules' => 'required'
		]
	];

	public $login_errors = [
		'username' => [
			'required' => '{field} Harus diisi'
		],
		'password' => [
			'required' => '{field} Harus diisi'
		]
	];

	public $transaksi = [
		'id_barang' => [
			'rules' => 'required'
		],
		'id_pembeli' => [
			'rules' => 'required'
		],
		'jumlah' => [
			'rules' => 'required'
		],
		'total_harga' => [
			'rules' => 'required'
		],
		'alamat' => [
			'rules' => 'required'
		],
		'ongkir' => [
			'rules' => 'required'
		]

	];

	public $barang = [
		'nama' => [
			'rules' => 'required|min_length[3]'
		],
		'harga' => [
			'rules' => 'required|is_natural'
		],
		'stok' => [
			'rules' => 'required|is_natural'
		],
		'gambar' => [
			'rules' => 'uploaded[gambar]'
		]
	];

	public $barang_errors = [
		'nama' => [
			'required'   => '{field} Harus diisi',
			'min_length' => '{field} Minimal 3 karakter'
		],
		'harga' => [
			'required'   => '{field} Harus diisi',
			'is_natural' => '{field} Tidak boleh negatif'
		],
		'stok' => [
			'required'   => '{field} Harus diisi',
			'is_natural' => '{field} Tidak boleh negatif'
		],
		'gambar' => [
			'uploaded' => '{field} belum di pilih'
		]
	];

	public $barangupdate = [
		'nama' => [
			'rules' => 'required|min_length[3]'
		],
		'harga' => [
			'rules' => 'required|is_natural'
		],
		'stok' => [
			'rules' => 'required|is_natural'
		]
	];

	public $barangupdate_errors = [
		'nama' => [
			'required'   => '{field} Harus diisi',
			'min_length' => '{field} Minimal 3 karakter'
		],
		'harga' => [
			'required'   => '{field} Harus diisi',
			'is_natural' => '{field} Tidak boleh negatif'
		],
		'stok' => [
			'required'   => '{field} Harus diisi',
			'is_natural' => '{field} Tidak boleh negatif'
		]
	];

	public $komentar = [
		'komentar' => [
			'rules' => 'required'
		]
	];
}
