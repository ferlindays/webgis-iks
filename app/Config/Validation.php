<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
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
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public static $SIGNUP = 'signup';
    public array $signup = [
        'email' => [
            'rules' => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'is_unique' => 'Email sudah terdaftar',
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid',
            ]
        ],
        'username' => [
            'rules' => 'required|is_unique[users.username]',
            'errors' => [
                'is_unique' => 'Username sudah terdaftar',
                'required' => 'Username harus diisi',
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]',
            'errors' => [
                'min_length' => 'Password harus minimal 8 karakter',
                'required' => 'Password harus diisi',
            ]
        ],
        'confirmPassword' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi password harus diisi',
                'matches' => 'Konfirmasi password harus sama dengan password',
            ]
        ],
    ];

    public static $SIGNIN = 'signin';
    public array $signin = [
        'identity' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Identitas harus diisi',
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password harus diisi',
            ]
        ],
    ];

    public static $IKS = 'iks';
    public array $iks = [
        'faskes' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Faskes harus diisi',
            ]
        ],
        'kalurahan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kalurahan harus diisi',
            ],
        ],
        'padukuhan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Padukuhan harus diisi',
            ]
        ],
        'iks' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'IKS harus diisi',
            ]
        ],

    ];
}
