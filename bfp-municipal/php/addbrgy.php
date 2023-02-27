<?php
    include_once "../../php/config.php";
    if(isset($_POST['add_brgy'])){
        $municipal = $link->real_escape_string($_POST['municipal']);
        $barangay = $link->real_escape_string($_POST['barangay']);
        $query = "INSERT INTO `brgy`(municipal,barangay) VALUES ('$municipal','$barangay')";

        if($link->query($query)){
            $res = [
                'status' => 200,
                'message' => 'Successfully Added Barangay'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Something Went Wrong'
            ];
            echo json_encode($res);
            return;
        }
    } elseif(isset($_POST['drop_request'])){
        $requestid = $link->real_escape_string($_POST['request_id']);
        $queary = "DELETE FROM brgy WHERE id = '".$requestid."'";
        if($link->query($queary)){
            $res = [
                'status' => 200,
                'message' => 'Successfully Delete Barangay'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Something Went Wrong'
            ];
            echo json_encode($res);
            return;
        }
    }

?>