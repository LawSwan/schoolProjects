<?php
require_once 'BaseController.php';

class Week2Controller extends BaseController {
    
    public function index() {
        $formData = [];
        $results = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = [
                'name' => $this->getPost('name'),
                'dob' => $this->getPost('dob'),
                'color' => $this->getPost('color'),
                'place' => $this->getPost('place'),
                'nickname' => $this->getPost('nickname')
            ];
            
            // Process and validate the form data
            $results = $this->processFormData($formData);
        }
        
        $this->render('week2/index', [
            'pageTitle' => 'Week 2 - Form Handling & Validation',
            'formData' => $formData,
            'results' => $results
        ]);
    }
    
    private function processFormData($data) {
        $results = [];
        
        foreach ($data as $field => $value) {
            $fieldName = ucfirst($field);
            if ($field === 'dob') {
                $fieldName = 'Date of Birth';
            } elseif ($field === 'color') {
                $fieldName = 'Favorite Color';
            } elseif ($field === 'place') {
                $fieldName = 'Favorite Place to Visit';
            }
            
            if (!empty($value)) {
                $results[] = [
                    'field' => $fieldName,
                    'value' => htmlspecialchars($value),
                    'status' => 'success'
                ];
            } else {
                $results[] = [
                    'field' => $fieldName,
                    'value' => "You didn't enter your " . strtolower($fieldName),
                    'status' => 'missing'
                ];
            }
        }
        
        return $results;
    }
}
?>

