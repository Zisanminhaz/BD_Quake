<?php

require_once APP_ROOT . '/models/ForumPost.php';

class ForumController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new ForumPost();
    }

    // Show all posts
    public function index()
    {
        $posts = $this->model->getAll();

        $this->view('forum/index', [
            'page_title' => 'Panic Help Forum',
            'posts'      => $posts,
        ]);
    }

    // Posts created by logged-in user
    public function myPosts()
    {
        $this->requireLogin();
        $userId = (int)$_SESSION['user_id'];

        $posts = $this->model->getByUser($userId);

        $this->view('forum/mine', [
            'page_title' => 'My Forum Posts',
            'posts'      => $posts,
        ]);
    }

    // Create new post
    public function create()
    {
        $this->requireLogin();

        $errors = [];
        $old = ['title' => '', 'category' => 'question', 'body' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title    = trim($_POST['title'] ?? '');
            $category = trim($_POST['category'] ?? 'question');
            $body     = trim($_POST['body'] ?? '');

            if ($title === '') {
                $errors[] = 'Title is required.';
            }
            if ($body === '') {
                $errors[] = 'Message is required.';
            }

            if (empty($errors)) {
                $this->model->create([
                    'user_id'  => $_SESSION['user_id'],
                    'title'    => $title,
                    'body'     => $body,
                    'category' => $category ?: 'question',
                ]);

                $this->redirect(BASE_URL . '/index.php?controller=forum&action=index');
            }

            $old['title'] = $title;
            $old['category'] = $category;
            $old['body'] = $body;
        }

        $this->view('forum/create', [
            'page_title' => 'Create Forum Post',
            'errors'     => $errors,
            'old'        => $old,
        ]);
    }

    // Edit post
    public function edit()
    {
        $this->requireLogin();

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect(BASE_URL . '/index.php?controller=forum&action=index');
        }

        $post = $this->model->getById($id);
        if (!$post) {
            $this->redirect(BASE_URL . '/index.php?controller=forum&action=index');
        }

        // Only owner or admin can edit
        $isOwner = ($post['user_id'] == ($_SESSION['user_id'] ?? 0));
        $isAdmin = (($_SESSION['user_role'] ?? '') === 'admin');
        if (!$isOwner && !$isAdmin) {
            http_response_code(403);
            echo "<h3 style='color:red;text-align:center;'>You are not allowed to edit this post.</h3>";
            exit;
        }

        $errors = [];
        $old = [
            'title'    => $post['title'],
            'category' => $post['category'],
            'body'     => $post['body'],
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title    = trim($_POST['title'] ?? '');
            $category = trim($_POST['category'] ?? 'question');
            $body     = trim($_POST['body'] ?? '');

            if ($title === '') {
                $errors[] = 'Title is required.';
            }
            if ($body === '') {
                $errors[] = 'Message is required.';
            }

            if (empty($errors)) {
                $this->model->update($id, [
                    'title'    => $title,
                    'body'     => $body,
                    'category' => $category ?: 'question',
                ]);

                $this->redirect(BASE_URL . '/index.php?controller=forum&action=index');
            }

            $old['title'] = $title;
            $old['category'] = $category;
            $old['body'] = $body;
        }

        $this->view('forum/edit', [
            'page_title' => 'Edit Forum Post',
            'errors'     => $errors,
            'old'        => $old,
            'id'         => $id,
        ]);
    }

    // Delete post
    public function delete()
    {
        $this->requireLogin();

        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect(BASE_URL . '/index.php?controller=forum&action=index');
        }

        $post = $this->model->getById($id);
        if (!$post) {
            $this->redirect(BASE_URL . '/index.php?controller=forum&action=index');
        }

        $isOwner = ($post['user_id'] == ($_SESSION['user_id'] ?? 0));
        $isAdmin = (($_SESSION['user_role'] ?? '') === 'admin');

        if (!$isOwner && !$isAdmin) {
            http_response_code(403);
            echo "<h3 style='color:red;text-align:center;'>You are not allowed to delete this post.</h3>";
            exit;
        }

        $this->model->delete($id);
        $this->redirect(BASE_URL . '/index.php?controller=forum&action=index');
    }
}
