<?php
    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath.'/../lib/Database.php');
    include_once ($filePath.'/../helpers/Format.php');

    class Whislist
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

            $user_id    = $this -> format -> validation($user_id);
            $user_id    = mysqli_real_escape_string($this -> db -> link, $user_id);

            $query      = "SELECT * FROM whislists  WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $result     = $this->db->select($query);
            if($result)
            {
                $message    = "Already Added!";
                return $message;
            }

            $query      = "SELECT * FROM `products` WHERE `id` = '$product_id'";
            $result     = $this->db->select($query)->fetch_assoc();

            if($result)
            {
                $productId      = $result['id'];
                $productName    = $result['name'];
                $price          = $result['price'];
                $image          = $result['image'];
                $newQuery       = "INSERT INTO `whislists`(`user_id`, `product_id`, `product_name`, `price`, `image`) VALUES (
                    '$user_id', '$productId', '$productName', '$price', '$image'
                )";

                $insertWList    = $this->db->insert($newQuery);

                if($insertWList)
                {
                    $message    = "Added to WishList";
                    return $message;
                }
                else
                {
                    $message    = "Not Added to WishList";
                    return $message;
                }
            }
        }

        public function is_whislist_empty($user_id)
        {
            $query      = "SELECT * FROM whislists  where user_id = '$user_id'";
            $result     = $this->db->select($query);

            return $result;
        }

        public function delete($user_id, $product_id)
        {
            $query      = "DELETE FROM whislists WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $result     = $this->db->delete($query);

            return $result;
        }
        
    }