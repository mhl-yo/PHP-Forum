<?php

class AccountModel extends BaseModel
{
    //REGISTRATION
    public function register($username, $password, $fName, $lName, $email)
    {
        $resultsArray = [];

//        $statement = self::$db->prepare("SELECT COUNT(id) FROM users WHERE username = ?");
//        $statement->bind_param("s", $username);
//        $statement->execute();
//        $result = $statement->get_result()->fetch_assoc();
//        if ($result['COUNT(id)']) {
//            return false;
//        }

//        while ($row = $statement->get_result()->fetch_assoc()) {
//            array_push($resultsArray, $row);
//            if ($row['COUNT(id)']) {
//                return false;
//            }
//        }

        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $registerStatement = self::$db->prepare(
            "INSERT INTO users (username, password, fname, lname, email) VALUES (?, ?, ?, ?, ?)");
        $registerStatement->bind_param("sssss", $username, $hash_pass, $fName, $lName, $email);
        $registerStatement->execute();
        return $registerStatement->affected_rows > 0;
        //return true;
    }


    //LOGIN
    public function login($username, $password)
    {
        $resultsArray = [];
        $statement = self::$db->query(
            "SELECT id, username, password FROM users WHERE username = '$username'");
        //$statement = self::$db->prepare("SELECT id, username, password FROM users WHERE username = ?");
        //$statement->bind_param("s", $username);
        //$statement->execute();
        //$result = $statement->get_result()->fetch_assoc();

        while ($row = $statement->fetch_assoc()) {
            // do what you need.
            array_push($resultsArray, $row);
        }

        if (password_verify($password, $resultsArray[0]['password'])) {
            return true;
        }

        return false;
    }


    //PROFILE INFO
    public function getUserData($username)
    {
        $resultsArray = [];

        $statement = self::$db->query(
            "SELECT * FROM users WHERE username LIKE '$username'");
        //return $statement->fetch_all(MYSQLI_ASSOC);

        while ($row = $statement->fetch_assoc()) {
            array_push($resultsArray, $row);
        }

        return $resultsArray;
    }

    public function viewUser($userId)
    {
        $resultsArray = [];

        $statement = self::$db->query(
            "SELECT * FROM users WHERE id = $userId");
        //return $statement->fetch_all(MYSQLI_ASSOC);

        while ($row = $statement->fetch_assoc()) {
            array_push($resultsArray, $row);
        }

        return $resultsArray;
    }


    public function editProfile($userId, $fName, $lName, $email)
    {
//        $hash_pass = password_hash($password, PASSWORD_BCRYPT);
//
//        $registerStatement = self::$db->prepare("INSERT INTO users (fname, lname, email) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE fname=?, lname=?, email=? WHERE id = $userId");
//        $registerStatement->bind_param("sss", $fName, $lName, $email);
//        $registerStatement->execute();
//
//        return true;
    }


    //ADMIN FUNCTIONS
    public function getAllUsers()
    {
        $resultsArray = [];

        $statement = self::$db->query(
            "SELECT * FROM users ORDER BY id");
        //return $statement->fetch_all(MYSQLI_ASSOC);

        while ($row = $statement->fetch_assoc()) {
            array_push($resultsArray, $row);
        }

        return $resultsArray;
    }

    public function deleteUser($id)
    {
        $statement = self::$db->prepare(
            "DELETE FROM users WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function promoteAdmin($id)
    {
        $value = 1;
        //$sql='INSERT INTO t1(id,v1) VALUES(:id,:v1) ON DUPLICATE KEY UPDATE v1=values(v1)';
        //INSERT INTO users (id, isAdmin) VALUES (8, 1) ON DUPLICATE KEY UPDATE isAdmin = 0;
        $registerStatement = self::$db->prepare("INSERT INTO users (id, isAdmin) VALUES ($id, 0) ON DUPLICATE KEY UPDATE isAdmin = $value");
        //$registerStatement->bind_param("i", $value);
        $registerStatement->execute();
        return true;
    }

    public function downgradeAdmin($id)
    {
        $value = 0;
        $registerStatement = self::$db->prepare("INSERT INTO users (id, isAdmin) VALUES ($id, 0) ON DUPLICATE KEY UPDATE isAdmin = $value");
        //$registerStatement->bind_param("i", $value);
        $registerStatement->execute();
        return true;
    }
}