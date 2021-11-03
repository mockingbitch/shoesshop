<?php
$filepath = realpath(dirname(__FILE__));
require_once 'lib/session.php';
Session::checkLogin();
require_once 'lib/database.php';
require_once 'helpers/format.php';
?>
<?php
class customer
{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_user($email, $password){  //function xử lý đăng nhập
        $email = $this->fm->validation($email);
        $password = $this->fm->validation($password);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if(empty($email)||empty($password)){
            $alert = "ID or password must be not empty";
            return $alert;
        }
        else{
            $query = "SELECT * FROM tbl_customer WHERE customerEmail = '$email' AND password = '$password' LIMIT 1";
            $result = $this->db->select($query);

            if($result!=false){
                $value = $result->fetch_assoc();
                Session::set('customerlogin',true);
                Session::set('cusid',$value['customerId']);
                Session::set('customeremail',$value['customerEmail']);
                Session::set('customername',$value['customerName']);
                header('Location:index.php');
                $alert = "Success";
                return $alert;
            }
            else{
                $alert = "Wrong user or password";
                return $alert;
            }
        }
    }


}

?>