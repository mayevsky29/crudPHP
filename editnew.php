<?php
include "connection_database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $query = "UPDATE `news` SET `name` = :name, `description`=:description WHERE `id` = :id";
    $params = [
        ':id' => $id,
        ':name' => $name,
        ':description' => $description
    ];
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);
}
?>