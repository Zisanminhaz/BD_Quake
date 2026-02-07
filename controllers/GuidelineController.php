<?php

require_once APP_ROOT . '/models/Guideline.php';

class GuidelineController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Guideline();
    }

    public function index()
    {
        $all = $this->model->getAll();

        // Group by category
        $grouped = [
            'before' => [],
            'during' => [],
            'after'  => []
        ];
        foreach ($all as $g) {
            $grouped[$g['category']][] = $g;
        }

        $this->view('guideline/index', [
            'page_title' => 'Earthquake Safety Guidelines',
            'guidelines' => $grouped
        ]);
    }

    public function manage()
    {
        $this->requireAdmin();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'create') {
                $title = trim($_POST['title']);
                $content = trim($_POST['content']);
                $category = trim($_POST['category']);

                if ($title === '' || $content === '') {
                    $errors[] = "All fields are required.";
                } else {
                    $this->model->create([
                        'title' => $title,
                        'content' => $content,
                        'category' => $category
                    ]);
                }
            }

            if ($action === 'update') {
                $id = (int)$_POST['id'];
                $this->model->update($id, [
                    'title' => trim($_POST['title']),
                    'content' => trim($_POST['content']),
                    'category' => trim($_POST['category'])
                ]);
            }

            if ($action === 'delete') {
                $id = (int)$_POST['id'];
                $this->model->delete($id);
            }

            $this->redirect(BASE_URL . '/index.php?controller=guideline&action=manage');
        }

        $guidelines = $this->model->getAll();

        $this->view('guideline/manage', [
            'page_title' => 'Manage Guidelines',
            'guidelines' => $guidelines,
            'errors' => $errors
        ]);
    }
}
