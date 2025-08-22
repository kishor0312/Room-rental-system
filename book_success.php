<?php
    session_start();
    include "config.php";

    if(!isset($_GET["id"])) {
        header("Location: index.php");
        exit;
    }
    $query = "select * from interaction_log where id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row["weight"] < 0.9) {
            $query = "update interaction_log set weight=0.9 where id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $_GET["id"]);
            $stmt->execute();
        }  
    }else {
        $query = "insert into interaction_log(prop_id,weight,uid) values(?,0.9,?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $_GET["id"],$_SESSION["id"]);
        $stmt->execute();
    }

    header("Location: index.php");

?>