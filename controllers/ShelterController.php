<?php

require_once APP_ROOT . '/models/Shelter.php';

class ShelterController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Shelter();
    }

    // Public page: list + filter
    public function index()
    {
        $district = trim($_GET['district'] ?? '');
        $shelters = $this->model->getAll($district === '' ? null : $district);

        $this->view('shelter/index', [
            'page_title' => 'Emergency Shelters & Hospitals',
            'shelters'   => $shelters,
            'district'   => $district,
        ]);
    }

    // Admin page: manage (create / update / delete)
    public function manage()
    {
        $this->requireAdmin();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'create') {
                $name     = trim($_POST['name'] ?? '');
                $type     = trim($_POST['type'] ?? '');
                $address  = trim($_POST['address'] ?? '');
                $district = trim($_POST['district'] ?? '');
                $lat      = trim($_POST['latitude'] ?? '');
                $lng      = trim($_POST['longitude'] ?? '');

                if ($name === '' || $address === '' || $district === '') {
                    $errors[] = 'Name, address and district are required.';
                } else {
                    $this->model->create([
                        'name'      => $name,
                        'type'      => $type ?: 'other',
                        'address'   => $address,
                        'district'  => $district,
                        'latitude'  => $lat !== '' ? $lat : null,
                        'longitude' => $lng !== '' ? $lng : null,
                    ]);
                    $this->redirect(BASE_URL . '/index.php?controller=shelter&action=manage');
                }
            }

            if ($action === 'update') {
                $id       = (int)($_POST['id'] ?? 0);
                $name     = trim($_POST['name'] ?? '');
                $type     = trim($_POST['type'] ?? '');
                $address  = trim($_POST['address'] ?? '');
                $district = trim($_POST['district'] ?? '');
                $lat      = trim($_POST['latitude'] ?? '');
                $lng      = trim($_POST['longitude'] ?? '');

                if ($id > 0 && $name !== '' && $address !== '' && $district !== '') {
                    $this->model->update($id, [
                        'name'      => $name,
                        'type'      => $type ?: 'other',
                        'address'   => $address,
                        'district'  => $district,
                        'latitude'  => $lat !== '' ? $lat : null,
                        'longitude' => $lng !== '' ? $lng : null,
                    ]);
                    $this->redirect(BASE_URL . '/index.php?controller=shelter&action=manage');
                } else {
                    $errors[] = 'Cannot update: required fields missing.';
                }
            }

            if ($action === 'delete') {
                $id = (int)($_POST['id'] ?? 0);
                if ($id > 0) {
                    $this->model->delete($id);
                    $this->redirect(BASE_URL . '/index.php?controller=shelter&action=manage');
                }
            }
        }

        $shelters = $this->model->getAll();

        $this->view('shelter/manage', [
            'page_title' => 'Manage Shelters (Admin)',
            'shelters'   => $shelters,
            'errors'     => $errors,
        ]);
    }
}
