<?php
require_once __DIR__.'/../config/db.php';

class BusinessController {

    public function getBusinesses() {

        global $conn;

        $query = "SELECT 
        b.*,
        IFNULL(AVG(r.rating),0) AS avg_rating
        FROM businesses b
        LEFT JOIN ratings r 
        ON b.id = r.business_id
        GROUP BY b.id";

        $result = mysqli_query($conn,$query);

        $data = [];

        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }

    public function addEditBusiness(){

        global $conn;
    
        $id = $_POST['id'] ?? '';
    
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
    
        if(!empty($id)){
    
            $query = "UPDATE businesses 
                      SET name='$name',
                          address='$address',
                          phone='$phone',
                          email='$email'
                      WHERE id='$id'";
    
            mysqli_query($conn,$query);
    
            echo json_encode(["status"=>"updated"]);
    
        } else {
    
            $query = "INSERT INTO businesses(name,address,phone,email)
                      VALUES('$name','$address','$phone','$email')";
    
            mysqli_query($conn,$query);
    
            echo json_encode(["status"=>"inserted"]);
        }
    }

    public function deleteBusiness(){

        global $conn;

        $id = $_POST['id'];

        $query = "DELETE FROM businesses WHERE id=$id";

        mysqli_query($conn,$query);

        echo json_encode(["status"=>"deleted"]);
    }

}