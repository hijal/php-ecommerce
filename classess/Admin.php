<?php
   
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

    class Admin
    {
        private $db;
        private $format;


        public function __construct()
        {
            $this -> db     = new Database();
            $this -> format = new Format();    
        }

        public function login($username, $password)
        {
            $username   = $this -> format -> validation($username);
            $password   = $this -> format -> validation($password);

            $username   = mysqli_real_escape_string($this -> db -> link, $username);
            $password   = mysqli_real_escape_string($this -> db -> link, $password);

            if(empty($username) || empty($password))
            {
                $message    = "Username and Password must not be empty!"; 
                return $message;
            }
            else
            {
                $query      = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
                $result     = $this->db-> select($query);

                if($result != false)
                {
                    $value  = $result->fetch_assoc();

                    Session::set('login', true);
                    Session::set('id', $value['id']);
                    Session::set('username', $value['username']);
                    Session::set('name', $value['name']);

                    header("Location: index.php");
                }
                else
                {
                    $message    = "Username and password not matched!! ";
                    return $message;
                }
            }
        }
        
    }