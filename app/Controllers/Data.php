<?php

namespace App\Controllers;

use App\Models\{IKSModel, SidoarumModel, SidokartoModel, SidorejoModel};
use Config\Validation;
use Exception;

class Data extends BaseController
{

    private $iksModel;
    private $sidorejoModel;
    private $sidokartoModel;
    private $sidoarumModel;

    private $validation;

    public function __construct()
    {
        helper(['form', 'excel', 'geojson']);
        $this->iksModel = new IKSModel();
        $this->sidorejoModel = new SidorejoModel();
        $this->sidokartoModel = new SidokartoModel();
        $this->sidoarumModel = new SidoarumModel();
        $this->validation = \Config\Services::validation();
    }

    public function index(): string
    {
        $searchQuery = $this->request->getGet('search_query');

        $data = $this->iksModel->getAll($searchQuery);

        $data = $this->mapIksDataToView($data);

        return view('Data/index', ['data' => $data, 'query' => $searchQuery]);
    }

    public function detail($id)
    {
        try {
            $data = $this->iksModel->getBy($id);
            $kalurahan = $this->iksModel->getAllKalurahan();
            return view('Data/detail', ['data' => $data, 'kalurahan' => $kalurahan]);
        } catch (Exception $e) {
            return redirect()->to('/data')->with('errors', ['message' => $e->getMessage()]);
        }
    }

    public function kalurahan($kalurahan)
    {
        $padukuhan = $this->iksModel->getPadukuhanBy($kalurahan);
        return view('Data/kalurahan', ['kalurahan' => $kalurahan, 'padukuhan' => $padukuhan]);
    }

    public function add()
    {
        if (is_null(session('authUser'))) {
            return redirect()->to('/');
        }
        try {
            $kalurahan = $this->iksModel->getAllKalurahan();
            $sidoarumIKS = $this->sidoarumModel->getAll();
            $sidorejoIKS = $this->sidorejoModel->getAll();
            $sidokartoIKS = $this->sidokartoModel->getAll();

            $sidoarumGeoJSON = mapToGeoJSON($sidoarumIKS);
            $sidorejoGeoJSON = mapToGeoJSON($sidorejoIKS);
            $sidokartoGeoJSON = mapToGeoJSON($sidokartoIKS);

            return view('Data/add', [
                'kalurahan' => $kalurahan,
                'sidoarum' => $sidoarumGeoJSON,
                'sidorejo' => $sidorejoGeoJSON,
                'sidokarto' => $sidokartoGeoJSON
            ]);
        } catch (Exception $e) {
            return redirect()->to('/data/add')->with('errors', ['message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        $rules = $this->validation->getRuleGroup(Validation::$IKS);

        $data = $this->request->getPost();

        $notValid = !$this->validate($rules, $data);

        if ($notValid) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $this->iksModel->insertIKS($data);

            return redirect()->to('/data')->with('success', ['message' => 'Data berhasil ditambahkan']);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['message' => $e->getMessage()]);
        }
    }

    public function update($id)
    {
        $rules = $this->validation->getRuleGroup(Validation::$IKS);
        $inputNotValid = !$this->validate($rules);
        if ($inputNotValid) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $newData = $this->request->getPost();
            $this->iksModel->updateIKS($id, $newData);

            return redirect()->to('/data');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errors', ['message' => $e->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            $this->iksModel->deleteIKS($id);
            return redirect()->to('/data')->with('success', ['message' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            return redirect()->back()->with('errors', ['message' => $e->getMessage()]);
        }
    }

    public function export()
    {
        $data = $this->iksModel->getAll();
        $data = $this->mapIksDataToView($data);

        $filename = 'data_iks-' . date('d M Y');
        $header = ['No', 'Fasilitas Kesehatan', 'Kalurahan', 'Padukuhan', 'IKS', 'Dibuat', 'Diperbaharui'];

        createExcelFile($filename, $data, $header);
    }

    private function mapIksDataToView($data)
    {
        $dataView = [];
        foreach ($data as $item) {
            $dataView[] = [
                'id' => $item['id'],
                'faskes' => $item['faskes'],
                'kalurahan' => ucfirst($item['kalurahan']),
                'padukuhan' => ucfirst($item['padukuhan']),
                'iks' => $item['iks'],
                'created_at' => date('d M Y', strtotime($item['created_at'])),
                'updated_at' => date('d M Y', strtotime($item['updated_at'])),
            ];
        }
        return $dataView;
    }
}
