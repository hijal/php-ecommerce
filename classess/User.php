<?php

    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath.'/../lib/Database.php');
    include_once ($filePath.'/../helpers/Format.php');

?>

<?php
    class User
    {
        private $db;
        private $format;

        public function __construct()
        {
            $this->db       = new Database();
            $this->format   = new Format();
        }

        public function registration($data)
        {
            $name       = mysqli_real_escape_string($this -> db -> link, $data['name']);
            $city       = mysqli_real_escape_string($this -> db -> link, $data['city']);
            $zipcode    = mysqli_real_escape_string($this -> db -> link, $data['zipcode']);
            $email      = mysqli_real_escape_string($this -> db -> link, $data['email']);
            $address    = mysqli_real_escape_string($this -> db -> link, $data['address']);
            $country    = mysqli_real_escape_string($this -> db -> link, $data['country']);
            $phone      = mysqli_real_escape_string($this -> db -> link, $data['phone']);
            $password   = mysqli_real_escape_string($this -> db -> link, $data['password']);
            $password   = md5($password);

            if($name == "" || $city == "" || $zipcode == "" || $email == '' || $address == "" || $country == "" || $phone == "" || $password == "")
            {
                $message    = "Field Must not be Empty.";
                return $message;
            }
            else
            {
                $query      = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
                $is_exist   = $this->db->select($query);

                if($is_exist != false)
                {
                    $message    = "Email already taken.";
                    return $message;
                }
                else
                {
                    $query      = "INSERT INTO users(name, email, city, address, zipcode, country, password, phone) VALUES (
                        '$name', '$email', '$city', '$address', '$zipcode', '$country', '$password', '$phone'
                    )";
                    $is_insert  = $this->db->insert($query);

                    if($is_insert)
                    {
                        $message    = "user registration successfully.";
                        return $message;
                    }
                    else
                    {
                        $message    = "Sorry ! User Registration not successfully.";
                        return $message;
                    }
                }
            }
            
        }
        public function login($data)
        {
            $email      = $this -> format -> validation($data['email']);
            $email      = mysqli_real_escape_string($this -> db -> link, $data['email']);

            $password   = $this -> format -> validation($data['password']);
            $password   = mysqli_real_escape_string($this -> db -> link, $data['password']);
            $password   = md5($password);

            if($email == "" || $password == "")
            {
                $message    = "Field must not be Empty.";
                return $message;
            }
            $query      = "SELECT * FROM users WHERE email = '$email' && password = '$password'";
            $result     = $this->db->select($query);
            
            if($result != false)
            {
                $value  = $result->fetch_assoc();
                Session :: set('login', true);
                Session :: set('id', $value['id']);
                Session :: set('username', $value['name']);
                header("Location: index.php");
            }
            else
            {   
                $message    = "Invalid email and password.";
                return $message;
            }
        }

        public function getUserData($id)
        {
            $query      = "SELECT * FROM users WHERE id = '$id'";
            $result     = $this -> db -> select($query);

            return $result;
        }

        public function update($data, $id)
        {
            $name       = mysqli_real_escape_string($this -> db -> link, $data['name']);
            $city       = mysqli_real_escape_string($this -> db -> link, $data['city']);
            $zipcode    = mysqli_real_escape_string($this -> db -> link, $data['zipcode']);
            $email      = mysqli_real_escape_string($this -> db -> link, $data['email']);
            $address    = mysqli_real_escape_string($this -> db -> link, $data['address']);
            $country    = mysqli_real_escape_string($this -> db -> link, $data['country']);
            $phone      = mysqli_real_escape_string($this -> db -> link, $data['phone']);

            if($name == "" || $city == "" || $zipcode == "" || $email == '' || $address == "" || $country == "" || $phone == "")
            {
                $message    = "Field Must not be Empty.";
                return $message;
            }
            else
            {
                $query      = "UPDATE users SET name = '$name', city = '$city', zipcode = '$zipcode', email = '$email', address = '$address', country = '$country', phone = '$phone' WHERE id = '$id'";
                $result     = $this->db->update($query);
                
                if($result)
                {
                    $message    = "user update successfully.";
                    return $message;
                }
                else
                {
                    $message    = "Sorry !! User update not successfully.";
                    return $message;
                }
            }
        }
    }