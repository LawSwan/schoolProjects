<?php
namespace Controller;

require_once(__DIR__ . '/../model/UserDB.php');
require_once(__DIR__ . '/../model/UserLevelDB.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/UserLevel.php');

use Model\UserDB;
use Model\UserLevelDB;

class UserController {
    // Convert DB row to User object
    private static function rowToUser($row) {
        return new User(
            $row['UserId'],
            $row['Password'],
            $row['FirstName'],
            $row['LastName'],
            $row['HireDate'],
            $row['EMail'],
            $row['Extension'],
            $row['UserLevelNo'],
            $row['LevelName'] ?? null,
            $row['UserNo']
        );
    }

    // Validate login credentials
    public static function validUser($userId, $password) {
        $row = UserDB::getUserForLogin($userId);
        if ($row) {
            if ($row['Password'] === $password) {
                return $row['UserLevelNo'];
            }
        }
        return false;
    }

    // Get all users as User objects
    public static function getAllUsers() {
        $rows = UserDB::getAllUsers();
        if ($rows) {
            $users = [];
            foreach ($rows as $row) {
                $users[] = self::rowToUser($row);
            }
            return $users;
        }
        return [];
    }

    // Get user by UserId
    public static function getUserById($userId) {
        $row = UserDB::getUserById($userId);
        if ($row) {
            return self::rowToUser($row);
        }
        return null;
    }

    // Add a new user
    public static function addUser($userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $levelNo) {
        return UserDB::addUser($userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $levelNo);
    }

    // Update a user
    public static function updateUser($userNo, $userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $levelNo) {
        return UserDB::updateUser($userNo, $userId, $password, $firstName, $lastName, $hireDate, $email, $extension, $levelNo);
    }

    // Delete a user
    public static function deleteUser($userNo) {
        return UserDB::deleteUser($userNo);
    }

    // Check if UserId exists
    public static function userIdExists($userId, $excludeUserNo = null) {
        return UserDB::userIdExists($userId, $excludeUserNo);
    }

    // Get all user levels
    public static function getAllLevels() {
        $rows = UserLevelDB::getAllLevels();
        if ($rows) {
            $levels = [];
            foreach ($rows as $row) {
                $levels[] = new UserLevel($row['UserLevelNo'], $row['LevelName']);
            }
            return $levels;
        }
        return [];
    }
}
