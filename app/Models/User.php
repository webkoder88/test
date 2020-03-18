<?php


namespace App\Models;

use PDO;

class User
{
    /**
     * @param $email
     * @param $password
     * @param $name
     * @return array
     */
    public static function create($email, $password, $name)
    {
        global $pdo;

        $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['num'] > 0) {
            return modelResponse(false, _('Email already exists'));
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

        $sql = "INSERT INTO users (email, password, name) VALUES (:email, :password, :name)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $passwordHash);
        $stmt->bindValue(':name', $name);
        $result = $stmt->execute();

        if ($result) {
            return modelResponse(
                true,
                _('Registration successful please sign in'),
                [
                    'result' => $result
                ]
            );
        }

        return modelResponse(false, _('Something went wrong'));
    }

    /**
     * @param $email
     * @param $password
     * @param $name
     * @return array
     */
    public static function update($id, $email, $name)
    {
        global $pdo;

        $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email AND id <> :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['num'] > 0) {
            return modelResponse(false, _('Email already exists'));
        }

        $sql = "UPDATE users SET email = :email, name = :name WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $result = $stmt->execute();

        if ($result) {
            return modelResponse(
                true,
                _('User data updated successfully'),
                [
                    'result' => $result
                ]
            );
        }

        return modelResponse(false, _('Something went wrong'));
    }

    /**
     * @param $id
     * @param $old_password
     * @param $new_password
     * @return array
     */
    public static function change_password($id, $old_password, $new_password)
    {
        global $pdo;

        $sql = "SELECT id, password FROM users WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $validPassword = password_verify($old_password, $user['password']);

            if ($validPassword) {

                $passwordHash = password_hash($new_password, PASSWORD_BCRYPT, array("cost" => 12));

                $sql = "UPDATE users SET password = :password WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':password', $passwordHash);
                $stmt->bindValue(':id', $id);
                $result = $stmt->execute();
                if ($result) {
                    return modelResponse(
                        true,
                        'Password changed'
                    );
                }

            }else{
                return modelResponse(false, _('Old password incorrect'));
            }
        }

        return modelResponse(false, _('Something went wrong'));

    }

    /**
     * @param $email
     * @param $password
     * @return array
     */
    public static function login($email, $password)
    {
        global $pdo;

        $sql = "SELECT id, email, password, name FROM users WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user === false) {
            return modelResponse(false, _('Email or password incorrect'));
        } else {
            $validPassword = password_verify($password, $user['password']);

            if ($validPassword) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged_in'] = time();

                return modelResponse(
                    true,
                    _('Login successful'),
                    [
                        'user' => $user
                    ]
                );
            }

            return modelResponse(false, _('Email or password incorrect'));
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function get($id)
    {
        global $pdo;

        $sql = "SELECT id, email, name FROM users WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
