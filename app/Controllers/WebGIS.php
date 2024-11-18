<?php

namespace App\Controllers;

use App\Models\{IKSModel, SidoarumModel, SidokartoModel, SidorejoModel};
use Exception;

class WebGIS extends BaseController
{
    private $iksModel;
    private $sidorejoModel;
    private $sidokartoModel;
    private $sidoarumModel;

    public function __construct()
    {
        helper(['geojson']);
        $this->iksModel = new IKSModel();
        $this->sidorejoModel = new SidorejoModel();
        $this->sidokartoModel = new SidokartoModel();
        $this->sidoarumModel = new SidoarumModel();
    }

    public function index()
    {
        try {
            $kalurahan = $this->iksModel->getAllKalurahan();
            $sidoarumIKS = $this->sidoarumModel->getAll();
            $sidorejoIKS = $this->sidorejoModel->getAll();
            $sidokartoIKS = $this->sidokartoModel->getAll();

            $sidoarumGeoJSON = mapToGeoJSON($sidoarumIKS);
            $sidorejoGeoJSON = mapToGeoJSON($sidorejoIKS);
            $sidokartoGeoJSON = mapToGeoJSON($sidokartoIKS);

            return view('WebGIS/index', [
                'kalurahan' => $kalurahan,
                'sidoarum' => $sidoarumGeoJSON,
                'sidorejo' => $sidorejoGeoJSON,
                'sidokarto' => $sidokartoGeoJSON
            ]);
        } catch (Exception $e) {
            return redirect()->to('/webgis')->with('errors', ['message' => $e->getMessage()]);
        }
    }
}
