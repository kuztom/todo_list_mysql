<?php require_once 'app/Views/Partials/header.template.php'; ?>

<?php
$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>

<body>
<br>
<h1 style="text-align: center;color:steelblue;font-size:40px;">To-Do List</h1>

<div class="container-sm">
    <div style="text-align: center">
        <a href="/">Back</a><br>
        <form method="post" action="/">

            <label for="date">Date : </label>
            <input type="date" value="<?php echo $today; ?>" id="date" name="date"><br><br>
            <label for="task">Task: </label>
            <input type="text" id="task" name="task"><br><br>

            <input type="submit" name="save" value="Save Task"><br><br>

        </form>
    </div>

</body>
</html>