<?php

// require_once 'dbconnection.php';

class Users {
  private function dbConnect () {
    try {
        return new PDO("pgsql:host=mydbinstance.c88rdqqi0kpv.eu-west-2.rds.amazonaws.com;dbname=masterdb", "master", "master123");
    } catch(PDOException $e){
        die($e->getMessage());
    }
  }
  //===============================================USER LOGIN================================================
   public function login($data) {
        $username = $data['username'];
        $password = md5($data['password']);
        if(!empty($username) && !empty($password)){
            // Prepare a select statement
            $sql  = "SELECT id, firstname, lastname, username, phone, email, group_id, status, created_by, created_date, modified_date, last_login  FROM users WHERE username ='".$username."' AND password ='".$password."' ";
            $dbconnection = $this->dbConnect();
            $stmt = $dbconnection->query($sql);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                // if user login was successful
                // update login details [last login]
                $sql = "UPDATE users SET last_login=NOW() WHERE id='" . $user['id'] . "'";
                $dbconnection->exec($sql);
            }
            return ($user) ? ['success'=>true, 'data'=>$user] : ['success'=>false, 'message'=>'Username or password is Incorrect!!'];
        }else{
            return "Username or password is required!!";
        }
    }

     //===============================================GET USERS================================================
     public function getUsers(){
        $sql  = "SELECT *  FROM users ";
        $dbconnection = $this->dbConnect();
        $stmt = $dbconnection->query($sql);
        $users = $stmt->fetchAll();
        if($users){
            return ['success'=>true, 'data'=>$users];
        }else {
        
            return ['success'=>false, 'data'=>[] ];
        }    
    }

     //===============================================Add USER================================================
    public function addUser($data){
        $firstname  = $data['firstname'];
        $lastname   = $data['lastname']; 
        $username   = $data['username'];
        $phone      = $data['phone'];
        $email      = $data['email'];
        $password   = md5("12345"); 
        $group_id   = $data['group_id']; 
        $status     = $data['status'];

        $sql  = "SELECT *  FROM users WHERE username ='".$username."' OR email ='".$email."' ";
            $dbconnection = $this->dbConnect();
            $stmt = $dbconnection->query($sql);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user){
                if($user['username'] == $username){
                    return ['success'=>false, 'message'=>'Username is already exist!!'];
                }else if($user['email'] == $email){
                    return ['success'=>false, 'message'=>'Email address is already exist!!'];
                }
                    
            }else {
                $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO users (firstname, lastname, username, phone, email, password, group_id, status, created_date)
                        VALUES ('$firstname', '$lastname', '$username', '$phone', '$email', '$password', '$group_id', '$status', NOW())";
                $result = $dbconnection->exec($sql);
                return ($result) ? ['success'=>true, 'message'=>'User was successfully added'] : ['success'=>false, 'error'=>$results];
            }

            
    }

    //===============================================UPDATE USER================================================
    public function updateUser($data){
        $user_id    = $data['id'];
        $firstname  = $data['firstname'];
        $lastname   = $data['lastname']; 
        $phone      = $data['phone'];
        $group_id   = $data['group_id']; 
        $status     = $data['status'];

        $dbconnection = $this->dbConnect();
        $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', phone='$phone', group_id=$group_id, status=$status, modified_date=NOW()
                WHERE id='$user_id'";
        $result = $dbconnection->exec($sql);
        return ($result) ? ['success'=>true, 'message'=>'User was successfully updated'] : ['success'=>false, 'error'=>$results];
            
    }

    //===============================================Reset Password USER================================================
    public function resetPassword($data){
        $user_id    = $data['id'];
        $password  = md5('12345');
        $dbconnection = $this->dbConnect();
        $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET password='$password', modified_date=NOW() WHERE id='$user_id'";
        $result = $dbconnection->exec($sql);
        return ($result) ? ['success'=>true, 'message'=>'User was successfully updated'] : ['success'=>false, 'message'=>$results];
            
    }

    //===============================================Change Password USER================================================
    public function changePassword($data){
        $user_id    = $data['id'];
        $password  = md5($data['password']);
        $dbconnection = $this->dbConnect();
        $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET password='$password', modified_date=NOW() WHERE id='$user_id'";
        $result = $dbconnection->exec($sql);
        return ($result) ? ['success'=>true, 'message'=>'User was successfully updated'] : ['success'=>false, 'error'=>$results];

    }

}
?>