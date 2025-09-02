<?php
    include "db.php";
    if (! isset($_SESSION["id"])) {
        header("Location:login.php");
    }

    if (isset($_POST["like_id"])) {
        $blog_id = (int)$_POST["like_id"];
        $user_id = $_SESSION["id"];

        // Check if user already liked this blog
        $check = $conn->query("SELECT * FROM likes WHERE blog_id=$blog_id AND user_id=$user_id");
        if ($check->num_rows == 0) {
            $conn->query("INSERT INTO likes (blog_id, user_id) VALUES ($blog_id, $user_id)");
        } else {
            // If already liked, unlike (toggle)
            $conn->query("DELETE FROM likes WHERE blog_id=$blog_id AND user_id=$user_id");
        }
    }

    $sql = $conn -> query("
        SELECT blogs.*, username, 
               (SELECT COUNT(*) FROM likes WHERE likes.blog_id = blogs.id) as like_count
        FROM blogs 
        JOIN user ON blogs.user_id = user.id
        ORDER BY like_count DESC, blogs.created_at DESC
    ");
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
    </head>

    <body>
        <header></header>
        <main>
            <h3 class="text-center my-4">DashBoard</h3>
            <div class="container text-center mt-4">
                <h4 class="my-4">Hello <?php echo $_SESSION["username"]; ?> !!</h4>
                <a class="btn btn-success" href="addblog.php">Add Blog</a>
                <a class="btn btn-danger" id="logoutBtn" href="logout.php">Logout</a>
            </div>
        
            <div class="container my-5">
                <div class="row">
                    <?php while ($row = $sql->fetch_assoc()) { ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card text-center h-100">
                                <img style="height: 400px; object-fit: cover;" class="card-img-top" src="uploads/<?= $row["image_name"] ?>" alt="Title" />
                                <div class="card-body">
                                    <small class="text-muted d-block mb-2">
                                        By: <?= $row["username"] ?> | <?= $row["created_at"] ?>
                                    </small>
                                    <h4 class="card-title"><?= $row["title"] ?></h4>
                                    <p class="card-text"><?= $row["content"] ?></p>
                                </div>

                                <!-- Heart Like Button -->
                                <form method="POST" class="mb-3 text-center">
                                    <input type="hidden" name="like_id" value="<?= $row["id"] ?>">
                                    
                                    <button type="submit" class="btn btn-link p-0 border-0" style="font-size: 2rem; text-decoration: none;">
                                        <?php if ($row["like_count"] > 0) : ?>
                                            ❤️
                                        <?php else : ?>
                                            🤍
                                        <?php endif; ?>
                                    </button>

                                    <div style="font-size: 1rem; margin-top: 5px;">
                                        <small>Likes:</small>
                                        <?= $row["like_count"] ?>
                                    </div>
                                </form>

                                <?php if ($_SESSION["id"] == $row["user_id"]) { ?>
                                    <div class="d-flex justify-content-center gap-2 mb-3">
                                        <a class="btn btn-warning" href="editblog.php?id=<?= $row["id"] ?>">Edit</a>
                                        <a class="btn btn-danger deleteBtn" href="deleteblog.php?id=<?= $row["id"] ?>">Delete</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>

        <footer></footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Confirm logout
            document.getElementById("logoutBtn").addEventListener("click", function(e){
                if(!confirm("Are you sure you want to logout?")) {
                    e.preventDefault();
                }
            });

            // Confirm delete blog
            document.querySelectorAll(".deleteBtn").forEach(btn => {
                btn.addEventListener("click", function(e){
                    if(!confirm("Are you sure you want to delete this blog?")) {
                        e.preventDefault();
                    }
                });
            });
        </script>
    </body>
</html>
