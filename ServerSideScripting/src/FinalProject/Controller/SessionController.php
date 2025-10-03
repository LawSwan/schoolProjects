<?php
require_once 'BaseController.php';

class SessionController extends BaseController {
    
    public function index() {
        // Handle form submission for both cookies and sessions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $this->getPost('action');
            
            if ($action === 'store_data') {
                // Store name in cookie (expires in 1 hour)
                $name = $this->getPost('name');
                if ($name) {
                    setcookie('user_name', $name, time() + 3600, '/');
                }
                
                // Store date of birth in session
                $dob = $this->getPost('date_of_birth');
                if ($dob) {
                    $_SESSION['date_of_birth'] = $dob;
                }
                
                $this->setFlashMessage('success', 'Data stored successfully!');
                $this->redirect('week5');
            } elseif ($action === 'store_session') {
                // Store user name in session
                $user = $this->getPost('user');
                if ($user) {
                    $_SESSION['user'] = $user;
                }
                
                $this->setFlashMessage('success', 'Session data updated!');
                $this->redirect('week5');
            }
        }
        
        // Get stored values
        $storedName = isset($_COOKIE['user_name']) ? $_COOKIE['user_name'] : '';
        $storedBirthdate = isset($_SESSION['date_of_birth']) ? $_SESSION['date_of_birth'] : '';
        $sessionUser = isset($_SESSION['user']) ? $_SESSION['user'] : 'No Entry';
        
        $flashMessage = $this->getFlashMessage();
        
        $this->render('week5/index', [
            'pageTitle' => 'Week 5 - Sessions & Cookies',
            'storedName' => $storedName,
            'storedBirthdate' => $storedBirthdate,
            'sessionUser' => $sessionUser,
            'flashMessage' => $flashMessage
        ]);
    }
    
    public function cookies() {
        $this->render('week5/cookies', [
            'pageTitle' => 'Week 5 - Cookie Example',
            'storedName' => isset($_COOKIE['user_name']) ? $_COOKIE['user_name'] : 'No name stored in cookie',
            'storedBirthdate' => isset($_SESSION['date_of_birth']) ? $_SESSION['date_of_birth'] : 'No birthdate stored in session'
        ]);
    }
    
    public function sessions() {
        $this->render('week5/sessions', [
            'pageTitle' => 'Week 5 - Session Example',
            'sessionUser' => isset($_SESSION['user']) ? $_SESSION['user'] : 'No Entry'
        ]);
    }
}
?>

