<?php require_once 'app/Views/app.twig'; ?>

<br>
<h1 style="text-align: center;color:steelblue;font-size:40px;">Fill the form to register</h1>

<div class="container-sm">
    <div style="text-align: center">
        <form method="post" action="/register">

            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="email">E-mail: </label>
            <input type="email" id="email" name="email" placeholder="email@email.com" required><br><br>
            <label for="pwd1">Password: </label>
            <input type="password" id="pwd1" name="pwd1" minlength="4" required><br><br>
            <label for="pwd2">Reenter password: </label>
            <input type="password" id="pwd2" name="pwd2" required><br><br>

            <input type="submit" name="create" value="Create account"><br><br>
            <a href="/login">
                <button type="button">Already have account?</button>
            </a>

        </form>
    </div>
</div>
</body>
</html>