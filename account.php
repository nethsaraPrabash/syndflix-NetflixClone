<?php

    class Account {

        private $con;
        private $errorArray = array();

        public function __construct($con){

            $this->con = $con;
        }

        public function register($fn, $ln, $un, $em, $pw, $pw2){
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateUsername($un);
            $this->validateEmail($em);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)){
                return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
            }

            return false;
        }

        public function login($un,$pw)
        {
            $pw = hash("sha512", $pw); 
            $query = $this->con->prepare("SELECT * FROM users WHERE uname=:un AND pword=:pw");
            $query->bindValue(":un", $un);
            $query->bindValue(":pw", $pw);

            $query->execute();

            if($query->rowCount() == 1){
                return true;
            }

            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }

        public function insertUserDetails($fn, $ln, $un, $em, $pw){

            $pw = hash("sha512", $pw);
            
            // Generate the next custom ID
            $query = $this->con->prepare("SELECT MAX(CAST(SUBSTRING(id, 2) AS UNSIGNED)) AS max_id FROM users");
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $next_id = isset($result['max_id']) ? $result['max_id'] + 1 : 1;
            $custom_id = 'U' . str_pad($next_id, 3, '0', STR_PAD_LEFT); // Pad with zeros to make it 3 digits

            

            // Insert the user details with the custom ID
            $query = $this->con->prepare("INSERT INTO users (id, firstName, lastName, uname, email, pword) VALUES (:id, :firstName, :lastName, :uname, :email, :pword)");
            $query->bindValue(":id", $custom_id);
            $query->bindValue(":firstName", $fn);
            $query->bindValue(":lastName", $ln);
            $query->bindValue(":uname", $un);
            $query->bindValue(":email", $em);
            $query->bindValue(":pword", $pw);

            return $query->execute();

        }

        public function validateFirstName($fn){
            if(strlen($fn) < 2 || strlen($fn) > 25){
                
                array_push($this->errorArray, Constants::$firstNameCharacters);
            }
        }

        public function validateLastName($fn){
            if(strlen($fn) < 2 || strlen($fn) > 25){
                
                array_push($this->errorArray, Constants::$lastNameCharacters);
            }
        }

        public function validateUsername($un){
            if(strlen($un) < 2 || strlen($un) > 25){
                
                array_push($this->errorArray, Constants::$usernameCharacters);
            
        }
    }

        public function validateEmail($em){
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constants::$emailInvalid);
            }
        }

        public function validatePasswords($pw, $pw2){
            if($pw != $pw2){
                array_push($this->errorArray, Constants::$passwordDoNotMatch);
            }

            if(strlen($pw) < 5 || strlen($pw) > 25){
                array_push($this->errorArray, Constants::$passwordLength);
            }
        }

        

        public function getError($error){
            if(in_array($error, $this->errorArray)){
                return "<span class='errorMessage'>$error</span>";
            }
        }

    }

?>