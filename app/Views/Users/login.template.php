<?php require_once 'app/Views/app.twig'; ?>

<br>
<h1 style="text-align: center;color:steelblue;font-size:40px;">Your To-Do list</h1>

<h1 style="text-align: center;color:steelblue;font-size:25px;">Log in to your account</h1>

<div class="container-sm">
    <div style="text-align: center">
        <form method="post" action="/login">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="pwd">Password: </label>
            <input type="password" id="pwd" name="pwd" required><br><br>

            <input type="submit" name="login" value="Login"><br><br>
            <a href="/register">
                <button type="button">Don't have account?</button>
            </a>

        </form>
    </div>
</div>

</body>
</html>