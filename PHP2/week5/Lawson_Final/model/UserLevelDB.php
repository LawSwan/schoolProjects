<?php
namespace Model;

require_once(__DIR__ . '/Database.php');

class UserLevelDB {
    // Get all user levels
    public static function getAllLevels() {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT * FROM user_levels ORDER BY UserLevelNo";
            $result = $dbConn->query($query);

            $levels = [];
            while ($row = $result->fetch_assoc()) {
                $levels[] = $row;
            }
            return $levels;
        }
        return false;
    }

    // Get a level by its number
    public static function getLevelById($levelNo) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $levelNo = intval($levelNo);
            $query = "SELECT * FROM user_levels WHERE UserLevelNo = $levelNo";
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        }
        return false;
    }
}
