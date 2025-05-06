<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه ایرانیان</title>
    <link rel="stylesheet" href="styles.css">
    
    <style>
        .set_style_link {
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="divTable">
        <div class="divTableRow">
            <div class="divTableCell">
                <header class="divTable">
                    <div class="divTableRow">
                        <div class="divTableCell">لوگوی سایت</div>
                    </div>
                </header>
                <nav class="divTable">
                    <ul class="divTableRow">
                        <li class="divTableCell"><a class="set_style_link" href="index.php">صفحه اصلی</a></li>
                        <li class="divTableCell"><a class="set_style_link" href="register.php">عضویت در سایت</a></li>
                        <?php 
                            if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)
                            {
                        ?>
                        <li class="divTableCell"><a class="set_style_link" href="logout.php">خروج از سایت
                        <?php echo (" ({$_SESSION["realname"]}) ") ?></a></li>
                        <?php 
                            }
                            else
                            {
                        ?>
                        <li class="divTableCell"><a class="set_style_link" href="login.php">ورود به سایت</a></li>
                        <?php 
                            }
                        ?>
                        <li class="divTableCell"><a class="set_style_link" href="#">درباره ما</a></li>
                        <li class="divTableCell"><a class="set_style_link" href="#">ارتباط با ما</a></li>
                        
                        <?php 
                            if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] == "admin")
                            {
                        ?>
                        <li class="divTableCell"><a class="set_style_link" href="admin_products.php">مدیریت محصولات</a></li>
                        <?php 
                            }
                        ?>
                    </ul>
                </nav>
                <section class="divTable">
                    <section class="divTableRow">
                        <aside class="divTableCell" style="width: 25%;">بخش امکانات سایت</aside>
                        <section class="divTableCell" style="width: 75%;">