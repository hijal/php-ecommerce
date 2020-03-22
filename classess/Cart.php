<?php

    $filePath = realpath(dirname(__FILE__));
    include_once ($filePath.'/../lib/Database.php');
    include_once ($filePath.'/../helpers/Format.php');
?>

<?php
    class Cart
    {
        private $db;
        private $format;

        public function __construct()
        {
            $this->db       = new Database();
            $this->format   = new Format();
        }

        public function insert($quantity, $product_id)
        {
            $quantity       = $this -> format -> validation($quantity);
            $quantity       = mysqli_real_escape_string($this -> db -> link, $quantity);

            $product_id     = $this -> format -> validation($product_id);
            $product_id     = mysqli_real_escape_string($this -> db -> link, $product_id);

            $session_id     = session_id();

            $query          = "SELECT * FROM products WHERE id = '$product_id'";
            $product         = $this-> db->select($query)->fetch_assoc();

            $product_name   = $product['name'];
            $price          = $product['price'];
            $image          = $product['image'];

            $query          = "SELECT * FROM carts WHERE product_id = '$product_id' AND session_id = '$session_id'";
            $is_exist       = $this->db->select($query);

            if($is_exist)
            {
                $message    = "Product Already Added!!";
                return $message;
            }
            else
            {
                $query           = "INSERT INTO carts(session_id, product_id, product_name, price, quantity, image) VALUES ('$session_id', '$product_id', '$product_name', '$price','$quantity', '$image')";
                $is_inserted     = $this->db->insert($query);

                if($is_inserted)
                {
                    header('Location: cart.php');
                }
                else
                {
                    header('Location: 404.php');
                }
            } 
        }

        public function get_cart_list()
        {
            $session_id     = session_id();
            $query          = "SELECT * FROM carts where session_id = '$session_id'";
            $cart_list      = $this->db->select($query);

            return $cart_list;
        }

        public function update($cart_id, $quantity)
        {

            $cart_id    = $this -> format -> validation($cart_id);
            $cart_id    = mysqli_real_escape_string($this -> db -> link, $cart_id);

            $quantity   = $this -> format -> validation($quantity);
            $quantity   = mysqli_real_escape_string($this -> db -> link, $quantity);

            $query      = "UPDATE carts SET quantity = '$quantity' where id = '$cart_id'";
            $is_updated = $this->db->update($query);

            if($is_updated)
            {
                header('Location: cart.php');
            }
            else
            {
                $message    = "Sorry !! Cart not update.";
                return $message;
            }
        }

        public function delete($cart_id)
        {
            $query          = "DELETE FROM carts WHERE id ='$cart_id'";
            $is_deleted     = $this->db->delete($query);

            if($is_deleted)
            {
                echo "<script> window.location='cart.php';</script>";
            }
            else
            {
                $message    = "Sorry !! Cart not Delete.";
                return $message;
            }
        }

        public function is_empty()
        {
            $session_id     = session_id();
            $query          = "SELECT * FROM carts WHERE session_id = '$session_id'";
            $result         = $this->db->select($query);
            
            return $result;
        }

        public function delete_cart_data()
        {
            $session_id     = session_id();
            $query          = "DELETE FROM carts WHERE session_id = '$session_id'";
            $this->db->delete($query);
        }
        
        public function order_insert($cId)
        {
            $session_id     = session_id();
            $query          = "SELECT * FROM carts WHERE session_id = '$session_id'";
            $getProd        = $this -> db -> select($query);
            
            if($getProd)
            {
                while($result = $getProd->fetch_assoc())
                {
                    $productId      = $result['product_id'];
                    $productName    = $result['product_name'];
                    $quantity       = $result['quantity'];
                    $price          = $result['price'] * $quantity;
                    $image          = $result['image'];

                    $qOrder         = "INSERT INTO orders(`user_id`, `product_id`, `product_name`, `quantity`, `price`, `image`) VALUES (
                        '$cId', '$productId', '$productName', '$quantity', '$price', '$image')";
                    $result         = $this->db->insert($qOrder);
                }
            }
        }

        public function payableAmount($id)
        {
            $query      = "SELECT price FROM orders WHERE user_id = '$id' AND date = now()";
            $result     = $this->db->select($query);

            return $result;
        }

        public function get_order_product($id)
        {
            $query      = "SELECT * FROM orders WHERE user_id = '$id' ORDER BY product_id DESC";
            $result     = $this->db->select($query);

            return $result;
        }

        public function isEmpty($id)
        {
            $query      = "SELECT * FROM orders  WHERE user_id = '$id'";
            $result     = $this->db->select($query);

            return $result;
        }

        public function get_order_products()
        {
            $query      = "SELECT * FROM orders  ORDER BY date";
            $result     = $this->db->select($query);

            return $result;
        }

        public function product_shifted($id, $price, $time)
        {
            $id         = $this -> format -> validation($id);
            $id         = mysqli_real_escape_string($this -> db -> link, $id);

            $price      = $this -> format -> validation($price);
            $price      = mysqli_real_escape_string($this -> db -> link, $price);

            $time       = $this -> format -> validation($time);
            $time       = mysqli_real_escape_string($this -> db -> link, $time);

            $query      = "UPDATE orders SET status = '1' WHERE user_id = '$id' AND date = '$time' AND price = '$price'";
            $result     = $this->db->update($query);

            if($result)
            {
                $message    = "Data update successfully.";
                return $message;
            }
            else
            {
                $message    = "Data not update successfully.";
                return $message;
            }

        }

        public function deleted_shifted_product($id, $price, $time)
        {
            $id         = $this -> format -> validation($id);
            $id         = mysqli_real_escape_string($this -> db -> link, $id);

            $price      = $this -> format -> validation($price);
            $price      = mysqli_real_escape_string($this -> db -> link, $price);

            $time       = $this -> format -> validation($time);
            $time       = mysqli_real_escape_string($this -> db -> link, $time);

            $query      = "DELETE FROM orders WHERE user_id = '$id' AND date = '$time' AND price = '$price'";
            $result     = $this->db->delete($query);

            if($result)
            {
                $message    = "Data deleted successfully.";
                return $message;
            }
            else
            {
                $message    = "Data not deleted.";
                return $message;
            }
        }

        public function product_confirm($id, $price, $time)
        {
            $id         = $this -> format -> validation($id);
            $id         = mysqli_real_escape_string($this -> db -> link, $id);

            $price      = $this -> format -> validation($price);
            $price      = mysqli_real_escape_string($this -> db -> link, $price);

            $time       = $this -> format -> validation($time);
            $time       = mysqli_real_escape_string($this -> db -> link, $time);

            $query      = "UPDATE orders SET status = '2' WHERE user_id = '$id' AND date = '$time' AND price = '$price'";
            $result     = $this->db->update($query);

            if($result)
            {
                $message    = "Data update successfully.";
                return $message;
            }
            else
            {
                $message    = "Data not update successfully.";
                return $message;
            }

        }
    }