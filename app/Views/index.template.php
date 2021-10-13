<?php require_once 'app/Views/Partials/header.template.php'; ?>

<br>
<h1 style="text-align: center;color:steelblue;font-size:40px;">
    <?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?>
    To-Do List</h1>

<div class="container-sm">
    <div style="text-align: center">
        <form method="post" action="/login">
            <a href="/newTask">
                <button type="button">New Task</button>
            </a>

        </form>

    </div>
    <div class="container-sm" style="display: flex; justify-content: center">
        <table class="table table-bordered table-hover table-sm"
               style="width: 600px; align-self: center">
            <tbody>
            <?php foreach ($tasks->getTasks() as $task): ?>
                <tr>
                    <td width="100px"><?php echo $task->getDate() ?></td>
                    <td><a href="/task/<?php echo $task->getId() ?>">
                            <?php echo $task->getTitle() ?></a></td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
</body>
</html>