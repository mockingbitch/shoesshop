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
        $query = "SELECT * FROM tbl_purchaseorder ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

}
?>