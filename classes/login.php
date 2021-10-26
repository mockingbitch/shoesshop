<?php
$filepath = realpath(dirname(__FILE__));
require_once '../lib/session.php';
Session::checkLogin();
require_once '../lib/database.php';
require_once '../helpers/format.php';
?>
<?php
class login
{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login($email, $password){  //function xử lý đăng nhập
        $email = $this->fm->validation($email);
        $password = $this->fm->validation($password);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if(empty($email)||empty($password)){
            $alert = "ID or password must be not empty";
            return $alert;
        }
        else{
            $query = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' LIMIT 1";
            $result = $this->db->select($query);

            if($result!=false){
                $value = $result->fetch_assoc();
                Session::set('login',true);
                Session::set('userid',$value['userid']);
                Session::set('email',$value['email']);
                Session::set('name',$value['name']);
                Session::set('role',$value['role']);
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