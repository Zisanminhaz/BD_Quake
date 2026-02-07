<?php

require_once APP_ROOT . "/models/UnsafeBuilding.php";

class ReportController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new UnsafeBuilding();
    }

    public function index()
    {
        $reports = $this->model->getAll();
        $this->view("report/index", [
            "page_title" => "Unsafe Building Reports",
            "reports" => $reports
        ]);
    }

    public function create()
    {
        $this->requireLogin();

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $building = $_POST["building_name"] ?? "";
            $address = $_POST["address"] ?? "";
            $district = $_POST["district"] ?? "";
            $desc = $_POST["description"] ?? "";
            $severity = $_POST["severity"] ?? "medium";

            if ($building === "" || $address === "" || $district === "") {
                $errors[] = "All fields are required.";
            }

            // ---------- IMAGE UPLOAD ----------
            $photoPath = null;

            if (!empty($_FILES["photo"]["name"])) {
                $file = $_FILES["photo"];
                $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

                $allowed = ["jpg", "jpeg", "png", "webp"];
                if (!in_array($ext, $allowed)) {
                    $errors[] = "Invalid image format.";
                } else {
                    $newName = time() . "_" . rand(1000, 9999) . "." . $ext;
                    $uploadPath = dirname(__DIR__, 2) . "/public/uploads/buildings/" . $newName;

                    if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
                        $photoPath = "uploads/buildings/" . $newName;
                    } else {
                        $errors[] = "Failed to upload image.";
                    }
                }
            }

            if (empty($errors)) {
                $this->model->create([
                    "user_id" => $_SESSION["user_id"],
                    "building_name" => $building,
                    "address" => $address,
                    "district" => $district,
                    "description" => $desc,
                    "severity" => $severity,
                    "photo_path" => $photoPath
                ]);

                $this->redirect(BASE_URL . "/index.php?controller=report&action=index");
            }
        }

        $this->view("report/create", [
            "page_title" => "Report Unsafe Building",
            "errors" => $errors
        ]);
    }

    public function manage()
    {
        $this->requireAdmin();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($_POST["action"] === "status") {
                $this->model->updateStatus($_POST["id"], $_POST["status"]);
            }

            if ($_POST["action"] === "delete") {
                $this->model->delete($_POST["id"]);
            }

            $this->redirect(BASE_URL . "/index.php?controller=report&action=manage");
        }

        $reports = $this->model->getAll();

        $this->view("report/manage", [
            "page_title" => "Manage Reports (Admin)",
            "reports" => $reports
        ]);
    }
}
