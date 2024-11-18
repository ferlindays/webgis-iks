<?php

namespace App\Controllers;

use App\Models\IKSModel;

class Diagram extends BaseController
{
    private $iksModel;

    public function __construct()
    {
        $this->iksModel = new IKSModel();
    }

    public function index(): string
    {
        $data = $this->iksModel->getBarchartData();
        return view('Diagram/index', ['data' => $data]);
    }
}
