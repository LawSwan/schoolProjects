<?php
namespace Model;

require_once(__DIR__ . '/Database.php');

class UserDB {
    // Get all users with their level names
    public static function getAllUsers() {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT u.*, ul.LevelName
                      FROM users u
                      INNER JOIN user_levels ul ON u.UserLevelNo = ul.UserLevelNo
                      ORDER BY u.LastName, u.FirstName";
            $result = $dbConn->query($query);

            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        }
        return false;
    }

    // Get a user by UserId
    public static function getUserById($userId) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $userId = $dbConn->real_escape_string($userId);
            $query = "SELECT u.*, ul.LevelName
                      FROM users u
                      INNER JOIN user_levels ul ON u.UserLevelNo = ul.UserLevelNo
                      WHERE u.UserId = '$userId'";
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        }
        return false;
    }

    // Get user by UserId for login validation
    public static function getUserForLogin($userId) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $userId = $dbConn->real_escape_string($userId);
            $query = "SELECT * FROM users WHERE UserId = '$userId'";
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        }
        return false;
    }

    // Add a new user
    public static function addUser($userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $levelNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $userId = $dbConn->real_escape_string($userId);
            $password = $dbConn->real_escape_string($password);
            $firstName = $dbConn->real_escape_string($firstName);
            $lastName = $dbConn->real_escape_string($lastName);
            $hireDate = $dbConn->real_escape_string($hireDate);
            $email = $dbConn->real_escape_string($email);
            $extension = $dbConn->real_escape_string($extension);
            $levelNo = intval($levelNo);

            $query = "INSERT INTO users (UserId, Password, FirstName, LastName, HireDate, EMail, Extension, UserLevelNo)
                      VALUES ('$userId', '$password', '$firstName', '$lastName', '$hireDate', '$email', '$extension', $levelNo)";
            return $dbConn->query($query);
        }
        return false;
    }

    // Update an existing user
    public static function updateUser($userNo, $userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $levelNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $userNo = intval($userNo);
            $userId = $dbConn->real_escape_string($userId);
            $password = $dbConn->real_escape_string($password);
            $firstName = $dbConn->real_escape_string($firstName);
            $lastName = $dbConn->real_escape_string($lastName);
            $hireDate = $dbConn->real_escape_string($hireDate);
            $email = $dbConn->real_escape_string($email);
            $extension = $dbConn->real_escape_string($extension);
            $levelNo = intval($levelNo);

            $query = "UPDATE users SET
                      UserId = '$userId',
                      Password = '$password',
                      FirstName = '$firstName',
                      LastName = '$lastName',
                      HireDate = '$hireDate',
                      EMail = '$email',
                      Extension = '$extension',
                      UserLevelNo = $levelNo
                      WHERE UserNo = $userNo";
            return $dbConn->query($query);
        }
        return false;
    }

    // Delete a user
    public static function deleteUser($userNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $userNo = intval($userNo);
            $query = "DELETE FROM users WHERE UserNo = $userNo";
            return $dbConn->query($query);
        }
        return false;
    }

    // Check if UserId already exists (for validation)
    public static function userIdExists($userId, $excludeUserNo = null) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $userId = $dbConn->real_escape_string($userId);
            $query = "SELECT UserNo FROM users WHERE UserId = '$userId'";
            if ($excludeUserNo !== null) {
                $excludeUserNo = intval($excludeUserNo);
                $query .= " AND UserNo != $excludeUserNo";
            }
            $result = $dbConn->query($query);
            return $result->num_rows > 0;
        }
        return false;
    }
}
