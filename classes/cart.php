<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
include_once ($filepath.'/../lib/session.php');
?>
<?php
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($data){
        if (!isset($_SESSION['cart'])) $_SESSION['cart']=[];
        $id = $data['productid'];
        $query = "SELECT * FROM tbl_product WHERE productid ='$id'";
        $value = $this->db->select($query);
        if ($value){
            $result = $value->fetch_assoc();
            if (isset($_SESSION['cart'])){
                if(isset($_SESSION['cart'][$id])){
                    $_SESSION['cart'][$id]['id'] = $result['productid'];
                    $_SESSION['cart'][$id]['qty'] += 1;
                    $_SESSION['cart'][$id]['name'] = $result['productName'];
                    $_SESSION['cart'][$id]['price'] = $result['productPrice'];
                    $_SESSION['cart'][$id]['img'] = $result['img'];
                }
                else{
                    $_SESSION['cart'][$id]['qty']=1;
                    $_SESSION['cart'][$id]['name'] = $result['productName'];
                    $_SESSION['cart'][$id]['price'] = $result['productPrice'];
                    $_SESSION['cart'][$id]['img'] = $result['img'];
                }
                $_SESSION['success']='Thêm thành công';

            }
            else{
                $_SESSION['cart'][$id]['qty']=1;
                $_SESSION['cart'][$id]['name'] = $result['productName'];
                $_SESSION['cart'][$id]['price'] = $result['productPrice'];
                $_SESSION['cart'][$id]['img'] = $result['img'];
                $_SESSION['success']='Thêm thành công';
            }
//            $value = $result->fetch_assoc();
//            $img = $value['img'];
//            $productname = $value['productName'];
//            $price = $value['productPrice'];
//            $quantity = 1;
//            $cart =  [$productname,$price,$img,$quantity];
//            $_SESSION['cart'][]=$cart;
            var_dump($_SESSION['cart']);

        }else{
            $_SESSION['error']='Không tồn tại sản phẩm';
        }

    }
    public function show_order(){
        $query = "SELECT * FROM tbl_order ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_order($id)
    {
        $query = "DELETE FROM tbl_order WHERE cartid ='$id'";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Xoá thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
            return $alert;
        }
    }
    public function show_order_detail($id){
        $query = "SELECT a.* FROM tbl_order as a, tbl_orderdetail as b 
                    WHERE a.cartid = '$id' AND a.cartcode = b.cartcode LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_order_item($id){
        $query = "SELECT b.* FROM tbl_order as a, tbl_orderdetail as b 
                    WHERE a.cartid = '$id' AND a.cartcode = b.cartcode";
        $result = $this->db->select($query);
        return $result;
    }
    public function getOrderById($id){
        $query = "SELECT * FROM tbl_order WHERE id = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function set_status($id){
        $query = "UPDATE tbl_order SET status = '1' WHERE id = '$id'";
        $result = $this->db->update($query);
        if ($result){
            $alert = 'Đã cập nhật trạng thái đơn hàng';
            return $alert;
        }
    }
    public function getProductOrder($id){
        $query = "SELECT p.* FROM tbl_order as o, tbl_orderdetail as p
                   WHERE o.id = '$id' AND p.code = o.code LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}
?>