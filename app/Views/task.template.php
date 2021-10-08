<?php require_once 'app/Views/Partials/header.template.php'; ?>

<body>
<br>
<h1 style="text-align: center;color:steelblue;font-size:40px;">Your Task</h1>


<div class="container-sm">
    <div style="text-align: center">
        <a href="/">Back</a><br>
        <h1 style="text-align: center;color:black;font-size:30px;"><?php echo $task->getTitle() ?><br>
            Planned to complete on <?php echo $task->getDate() ?>
        </h1>
        <small>(ID:<?php echo $task->getId() ?>)</small>
        <form method="post" action="/task/<?php echo $task->getId() ?>">
            <button type="submit" onclick="return confirm('This will erase task from list. Proceed?')">Complete task
            </button>
            <br><br>
        </form>
    </div>

</body>
</html>