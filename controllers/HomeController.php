<?php

class HomeController extends Controller
{
    private $db;

    public function __construct()
    {
        // Create DB connection when controller is created
        $this->db = new Database();
    }

    public function index()
    {
        // Simple DB test: count users
        $pdo = $this->db->getConnection();
        
        $stmt = $pdo->query("SELECT COUNT(*) AS total_users FROM users");
        $row = $stmt->fetch();
        
        $total_users = $row['total_users'] ?? 0;

        $data = [
            'page_title' => 'Bangladesh Earthquake Safety Portal',
            'total_users' => $total_users
        ];

        $this->view('home/index', $data);
    }
}
