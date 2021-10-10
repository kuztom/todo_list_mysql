<?php require_once 'app/Views/Partials/header.template.php'; ?>

<body>
<br>
<h1 style="text-align: center;color:steelblue;font-size:40px;">Account Info</h1>

<div class="container-sm">
    <div style="text-align: center">
        Username: <?php echo $_SESSION['username'] ?><br>
        E-mail: <?php echo $_SESSION['email'] ?><br><br>
        <a href="/">
            <button type="button">Your To-Do's</button>
        </a>
    </div>

</body>
</html>