<!doctype html>
<html lang="ru">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Тренировки</title>
    </head>
    <body>
        <div class="container">
            <h2>Добавление тренировки</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="nameTraining">Название тренировки</label>
                    <input type="text" name="nameTraining" class="form-control" placeholder="Введете название">
                </div>
                <div class="form-group">
                    <label for="nameTraining">Цена тренировки</label>
                    <input type="text" name="priceTraining" class="form-control" placeholder="Введете цену">
                </div>
                <input name="addTraining" type="submit" class="btn btn-primary" value="Добавить тренировку"/>
            </form>
            <?php
                if (isset($_POST['delTraining']))
                {
                    $id = key($_POST['delTraining']);
                    $link = mysqli_connect('127.0.0.1', 'root', '21232123', 'fit_db') or die('sql_err' . mysql_error);
                    $link->set_charset("utf8");
                    $link->query("DELETE FROM `training` WHERE `training`.`id` = ". $id ."");
                    mysqli_close($link);
                    header("Location: /fit/alltraining.php");
                    exit;
                }
                if (isset($_POST['addTraining']))
                {
                    $name = $_POST['nameTraining'];
                    $price = $_POST['priceTraining'];
                    $link = mysqli_connect('127.0.0.1', 'root', '21232123', 'fit_db') or die('sql_err' . mysql_error);
                    $link->set_charset("utf8");
                    $link->query("INSERT INTO `training` (`id`, `name`, `price`) VALUES (NULL, '". $name."', '". $price."')");
                    unset($name);
                    unset($price);
                    mysqli_close($link);
                    header("Location: /fit/alltraining.php");
                    exit;
                }
            ?>
            <hr>
            <h2>Тренировки</h2>
            <?php
                $link = mysqli_connect('127.0.0.1', 'root', '21232123', 'fit_db') or die('sql_err' . mysql_error);
                $link->set_charset("utf8");
                $result = $link->query("SELECT * FROM `training`");
                while ($row = $result->fetch_assoc()) { 
            ?>
            <form method="post">
                <div class="list-group">
                    <a href="/fit/training.php?id=<?=$row["id"]?>"><?= $row["name"];?></a>
                    <br>
                </div>
                <input name='delTraining[<?=$row["id"]?>]' type="submit" class="btn btn-primary" value="Удалить">
            </form> 
            <!--
            <form target="_blank" action="edittraining.php" method="post">
                <input name='editTraining[<?=$row["id"]?>]' type="submit" class="btn btn-primary" value="Редактировать">
            </form>
            -->
            <?php
                }
                mysqli_free_result($result);
                mysqli_close($link); 

            ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>