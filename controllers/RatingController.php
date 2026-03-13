<?php

require_once "config/db.php";

class RatingController {

    public function saveRating(){
        global $conn;

        $business_id=$_POST['business_id'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $rating=$_POST['rating'];

        /* Check existing rating */

        $check="SELECT id FROM ratings
        WHERE business_id='$business_id'
        AND (email='$email' OR phone='$phone')";

        $result=mysqli_query($conn,$check);

        if(mysqli_num_rows($result)>0){

        $row=mysqli_fetch_assoc($result);

        $id=$row['id'];

        mysqli_query($conn,
        "UPDATE ratings SET rating='$rating'
        WHERE id='$id'");

        }else{

        mysqli_query($conn,
        "INSERT INTO ratings
        (business_id,name,email,phone,rating,created_at)
        VALUES
        ('$business_id','$name','$email','$phone','$rating',NOW())");

        }

        /* Calculate average */

        $avgQuery="
        SELECT ROUND(AVG(rating),1) avg_rating
        FROM ratings
        WHERE business_id='$business_id'
        ";

        $res=mysqli_query($conn,$avgQuery);
        $avg=mysqli_fetch_assoc($res)['avg_rating'];

        echo json_encode([
        "business_id"=>$business_id,
        "avg_rating"=>$avg
        ]);

    }

}
?>