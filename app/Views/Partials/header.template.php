<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
          crossorigin="anonymous">
    <title>To-Do List</title>
</head>
<body>
<br />
<div style="text-align: center">
<?php if (isset($_SESSION['userId'])): ?>
<form method="post" action="/logout">
    <input type="submit" name="logout" value="Logout"><br><br>
</form>
<?php endif; ?>
</div>
