<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class brand
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_brand($brandName, $brandDescription)
    {
        $brandName = $this->fm->validation($brandName);
        $brandDescription = $this->fm->validation($brandDescription);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $brandDescription = mysqli_real_escape_string($this->db->link, $brandDescription);
        if (empty($brandName)) {
            $alert = "* Tên hãng không được để trống!!!";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_brand(brandName,brandDescription) 
            VALUES ('$brandName','$brandDescription')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green;'>Thêm " . $brandName . " thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red;'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function show_brand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandid DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getbrandbyId($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandid ='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_brand($brandName, $brandDescription, $id)
    {
        $brandName = $this->fm->validation($brandName);
        $brandDescription = $this->fm->validation($brandDescription);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $brandDescription = mysqli_real_escape_string($this->db->link, $brandDescription);


        if (empty($brandName)) {
            $alert = "*Tên hãng không được bỏ trống";
            return $alert;
        } else {
            $query = "UPDATE tbl_brand SET brandName = '$brandName', brandDescription = '$brandDescription' WHERE brandId = '$id'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green;'>Sửa " . $brandName . " thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red;'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function delete_brand($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brandId ='$id'";
        $result = $this->db->delete($query);
        
        if ($result) {
            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Xoá thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
            return $alert;
        }
    }
}

?>