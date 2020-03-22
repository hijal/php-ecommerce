<?php

    $filePath = realpath(dirname(__FILE__));
    
    include_once ($filePath.'/../lib/Database.php');
    include_once ($filePath.'/../helpers/Format.php');
?>

<?php
    class Product
    {
        private $db;
        private $format;

        public function __construct()
        {
            $this->db       = new Database();
            $this->format   = new Format();
        }

        public function insert($data, $file)
        {
            $name           = $this -> format -> validation($data['name']);
            $name           = mysqli_real_escape_string($this -> db -> link, $data['name']);

            $category_id    = $this -> format -> validation($data['category_id']);
            $category_id    = mysqli_real_escape_string($this -> db -> link, $data['category_id']);

            $brand_id       = $this -> format -> validation($data['brand_id']);
            $brand_id       = mysqli_real_escape_string($this -> db -> link, $data['brand_id']);

            $body           = $this -> format -> validation($data['body']);
            $body           = mysqli_real_escape_string($this -> db -> link, $data['body']);
            $body           = strip_tags($body);


            $price          = $this -> format -> validation($data['price']);
            $price          = mysqli_real_escape_string($this -> db -> link, $data['price']);

            $type           = $this -> format -> validation($data['type']);
            $type           = mysqli_real_escape_string($this -> db -> link, $data['type']);

            $permited       = array('jpg', 'jpeg', 'png', 'gif');
            $file_name      = $file['image']['name'];
            $file_size      = $file['image']['size'];
            $file_temp      = $file['image']['tmp_name'];

            $div            = explode('.', $file_name);
            $file_ext       = strtolower(end($div));
            $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;


            if($name == "" or $category_id == "" or $brand_id == "" or $body == "" or $price == "" or $type == "")
            {
                $message    = "Field Must not be Empty!!!";
                return $message;
            }
            else
            {
                move_uploaded_file($file_temp, $uploaded_image);

                $query      = "INSERT INTO products(`name`, `category_id`, `brand_id`, `price`, `image`, `body`, `type`) VALUES (
                    '$name', '$category_id', '$brand_id', '$price', '$uploaded_image', '$body', '$type'
                )";
                $result     = $this->db->insert($query);

                if($result)
                {
                    $message    = "Product Insert successfully!!";
                    return $message;
                }
                else
                {
                    $message    = "Sorry !! Product not insert.";
                    return $message;
                }
            }
        }

        public function get_all_product()
        {
            $query      = "SELECT products.*, categories.name AS category_name, brands.name AS brand_name 
            FROM products
            INNER JOIN categories ON products.category_id = categories.id 
            INNER JOIN brands ON products.brand_id = brands.id";

            $list       = $this->db->select($query);

            return $list;
        }

        public function get_product_by_id($id)
        {
            $query      = "SELECT * FROM products where id = '$id'";
            $result     = $this->db->select($query);

            return $result;
        }

        public function update($data, $file, $id)
        {
            $name           = $this -> format -> validation($data['name']);
            $name           = mysqli_real_escape_string($this -> db -> link, $data['name']);

            $category_id    = $this -> format -> validation($data['category_id']);
            $category_id    = mysqli_real_escape_string($this -> db -> link, $data['category_id']);

            $brand_id       = $this -> format -> validation($data['brand_id']);
            $brand_id       = mysqli_real_escape_string($this -> db -> link, $data['brand_id']);

            $body           = $this -> format -> validation($data['body']);
            $body           = mysqli_real_escape_string($this -> db -> link, $data['body']);
            $body           = strip_tags($body);

            $price          = $this -> format -> validation($data['price']);
            $price          = mysqli_real_escape_string($this -> db -> link, $data['price']);

            $type           = $this -> format -> validation($data['type']);
            $type           = mysqli_real_escape_string($this -> db -> link, $data['type']);

            $permited       = array('jpg', 'jpeg', 'png', 'gif');
            $file_name      = $file['image']['name'];
            $file_size      = $file['image']['size'];
            $file_temp      = $file['image']['tmp_name'];

            $div            = explode('.', $file_name);
            $file_ext       = strtolower(end($div));
            $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;


            if($name == "" or $category_id == "" or $brand_id == "" or $body == "" or $price == "" or $type == "" or $file_name == "")
            {
                $message     = "Field Must not be Empty!!!";
                return $message;
            }
            else
            {
                move_uploaded_file($file_temp, $uploaded_image);
                $query      = "UPDATE productS SET name = '$name', category_id = '$category_id', brand_id = '$brand_id', price = '$price', image = '$uploaded_image', body = '$body', type = '$type' WHERE id = '$id'";
                $result     = $this -> db -> update($query);

                if($result)
                {
                    $message    = "Product update successfully!!";
                    return $message;
                }
                else
                {
                    $message    = "Sorry !! Product not update.";
                    return $message;
                }
            }
        }

        public function delete($id)
        {
            $query          = "DELETE FROM products where id = '$id'";
            $result         = $this -> db -> delete($query);

            if($result)
            {
                $message   = "Product Deleted Successfully.";
                return $message;
            }
            else
            {
                $message   = "Product Not Deleted.";
                return $message;
            }
        }
        
        public function get_featured_products()
        {
            $query     = "SELECT * FROM products where type = '0' limit 4";
            $result    = $this->db->select($query);
            return $result;
        }
        
        public function get_new_products()
        {
            $query      = "SELECT * FROM products where type = '1' limit 4";
            $result     = $this->db->select($query);

            return $result;
        }

        public function get_product_details($product_id)
        {
            $query      = "SELECT product.*, category.name, brand.name 
            FROM products as product, categories as category, brands as brand
            WHERE product.category_id = category.id AND product.brand_id = brand.id AND product.id = '$product_id'";
            $result     = $this->db->select($query);

            return $result;
        }

        public function latest_from_sony()
        {
            $query      = "SELECT * FROM products where brand_id = '7' limit 1";
            $brand_name = $this->db->select($query);

            return $brand_name;
        }

        public function latest_from_Whirlpool()
        {
            $query      = "SELECT * FROM products where brand_id = '4' limit 1";
            $brand_name = $this->db->select($query);

            return $brand_name;
        }

        public function latest_from_Samsung()
        {
            $query      = "SELECT * FROM products where brand_id = '6' limit 1";
            $brand_name = $this->db->select($query);

            return $brand_name;
        }

        public function latest_from_Vaxcel()
        {
            $query      = "SELECT * FROM products where brand_id = '8' limit 1";
            $brand_name = $this->db->select($query);

            return $brand_name;
        }

        public function get_product_by_category($id)
        {
            $id     = $this -> format -> validation($id);
            $id     = mysqli_real_escape_string($this -> db -> link, $id);

            $query  = "SELECT * FROM products WHERE category_id = '$id'";
            $result = $this -> db -> select($query);

            return $result;
        }

    }
