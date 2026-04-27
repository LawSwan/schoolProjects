<?php
namespace Util;

class Security {
    // Perform logout
    public static function logout() {
        session_start();
        session_unset();
        session_destroy();

        // Start new session for logout message
        session_start();
        $_SESSION['logout_msg'] = 'Successfully logged out.';
        header('Location: ../index.php');
        exit();
    }

    // Check if user has required authority level
    public static function checkAuthority($requiredLevel) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] != $requiredLevel) {
            $_SESSION['logout_msg'] = 'Current login unauthorized for this page.';
            header("Location: ../index.php");
            exit();
        }
    }

    // Check if user is logged in at all
    public static function checkLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            $_SESSION['logout_msg'] = 'Please log in to access this page.';
            header("Location: ../index.php");
            exit();
        }
    }

    // Check if user is admin (level 1)
    public static function checkAdmin() {
        self::checkLoggedIn();
        if ($_SESSION['user_level'] != 1) {
            $_SESSION['logout_msg'] = 'Administrator access required.';
            header("Location: ../index.php");
            exit();
        }
    }

    // Check if user is technician (level 2)
    public static function checkTech() {
        self::checkLoggedIn();
        if ($_SESSION['user_level'] != 2) {
            $_SESSION['logout_msg'] = 'Technician access required.';
            header("Location: ../index.php");
            exit();
        }
    }
}
