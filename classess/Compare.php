<?php
    $filePath = realpath(dirname(__FILE__));

    include_once ($filePath.'/../lib/Database.php');
    include_once ($filePath.'/../helpers/Format.php');

    class Compare
    {
        private $db;
        private $format;


        public function __construct()
        {
            $this -> db     = new Database();
            $this -> format = new Format();    
        }

        public function insert($product_id, $user_id)
        {
            $product_id     = $this -> format -> validation($product_id);
            $product_id     = mysqli_real_escape_string($this -> db -> link, $product_id);

            $user_id        = $this -> format -> validation($user_id);
            $user_id        = mysqli_real_escape_string($this -> db -> link, $user_id);

            $query          = "SELECT * FROM compare  WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $result         = $this->db->select($query);

            if($result)
            {
                $message = "Already Added.";
                return $message;
            }

            $query      = "SELECT * FROM `products` WHERE `id` = '$product_id'";
            $result     = $this->db->select($query)->fetch_assoc();

            if($result)
            {
                $product_id     = $result['id'];
                $product_name   = $result['name'];
                $price          = $result['price'];
                $image          = $result['image'];
                $query          = "INSERT INTO compare(user_id, product_id, product_name, price, image) VALUES (
                    '$user_id', '$product_id', '$product_name', '$price', '$image'
                )";
                $result         = $this->db->insert($query);

                if($result)
                {
                    $message = "Added to Compare List.";
                    return $message;
                }
                else
                {
                    $message = "Not Added to Compare List.";
                    return $message;
                }
            }
        }

        public function is_compare_empty($id)
        {
            $query      = "SELECT * FROM compare  WHERE user_id = '$id'";
            $result     = $this->db->select($query);

            return $result;
        }


        public function get_all_compare_list($id)
        {
            $query      = "SELECT * FROM compare  WHERE user_id = '$id'";
            $result     = $this->db->select($query);

            return $result;
        }

        public function delete($id)
        {
            $query      = "DELETE FROM compare WHERE user_id = '$id'";
            $this->db->delete($query);
        }
        
    }