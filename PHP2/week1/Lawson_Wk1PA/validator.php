<?php
namespace lawson_validator;

// Validate name format: Lastname, Firstname using REGEX
// Parameter passed by value, returns error message or empty string
function validateName($name) {
    if (strlen(trim($name)) == 0) {
        return "Required Entry";
    }

    // REGEX: Check for "Lastname, Firstname" format
    if (!preg_match("/^([A-Za-z]{2,}),\s*([A-Za-z]+)$/", trim($name), $matches)) {
        return "Name format is Last, First - must have a comma";
    }

    // Validate lastname is at least 2 characters
    if (strlen($matches[1]) < 2) {
        return "Last Name Error: Must be at least 2 characters.";
    }

    // Validate firstname is at least 1 character
    if (strlen($matches[2]) < 1) {
        return "First Name Error: Must be at least 1 characters.";
    }

    return '';
}

// Validate date of birth format MM/DD/YYYY using REGEX
// Parameter passed by value, returns error message or empty string
function validateDateOfBirth($dob) {
    if (strlen(trim($dob)) == 0) {
        return "Required";
    }

    // REGEX: Check for MM/DD/YYYY format
    if (!preg_match("/^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/(\d{4})$/", trim($dob))) {
        return "Invalid date or format: mm/dd/yyyy expected.";
    }

    return '';
}

// Validate email using PHP built-in validation
// Parameter passed by reference for error message
function validateEmail($email, &$error) {
    if (strlen(trim($email)) == 0) {
        $error = "Required";
        return;
    }

    // PHP built-in format validation
    if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
        $error = "Not a valid email address.";
    } else {
        $error = '';
    }
}

// Validate integer using exceptions
// Parameter passed by value, throws exception if invalid
function validateInteger($value) {
    if (strlen(trim($value)) == 0) {
        throw new \Exception("Required");
    }

    // Exception handling: Check if value is an integer
    if (!ctype_digit(trim($value))) {
        throw new \Exception("Not an integer value.");
    }
}

// Validate nickname (optional field) using control logic (if-else)
// Parameter passed by value, returns error message or empty string
function validateNickname($nickname) {
    // Control logic: if-else statement
    if (strlen(trim($nickname)) > 0) {
        // If nickname is entered, it must be at least 2 characters
        if (strlen(trim($nickname)) < 2) {
            return "Must be at least 2 characters.";
        } else {
            return '';
        }
    } else {
        // Nickname is optional, so empty is valid
        return '';
    }
}
