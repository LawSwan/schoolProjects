<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../Model/AddressModel.php';

class AddressController extends BaseController {
    private $addressModel;
    
    public function __construct() {
        $this->addressModel = new AddressModel();
    }
    
    public function index() {
        $search = $this->getGet('search');
        
        if ($search) {
            $addresses = $this->addressModel->search($search);
        } else {
            $addresses = $this->addressModel->getAll();
        }
        
        $editRecord = null;
        $action = $this->getGet('action');
        
        if ($action === 'edit') {
            $id = $this->getGet('id');
            $editRecord = $this->addressModel->getById($id);
        }
        
        $flashMessage = $this->getFlashMessage();
        
        $this->render('address/index', [
            'addresses' => $addresses,
            'editRecord' => $editRecord,
            'search' => $search,
            'flashMessage' => $flashMessage,
            'pageTitle' => 'Week 3 - Address Management System'
        ]);
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first = $this->getPost('first');
            $last = $this->getPost('last');
            $street = $this->getPost('street');
            $city = $this->getPost('city');
            $state = strtoupper($this->getPost('state'));
            $zip = $this->getPost('zip');
            
            // Validation
            $errors = $this->validateAddress($first, $last, $street, $city, $state, $zip);
            
            if (empty($errors)) {
                try {
                    $this->addressModel->create($first, $last, $street, $city, $state, $zip);
                    $this->setFlashMessage('success', 'Address added successfully!');
                    $this->redirect('week3');
                } catch (Exception $e) {
                    $this->setFlashMessage('error', 'Error adding address: ' . $e->getMessage());
                }
            } else {
                $this->setFlashMessage('error', implode('<br>', $errors));
            }
        }
        
        $this->redirect('week3');
    }
    
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $this->getPost('id');
            $first = $this->getPost('first');
            $last = $this->getPost('last');
            $street = $this->getPost('street');
            $city = $this->getPost('city');
            $state = strtoupper($this->getPost('state'));
            $zip = $this->getPost('zip');
            
            // Validation
            $errors = $this->validateAddress($first, $last, $street, $city, $state, $zip);
            
            if (empty($errors)) {
                try {
                    $this->addressModel->update($id, $first, $last, $street, $city, $state, $zip);
                    $this->setFlashMessage('success', 'Address updated successfully!');
                } catch (Exception $e) {
                    $this->setFlashMessage('error', 'Error updating address: ' . $e->getMessage());
                }
            } else {
                $this->setFlashMessage('error', implode('<br>', $errors));
            }
        }
        
        $this->redirect('week3');
    }
    
    public function delete() {
        $id = $this->getGet('id');
        
        if ($id) {
            try {
                $this->addressModel->delete($id);
                $this->setFlashMessage('success', 'Address deleted successfully!');
            } catch (Exception $e) {
                $this->setFlashMessage('error', 'Error deleting address: ' . $e->getMessage());
            }
        }
        
        $this->redirect('week3');
    }
    
    private function validateAddress($first, $last, $street, $city, $state, $zip) {
        $errors = [];
        
        if (empty($first) || strlen($first) > 25) {
            $errors[] = 'First name is required and must be 25 characters or less.';
        }
        
        if (empty($last) || strlen($last) > 30) {
            $errors[] = 'Last name is required and must be 30 characters or less.';
        }
        
        if (empty($street) || strlen($street) > 100) {
            $errors[] = 'Street address is required and must be 100 characters or less.';
        }
        
        if (empty($city) || strlen($city) > 25) {
            $errors[] = 'City is required and must be 25 characters or less.';
        }
        
        if (empty($state) || strlen($state) !== 2) {
            $errors[] = 'State is required and must be exactly 2 characters.';
        }
        
        if (empty($zip) || strlen($zip) > 10) {
            $errors[] = 'ZIP code is required and must be 10 characters or less.';
        }
        
        return $errors;
    }
}
?>

