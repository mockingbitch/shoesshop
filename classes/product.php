<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>
<?php
class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_product($productName,$productDescription,$productPrice,$productQuantity,$brand,$files)
    {
        $productName = $this->fm->validation($productName);
        $productDescription  = $this->fm->validation($productDescription);
        $productPrice       = $this->fm->validation($productPrice);
        $productQuantity    = $this->fm->validation($productQuantity);
        $brand     = $this->fm->validation($brand);
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $brand     = mysqli_real_escape_string($this->db->link, $brand);
        $productDescription         = mysqli_real_escape_string($this->db->link, $productDescription);
        $productPrice       = mysqli_real_escape_string($this->db->link, $productPrice);
        $productQuantity    = mysqli_real_escape_string($this->db->link, $productQuantity);
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['img']['name'];
        $file_size = $_FILES['img']['size'];
        $file_temp = $_FILES['img']['tmp_name'];
        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "../admin/uploads/products/".$unique_image;
        if (empty($productName)||empty($productQuantity)||empty($productPrice)||empty($productDescription)||empty($brand)) {
            $alert = "*Vui lòng nhập đủ thông tin sản phẩm!!!";
            return $alert;
        } else {
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName,brand,productDescription,productQuantity,productPrice,img) 
            VALUES ('$productName','$brand','$productDescription','$productQuantity','$productPrice','$unique_image')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Thêm " . $productName . " thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function show_product()
    {
        //  $query = "SELECT * FROM tbl_product.*,tbl_category.cateName,tbl_brand.brandName FROM tbl_product 
        //  INNER JOIN tbl_category ON tbl_product.cateid=tbl_category.cateid
        //  INNER JOIN tbl_brand ON tbl_product.brandid = tbl_brand.brandid 
        //  ORDER BY tbl_product.productid desc";
        $query = "SELECT * FROM tbl_product order by productid desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId ='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_product($id,$productName,$productDescription,$productPrice,$productQuantity,$brand,$files)
    {
        $productName = $this->fm->validation($productName);
        $productDescription  = $this->fm->validation($productDescription);
        $productPrice       = $this->fm->validation($productPrice);
        $productQuantity    = $this->fm->validation($productQuantity);
        $brand     = $this->fm->validation($brand);
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $brand     = mysqli_real_escape_string($this->db->link, $brand);
        $productDescription         = mysqli_real_escape_string($this->db->link, $productDescription);
        $productPrice       = mysqli_real_escape_string($this->db->link, $productPrice);
        $productQuantity    = mysqli_real_escape_string($this->db->link, $productQuantity);
        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['img']['name'];
        $file_size = $_FILES['img']['size'];
        $file_temp = $_FILES['img']['tmp_name'];
        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "../admin/uploads/products".$unique_image;

        if (empty($productName)||empty($productQuantity)||empty($productPrice)||empty($productDescription)||empty($brand)) {
            $alert = "*Vui lòng nhập đủ thông tin sản phẩm!!!";
            return $alert;
        }
         else {
            if(!empty($file_name)) {
                if($file_size>20480000){
                    $alert = "<span class='error'>Image size shoult be less than 2MB!</span>";
                    return $alert; 
                }
                elseif(in_array($file_ext,$permited)==false){
                    $alert = "<span class='error'>You can upload only:".implode(',',$permited)." </span>";
                    return $alert;
                }
                else{
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query = "UPDATE tbl_product SET 
                productName = '$productName',
                brand = '$brand',
                productPrice = '$productPrice',
                img = '$unique_image',
                productQuantity = '$productQuantity',
                productDescription = '$productDescription'
                WHERE productId ='$id'";"
                ";
                }
                
            }
            else{
                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                brand = '$brand',
                productPrice = '$productPrice',
                productQuantity = '$productQuantity',
                productDescription = '$productDescription'
                WHERE productid ='$id'";"
                ";
            }
        }
        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span class='success' style = 'color:green; '>Sửa " . $productName . " thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; '>Thất bại</span>";
            return $alert;
        }
    }
    public function delete_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productid ='$id'";
        $result = $this->db->delete($query);
        
        if ($result) {
            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Xoá thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
            return $alert;
        }
    }
    // FRONT END
    public function show_featured_product(){
        $query = "SELECT * FROM tbl_product  ORDER BY productid DESC LIMIT 6";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details($id){
        $query = "SELECT p.*,c.cateName,b.brandName FROM tbl_product as p, tbl_category as c, tbl_brand as b 
        WHERE p.cateid = c.cateid AND p.brandid = b.brandid AND p.productid = '$id' ORDER BY p.productid desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_new_product()
    {
        $query = "SELECT * FROM tbl_product order by productid desc LIMIT 10";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_topselling()
    {
        $query = "SELECT * FROM tbl_product WHERE productQuantity <= 100 LIMIT 10";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_product_by_category($cateslug){
        $query1 = "SELECT * FROM tbl_category WHERE categorySlug = '$cateslug'";
        $result1 = $this->db->select($query1);
        if ($result1){
            $cateid = $result1->fetch_assoc();
            $a = $cateid['cateid'];
            $query2 = "SELECT * FROM tbl_product WHERE cateid = '$a'";
            $result2 = $this->db->select($query2);
            return $result2;
        }
    }
    public function show_single_product($productslug){
        $query = "SELECT * FROM tbl_product WHERE productSlug = '$productslug'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_related_product(){
        $query = "SELECT * FROM tbl_product  ORDER BY productid DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_product_by_brand($id){
        $query = "SELECT * FROM tbl_product WHERE brand = '$id' ORDER BY productId DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function search_product($textsearch){
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$textsearch%' ORDER BY productId DESC";
        $result = $this->db->select($query);
        return $result;
    }
}

?>