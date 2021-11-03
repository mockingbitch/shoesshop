<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
class cartcheckout
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }
    public function addcart($data,$cart){
        //sinh token để lưu cart
        $token = rand(0,999999);
        $subtotal = 0;
        foreach ($cart as $key) {
            $productName = $key['name'];
            $productPrice = $key['price'];
            $productQty = $key['qty'];
            $img = $key['img'];
            $subtotal += $productPrice*$productQty;
            $query2 = "INSERT INTO tbl_orderdetail(productName,productQuantity,productPrice,img,total,code)
                    VALUES ('$productName','$productQty','$productPrice','$img','$subtotal','$token')";
            $result2 = $this->db->insert($query2);
        }
        if ($result2){
            $username = $this->fm->validation($data['customername']);
            $email = $this->fm->validation($data['email']);
            $city = $this->fm->validation($data['city']);
            $addressdetail = $this->fm->validation($data['addressdetail']);
            $sdt = $this->fm->validation($data['sdt']);
            $note = $this->fm->validation($data['note']);
            $username = mysqli_real_escape_string($this->db->link,$username);
            $email = mysqli_real_escape_string($this->db->link,$email);
            $city = mysqli_real_escape_string($this->db->link,$city);
            $sdt = mysqli_real_escape_string($this->db->link,$sdt);
            $note = mysqli_real_escape_string($this->db->link,$note);
            $addressdetail = mysqli_real_escape_string($this->db->link,$addressdetail);
            $status = 0;

            if (empty($username)||empty($email)||empty($city)||empty($sdt)||empty($addressdetail)){
                $alert = 'Không được để trống thông tin';
                return $alert;
            }
            else{
                $query = "INSERT INTO tbl_order(customerName,email,city,address,sdt,note,status,subtotal,code) 
                    VALUES ('$username','$email','$city','$addressdetail','$sdt','$note','$status','$subtotal','$token')";
                $result = $this->db->insert($query);
                if ($result){
                    header('/');
                }
            }
        }
        unset($_SESSION['cart']);
        header('location:thankyou.php');
    }
}