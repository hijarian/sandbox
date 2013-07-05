<?php
/**
 * Форма поиска по заданной таблице в MySQL базе данных.
 * Используйте этот скрипт как веб-страницу.
 * 
 * Ожидается таблица следующего вида:
 * 
 * create table `<TABLENAME>` (
 *   id int primary key auto_increment,
 *   name varchar(255), index (name),
 *   value varchar(255)
 * ) DEFAULT CHARSET utf8 ENGINE=InnoDB;
 *
 * Форма поиска ищет записи в таблице, 
 * имеющие частичные совпадения по полю `name`.
 */
define('MYSQL_HOSTNAME', 'localhost');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', 'mysqlroot');
define('MYSQL_DB', 'my');
define('MYSQL_TABLE', 'hash');


$connection = mysqli_connect(
    MYSQL_HOSTNAME,
    MYSQL_USERNAME,
    MYSQL_PASSWORD,
    MYSQL_DB
);

if (mysqli_connect_errno($connection)) 
{
    die(
        sprintf(
            'Не могу соединиться! (%s) %s' 
            mysqli_connect_errno($connection),
            mysqli_connect_error()
        )
    );
}


// 
$query_sql = 'select * from '.MYSQL_TABLE;
if (isset($_POST['name'] && $_POST['name']))
{
    
    $query = mysqli_prepare($query_sql.' where name like %?%');
    mysqli_stmt_bind_param($query, 's', $_POST['name']);
    $result = mysqli_stmt_execute($query);
}
else
{
    $result = mysqli_query($query_sql);
}
//
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Поиск в базе данных MySQL</title>
  </head>
  <body>
    <form method="post" action=".">
      <label for="name-input">Часть названия элемента:</label>
      <input id="name-input" name="name" type="text" value="" />
      <input type="submit" value="Вывести на экран" />
    </form>
    <table>
      <thead>
        <tr>
          <th>№</th>
          <th>Название</th>
          <th>Значение</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row_data = mysqli_fetch_assoc($result)):?>
        <tr>
          <td><?= $row_data['id'];?></td>
          <td><?= $row_data['name'];?></td>
          <td><?= $row_data['value'];?></td>
        </tr>
      <?php endwhile;?>
      </tbody>
    </table>
  </body>
</html>
