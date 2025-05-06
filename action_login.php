<?php 
    include ("includes/header.php");


    if (isset($_POST['username']) && !empty($_POST['username']) && 
        isset($_POST['password']) && !empty($_POST['password'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
    } else
        exit("برخی از فیلد ها مقدار دهی نشده است");

    $link = mysqli_connect("localhost", "root", "", "shop_db");

    if (mysqli_connect_errno())
        exit("خطایی با شرح زیر رخ داده است:".mysqli_connect_errno());

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_array($result);

    if ($row) {
        $_SESSION["state_login"] = true;
        $_SESSION["realname"] = $row['realname'];

        $_SESSION["username"] = $row['username'];
        

        if ($row["type"] == 0)
            $_SESSION["user_type"] = "public";

        elseif ($row["type"] == 1) {
            $_SESSION["user_type"] = "admin";
?>

<script>
    location.replace("admin_products.php");
</script>

<?php
        }

        echo ("<p style:'color: green;'><b>{$row['realname']}به فروشگاه خوش آمدید</b></p>");
    } else 
        echo ("<p style:'color: green;'><b>نام کاربری یا کلمه عبور یافت نشد</b></p>");

    mysqli_close($link);

    include ("includes/footer.php");
?>