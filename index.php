<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Новини</title>
</head>
<body>
<?php include "navbar.php"; ?>

<div class="container">
    <h1>Новини</h1>

    <a href="/create.php" class="btn btn-success">Додоати новину</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Назва</th>
            <th scope="col">Опис</th>
            <th scope="col">Фото</th>
            <th scope="col">Дії з файлом</th>
        </tr>
        </thead>
        <tbody>
        <?php
            include "connection_database.php";
            $reader = $dbh->query("SELECT * FROM news");
            foreach ($reader as $row) {
                echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>
                        <img src='/images/{$row['image']}' alt='No image' width='100' />
                    </td>
                    <td>
                        <a href='edit.php?id=${row["id"]}' class='btn btn-info btnEdit' data-id='{$row['id']}'>Редагувати</a>
                        <a href='#' class='btn btn-danger btnDelete' data-id='{$row['id']}'>Видалити</a>
                    </td>
                </tr>
                ";
            }
        ?>

        </tbody>
    </table>

</div>
<?php include "modal_delete.php"; ?>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>

<script>
    var myModal = new bootstrap.Modal(document.getElementById("myModal"), {});
    window.addEventListener('load', function () {
        const list = document.querySelectorAll(".btnDelete");
        let removeId=0; //id element delete
        for (let i = 0; i < list.length; i++) {
            list[i].addEventListener("click", function (e) {
                e.preventDefault();
                removeId = e.currentTarget.dataset.id;
                myModal.show();
            });
        }
        //Нажали кнопку видалити
        document.querySelector("#btnDeleteNews").addEventListener("click", function() {
            const formData = new FormData();
            formData.append("id", removeId);
            axios.post("/delete.php", formData)
                .then(resp => {
                    location.reload();
                });
        });
    });
</script>
</body>
</html>