<?php
require_once 'BaseController.php';
require_once 'Model/PersonalInfoModel.php';

class PersonalInfoController extends BaseController {
    private $model;
    
    public function __construct() {
        $this->model = new PersonalInfoModel();
    }
    
    public function index() {
        $search = $_GET['search'] ?? '';
        $action = $_GET['action'] ?? '';
        $id = $_GET['id'] ?? '';
        
        // Handle form submissions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'create':
                        $this->handleCreate();
                        break;
                    case 'update':
                        $this->handleUpdate();
                        break;
                }
            }
        }
        
        // Handle GET actions
        if ($action === 'delete' && $id) {
            $this->handleDelete($id);
        }
        
        // Get data
        if ($search) {
            $people = $this->model->search($search);
        } else {
            $people = $this->model->getAll();
        }
        
        $editPerson = null;
        if ($action === 'edit' && $id) {
            $editPerson = $this->model->getById($id);
        }
        
        $this->render('personal_info/index', [
            'people' => $people,
            'search' => $search,
            'editPerson' => $editPerson
        ]);
    }
    
    private function handleCreate() {
        $name = $_POST['name'] ?? '';
        $date_of_birth = $_POST['date_of_birth'] ?? '';
        $favorite_color = $_POST['favorite_color'] ?? '';
        $favorite_place = $_POST['favorite_place'] ?? '';
        $nickname = $_POST['nickname'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        
        if ($name && $email) {
            $this->model->create($name, $date_of_birth, $favorite_color, $favorite_place, $nickname, $email, $phone);
            $this->redirect('?page=personal_info&success=created');
        } else {
            $this->redirect('?page=personal_info&error=missing_fields');
        }
    }
    
    private function handleUpdate() {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $date_of_birth = $_POST['date_of_birth'] ?? '';
        $favorite_color = $_POST['favorite_color'] ?? '';
        $favorite_place = $_POST['favorite_place'] ?? '';
        $nickname = $_POST['nickname'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        
        if ($id && $name && $email) {
            $this->model->update($id, $name, $date_of_birth, $favorite_color, $favorite_place, $nickname, $email, $phone);
            $this->redirect('?page=personal_info&success=updated');
        } else {
            $this->redirect('?page=personal_info&error=missing_fields');
        }
    }
    
    private function handleDelete($id) {
        if ($this->model->delete($id)) {
            $this->redirect('?page=personal_info&success=deleted');
        } else {
            $this->redirect('?page=personal_info&error=delete_failed');
        }
    }
}
?>

