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
			'rules' => 'required'
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
			'required' => '{field} Harus diisi'
		],
		'repeatpassword' => [
			'required' => '{field} Harus diisi',
			'matches'  => '{field} harus sama dengan password'
		]
	];

	public $login = [
		'username' => [
			'rules' => 'requiered'
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
}
