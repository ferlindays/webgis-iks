<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Validation;
use Exception;

class Auth extends BaseController
{

    private $validation;
    private $userModel;

    public function __construct()
    {
        helper(['form']);
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // check if user already logged in
        if (session('authUser')) {
            return redirect()->to('/');
        }

        return view('Auth/signin');
    }

    public function login()
    {
        $rules = $this->validation->getRuleGroup(Validation::$SIGNIN);
        // validate input
        $valid = $this->validate($rules);
        if (!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // identity = email/username
        $userData = [
            'identity' => $this->request->getVar('identity'),
            'password' => $this->request->getVar('password')
        ];

        try {
            $userData = $this->userModel->login($userData['identity'], $userData['password']);

            session()->set('authUser', $userData);

            return redirect()->to('/');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['message' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function signup()
    {
        // check if user already logged in
        if (session('authUser')) {
            return redirect()->to('/');
        }

        return view('Auth/signup');
    }

    public function register()
    {
        $rules = $this->validation->getRuleGroup(Validation::$SIGNUP);

        // validate input
        $valid = $this->validate($rules);
        if (!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->userModel->register($this->request->getPost());
            return redirect()->to('/signin')->with('success', ['message' => 'Akun anda berhasil terdaftar. Silahkan login']);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['message' => $e->getMessage()]);
        }
    }

    public function forgotPassword()
    {
        $admin = $this->userModel->where('role', 'admin')->first();
        return view('Auth/forgot-password', ['data' => $admin]);
    }
}
