<?php
    include "db.php";
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $delete = $conn -> prepare("delete from blogs where id = ?");
        $delete -> bind_param("i", $id);
        if($delete -> execute()){
            header("Location:dashboard.php");
        }
    }
?>