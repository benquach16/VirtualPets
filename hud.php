<!doctype html>
<html>
    <head>
        <title>INSIDE</title>
    </head>
    <body>

      <?php include('./library/nav-bar.html'); ?>

        <script>
            
        </script>

        <p>you logged in, yeah! <?php session_start(); echo $_SESSION['curr_user']; ?></p>
    </body>
</html>