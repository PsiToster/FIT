<!doctype html>
<html lang="ru">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Упражнения</title>
    </head>
    <body>
        <div class="container">
            <h2>Добавление упражнения</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="nameExercise">Название упражнения</label>
                    <input type="text" name="nameExercise" class="form-control" placeholder="Введете название">
                </div>
                <div class="form-group">
                    <label for="difficultyExercise">Сложность упражнения</label>
                    <select class="form-control" name="difficultyExercise">
                        <option value="1">Легкое</option>
                        <option value="2">Среднее</option>
                        <option value="3">Тяжелое</option>
                    </select>
                </div>
                <input name="addExercise" type="submit" class="btn btn-primary" value="Добавить упражнение"/>
            </form>
            <?php
                if (isset($_POST['delExercise']))
                {
                    $id = key($_POST['delExercise']);
                    $link = mysqli_connect('127.0.0.1', 'root', '21232123', 'fit_db') or die('sql_err' . mysql_error);
                    $link->set_charset("utf8");
                    $link->query("DELETE FROM `exercise` WHERE `exercise`.`id` = ". $id ."");
                    mysqli_close($link);
                    header("Location: /fit/exercise.php");
                    exit;
                }
                if (isset($_POST['addExercise']))
                {
                    $name = $_POST['nameExercise'];
                    $dif = $_POST['difficultyExercise'];
                    $link = mysqli_connect('127.0.0.1', 'root', '21232123', 'fit_db') or die('sql_err' . mysql_error);
                    $link->set_charset("utf8");
                    $link->query("INSERT INTO `exercise` (`id`, `name`, `difficulty`) VALUES (NULL, '". $name."', '". $dif."')");
                    unset($name);
                    unset($dif);
                    mysqli_close($link);
                    header("Location: /fit/exercise.php");
                    exit;
                }
            ?>
            <hr>
            <h2>Упражнения</h2>
            <?php
                $link = mysqli_connect('127.0.0.1', 'root', '21232123', 'fit_db') or die('sql_err' . mysql_error);
                $link->set_charset("utf8");
                $result = $link->query("SELECT * FROM `exercise`");
                while ($row = $result->fetch_assoc()) { 
            ?>
            <form method="post">
                <div class="list-group">
                    <p class="list-group-item">Название: <?= $row["name"];?></p>
                    <p class="list-group-item">Сложность: 
                    <?php
                        switch($row["difficulty"])
                        {
                            case 1:
                                echo "Легкое";
                                break;
                            case 2:
                                echo "Среднее";
                                break;
                            case 3:
                                echo "Тяжелое";
                                break;
                        }
                    ?></p>
                    <p class="list-group-item">Используется: 
                    <?php
                        if ($row["used"])
                            echo "Да";
                        else 
                            echo "Нет";
                    ?></p>
                    <br>
                </div>
                <input name='delExercise[<?=$row["id"]?>]' type="submit" class="btn btn-primary" value="Удалить">
            </form> 
            <form target="_blank" action="/fit/editexercise.php" method="post">
                <input name='editExercise[<?=$row["id"]?>]' type="submit" class="btn btn-primary" value="Редактировать">
            </form>
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