<?php

namespace App\Controllers;

use App\Models\UserModel;
use Exception;

class User extends BaseController
{
    private $userModel;

    public function __construct()
    {
        helper(['form']);
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // check if user is not logged in
        if (!session('authUser')) {
            return redirect()->to('/');
        }

        $data = $this->userModel->getAllUsers();
        foreach ($data as &$item) {
            $item['role'] = ucwords($item['role']);
        }

        return view('User/index', ['data' => $data]);
    }

    public function detail($id)
    {
        // check if user is not logged in
        if (!session('authUser')) {
            return redirect()->to('/');
        }
        try {
            $user = $this->userModel->getById($id);
            $roles = $this->userModel->getAllRoles();
            return view('User/detail', ['data' => $user, 'roles' => $roles]);
        } catch (Exception $e) {
            return redirect()->back()->with('errors', ['message' => $e->getMessage()]);
        }
    }


    public function update($id)
    {
        try {
            $newData = $this->request->getPost();
            $this->userModel->updateUser($id, $newData);

            return redirect()->to('/users');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['message' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $this->userModel->deleteUser($id);
            return redirect()->to('/users');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['message' => $e->getMessage()]);
        }
    }
}
