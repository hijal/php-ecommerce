<?php

    $filePath = realpath(dirname(__FILE__));

    include_once ($filePath.'/../lib/Database.php');
    include_once ($filePath.'/../helpers/Format.php');
?>

<?php
    class Brand 
    {
        private $db;
        private $format;

        public function __construct()
        {
            $this -> db     = new Database();
            $this -> format = new Format();
        }

        public function insert($name)
        {
            $name   = $this -> format -> validation($name);
            $name   = mysqli_real_escape_string($this -> db -> link, $name);

            if(empty($name))
            {
                $message    = "Brand field empty."; 
                return $message;
            }
            else
            {
                $query      = "INSERT INTO brands (name) VALUES ('$name')";
                $result     = $this -> db -> insert($query);

                if($result)
                {
                    $message    = "Brand Insert successfully.";
                    return $message;
                }
                else
                {
                    $message    = "Sorry !! Brand not insert.";
                    return $message;
                }
            }           
        }
        
        public function get_all_brand()
        {
            $query      = "SELECT * FROM brands";
            $result     = $this -> db -> select($query);

            return $result;
        }

        public function get_brand_by_id($id)
        {
            $query      = "SELECT * FROM brands where id = '$id'";
            $result     = $this -> db -> select($query);
            return $result;
        }

        public function update($name, $id)
        {
            $name   = $this -> format -> validation($name);
            $id     = $this -> format -> validation($id);

            $name   = mysqli_real_escape_string($this -> db -> link, $name);
            $id     = mysqli_real_escape_string($this -> db -> link, $id);

            if(empty($name))
            {
                $message    = "Brand Field empty!!"; 
                return $message;
            }
            else
            {
                $query      = "UPDATE brands SET name = '$name' where id = '$id'";   
                $result     = $this -> db -> update($query);

                if($result)
                {
                    $message    = "Brand Updated!!";
                    return $message;
                }
                else
                {
                    $message    = "Not Updated!!";
                    return $message;
                }
            }
        }
        public function delete($id)
        {
            $query      = "DELETE FROM brands where id = '$id'";
            $delbrand   = $this -> db -> delete($query);

            if($delbrand)
            {
                $message    = "Brand Deleted Successfully";
                return $message;
            }
            else
            {
                $message    = "Brand Not Deleted";
                return $message;
            }
        }
    }