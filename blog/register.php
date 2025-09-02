<?php
include "db.php";
    if ($_SERVER["REQUEST_METHOD"]==="POST") {
        $email = $_POST["email"];
        $uname = $_POST["username"];
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sql = $conn -> prepare("insert into user (email, username, password) values (?,?,?)");
        $sql -> bind_param("sss", $email, $uname, $pass);
        if ($sql -> execute()) {
            header("Location:login.php");
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            .container{
                margin-top: 100px;
                padding: 20px;
                box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.463);
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>

<div
    class="container col-3 py-5"
>
<h2 class="text-center my-4">Registration Page</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                name="email"
                id=""
                aria-describedby="emailHelpId"
                placeholder=""
            />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Username</label>
            <input
                type="text"
                class="form-control"
                name="username"
                id=""
                aria-describedby="helpId"
                placeholder=""
            />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                name="password"
                id=""
                placeholder=""
            />
        </div>
        <button
            type="submit"
            class="btn btn-success"
        >
            Register
        </button>
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="login.php"
            role="button"
            >Login</a
        >
    </form>
</div>


        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
