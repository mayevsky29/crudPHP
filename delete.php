<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connection_database.php";
    $id = $_POST['id'];
    $sql = "SELECT `image` FROM `news` WHERE `Id` =" . $id; // створення запиту по id
    $data = $dbh->query($sql); // посилає запит у бд
    $fileImage = $data->fetchAll()[0]["image"]; // повертає масив з даними
    $path = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $fileImage;

            // видалення файла з папки(картинки), разом з новиною
        if (unlink($path)) {
            $sql = "DELETE FROM `news` WHERE `Id` =" . $id;
            $dbh->query($sql);
        }
}
?>