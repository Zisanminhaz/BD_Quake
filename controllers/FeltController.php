<?php

require_once APP_ROOT . '/models/FeltReport.php';

class FeltController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new FeltReport();
    }

    // Public page: form + recent list
    public function index()
    {
        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $district  = trim($_POST['district'] ?? '');
            $location  = trim($_POST['location_description'] ?? '');
            $intensity = (int)($_POST['intensity'] ?? 0);
            $building  = trim($_POST['building_type'] ?? '');
            $comments  = trim($_POST['comments'] ?? '');

            if ($district === '') {
                $errors[] = 'District is required.';
            }
            if ($intensity < 1 || $intensity > 5) {
                $errors[] = 'Intensity must be between 1 and 5.';
            }

            if (empty($errors)) {
                $this->model->create([
                    'user_id'             => $_SESSION['user_id'] ?? null,
                    'district'            => $district,
                    'location_description'=> $location,
                    'intensity'           => $intensity,
                    'building_type'       => $building,
                    'comments'            => $comments,
                ]);

                $success = true;
            }
        }

        $reports = $this->model->getRecent(25);

        $this->view('felt/index', [
            'page_title' => 'Did You Feel It?',
            'errors'     => $errors,
            'success'    => $success,
            'reports'    => $reports,
        ]);
    }

    // Admin: see all + delete
    public function manage()
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                $this->model->delete($id);
            }
            $this->redirect(BASE_URL . '/index.php?controller=felt&action=manage');
        }

        $reports = $this->model->getAll();

        $this->view('felt/manage', [
            'page_title' => 'Manage Felt Reports (Admin)',
            'reports'    => $reports,
        ]);
    }
}
