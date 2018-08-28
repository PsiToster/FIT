
<!doctype html>
<html lang="ru">
    <head>
        <title>Tit</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    </head>
    <body>
        <?php
            if (isset($_GET["id"]))
            {
                $id = $_GET["id"];
                $link = mysqli_connect('127.0.0.1', 'root', '21232123', 'fit_db') or die('sql_err' . mysql_error);
                $link->set_charset("utf8");
                $result = $link->query("SELECT * FROM `training` WHERE `training`.`id` = ". $id ."");
                $row = $result->fetch_assoc();
                ?>
                <div class="container">
                    <form method="POST">
                        <div class="form-group">
                            <label for="nameTraining">Название тренировки</label>
                            <input type="text" name="nameTraining" class="form-control" placeholder="Введете название" value="<?=$row["name"]?>">
                        </div>
                        <div class="form-group">
                            <label for="priceTraining">Цена тренировки</label>
                            <input type="text" name="priceTraining" class="form-control" placeholder="Введете цену" value="<?=$row["price"]?>">
                        </div>
                        <input name='edTraining["<?=$row["id"]?>"]' type="submit" class="btn btn-primary" value="Изменить тренировку"/>
                    </form>
                </div>
                <?php
            }
            if (isset($_POST['edTraining']))
            {
                $id = key($_POST['edTraining']);
                $name = $_POST['nameTraining'];
                $price = $_POST['priceTraining'];
                $link = mysqli_connect('127.0.0.1', 'root', '21232123', 'fit_db') or die('sql_err' . mysql_error);
                $link->set_charset("utf8");
                $link->query("UPDATE `training` SET `name` = '". $name ."', `price` = '". $price ."' WHERE `training`.`id` = ". $id ." ");
                unset($name);
                unset($price);
                unset($id);
                mysqli_close($link);
                ?>
                <div class="container">
                    <h2>Изменено</h2>
                </div>
                <?php
            }
        ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>