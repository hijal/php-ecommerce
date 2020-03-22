<?php

    $filePath = realpath(dirname(__FILE__));

    include_once ($filePath.'/../lib/Database.php');
    include_once ($filePath.'/../helpers/Format.php');
?>

<?php
    class Category
    {
        private $db;
        private $format;

        public function __construct()
        {
            $this->db       = new Database();
            $this->format   = new Format();
        }

        public function insert($category_name)
        {
            $category_name   = $this -> format -> validation($category_name);
            $category_name   = mysqli_real_escape_string($this -> db -> link, $category_name);

            if(empty($category_name))
            {
                $message    = "Category empty."; 
                return $message;
            }
            else
            {
                $query      = "INSERT INTO categories(name) VALUES ('$category_name')";
                $result     = $this -> db -> insert($query);

                if($result)
                {
                    $message    = "Category Insert successfully.";
                    return $message;
                }
                else
                {
                    $message    = "Sorry !! Category not insert.";
                    return $message;
                }
            }           
        }

        public function get_all_category()
        {
            $query     = "SELECT * FROM categories";
            $result    = $this -> db -> select($query);

            return $result;
        }

        public function get_category_by_id($id)
        {
            $query      = "SELECT * FROM categories where id = '$id'";
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
                $message    = "Category empty!!"; 
                return $message;
            }
            else
            {
                $query      = "UPDATE categories SET name = '$name' where id = '$id'";   
                $result     = $this -> db -> update($query);

                if($result)
                {
                    $message    = "Category Updated!!";
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
            $query      = "DELETE FROM categories where id = '$id'";
            $result     = $this -> db -> delete($query);

            if($result)
            {
                $message    = "Category Deleted Successfully";
                return $message;
            }
            else
            {
                $message    = "Category Not Deleted";
                return $message;
            }
        }
    }
?>