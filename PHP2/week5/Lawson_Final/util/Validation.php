<?php
namespace Util;

class Validation {
    // Validate User ID - at least 4 characters
    public static function validateUserId($userId) {
        $userId = trim($userId);
        if (strlen($userId) == 0) {
            return "Required";
        }
        if (strlen($userId) < 4) {
            return "Must be at least 4 characters.";
        }
        return '';
    }

    // Validate Password - 4-20 chars, one upper, one lower, one digit, one special char
    public static function validatePassword($password) {
        $password = trim($password);
        if (strlen($password) == 0) {
            return "Required";
        }
        if (strlen($password) < 4 || strlen($password) > 20) {
            return "Password must be 4-20 chars including at least one upper, one lower, one digit, and a special char in the set \$!@*#";
        }
        // Check for uppercase
        if (!preg_match('/[A-Z]/', $password)) {
            return "Password must be 4-20 chars including at least one upper, one lower, one digit, and a special char in the set \$!@*#";
        }
        // Check for lowercase
        if (!preg_match('/[a-z]/', $password)) {
            return "Password must be 4-20 chars including at least one upper, one lower, one digit, and a special char in the set \$!@*#";
        }
        // Check for digit
        if (!preg_match('/[0-9]/', $password)) {
            return "Password must be 4-20 chars including at least one upper, one lower, one digit, and a special char in the set \$!@*#";
        }
        // Check for special char
        if (!preg_match('/[\$!@*#]/', $password)) {
            return "Password must be 4-20 chars including at least one upper, one lower, one digit, and a special char in the set \$!@*#";
        }
        return '';
    }

    // Validate First Name - at least 2 characters
    public static function validateFirstName($firstName) {
        $firstName = trim($firstName);
        if (strlen($firstName) == 0) {
            return "Required";
        }
        if (strlen($firstName) < 2) {
            return "Must be at least 2 characters.";
        }
        return '';
    }

    // Validate Last Name - at least 2 characters
    public static function validateLastName($lastName) {
        $lastName = trim($lastName);
        if (strlen($lastName) == 0) {
            return "Required";
        }
        if (strlen($lastName) < 2) {
            return "Must be at least 2 characters.";
        }
        return '';
    }

    // Validate Hire Date - must be a valid date
    public static function validateHireDate($hireDate) {
        $hireDate = trim($hireDate);
        if (strlen($hireDate) == 0) {
            return "Required";
        }
        // Check if it's a valid date format (YYYY-MM-DD from HTML5 date input)
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $hireDate)) {
            return "Invalid date format.";
        }
        // Validate the actual date
        $parts = explode('-', $hireDate);
        if (!checkdate(intval($parts[1]), intval($parts[2]), intval($parts[0]))) {
            return "Invalid date.";
        }
        return '';
    }

    // Validate Email using PHP built-in validation
    public static function validateEmail($email) {
        $email = trim($email);
        if (strlen($email) == 0) {
            return "Required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Not a valid email address.";
        }
        return '';
    }

    // Validate Extension - exactly 5 digits
    public static function validateExtension($extension) {
        $extension = trim($extension);
        if (strlen($extension) == 0) {
            return "Required";
        }
        if (!preg_match('/^\d{5}$/', $extension)) {
            return "Invalid Extension - 5 digits only";
        }
        return '';
    }

    // Validate User Level - must be 1 or 2
    public static function validateLevel($level) {
        $level = intval($level);
        if ($level != 1 && $level != 2) {
            return "Invalid level selected.";
        }
        return '';
    }

    // Validate all user fields at once
    public static function validateUserFields($userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $level) {
        $errors = [];

        $errors['userId'] = self::validateUserId($userId);
        $errors['password'] = self::validatePassword($password);
        $errors['firstName'] = self::validateFirstName($firstName);
        $errors['lastName'] = self::validateLastName($lastName);
        $errors['hireDate'] = self::validateHireDate($hireDate);
        $errors['email'] = self::validateEmail($email);
        $errors['extension'] = self::validateExtension($extension);
        $errors['level'] = self::validateLevel($level);

        return $errors;
    }

    // Check if any errors exist
    public static function hasErrors($errors) {
        foreach ($errors as $error) {
            if (!empty($error)) {
                return true;
            }
        }
        return false;
    }
}
