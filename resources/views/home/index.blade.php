@extends('layouts.app-master')
@section('content')
    <!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Таблица</title>
    <style type="text/css">
        table{
            width: 500px;
            margin: 10px auto;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            border-collapse: collapse;
        }
        th, td
        {
            border: 1px solid black;
            padding: 10px;
        }
        form {
            margin-bottom: 10px;
        }
        form{
            margin: 30px auto;
        }
    </style>
</head>
<body>
<form method="GET">
    <input type="text" name="search" placeholder="Поиск">
    <select name="sort">
        <option value="asc">По возрастанию</option>
        <option value="desc">По убыванию</option>
    </select>
    <button type="submit">Применить</button>
    <button type="button" onclick="window.location.href='{{ url()->current() }}'">Отмена</button>
</form>

<table>
    <tr>
        <td>id</td>
        <td>Имя</td>
        <td>Фамилия</td>
        <td>Email</td>
        <td>Пол</td>
        <td>IP</td>
        <td>Дата</td>
        <td>Машина</td>
        <td>Идентификационный номер</td>
        <td>Год машины</td>
    </tr>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "praktikastrekpest");
    if ($mysqli->connect_errno){
        echo "Извините возникла проблема на сайте!";
        exit;
    }
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
    $query = "SELECT * FROM dannie";
    if (!empty($search)) {
        $query .= " WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%' OR gender LIKE '%$search%' OR ip_address LIKE '%$search%' OR date LIKE '%$search%' OR car LIKE '%$search%' OR car_vin LIKE '%$search%' OR car_year LIKE '%$search%'";
    }
    $query .= " ORDER BY date $sort";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['ip_address'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['car'] . "</td>";
        echo "<td>" . $row['car_vin'] . "</td>";
        echo "<td>" . $row['car_year'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
@endsection
