<?php
    include ("includes/header.php");

    if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true)) {
?>

<script type="text/javascript">
    location.replace("index.php");
</script>

<?php
    }

    $link = mysqli_connect("localhost", "root", "", "shop_db");

    if (mysqli_connect_errno())
        exit("خطایی با شرح زیر رخ داده است:".mysqli_connect_errno());

    $pro_code = $_POST['pro_code'];
    $pro_name = $_POST['pro_name'];
    $pro_qty = $_POST['pro_qty'];
    $pro_price = $_POST['pro_price'];
    $total_price = $_POST['total_price'];
    
    $realname = $_POST['realname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $username = $_SESSION['username'];
    

    $query = "INSERT INTO orders (
    id,
    username,
    orderdate,
    pro_code,
    pro_qty,
    pro_price,
    mobile,
    address,
    trackcode,
    state
    ) VALUES 
    ('0',
    '$username',
    '".date("Y-m-d")."',
    '$pro_code',
    '$pro_qty',
    '$pro_price',
    '$mobile',
    '$address',
    '000000000000000000000000',
    '0')";

    /*
        تحت بررسی 0
        آماده ارسال 1
        ارسال شده 2
        سفارش لغو شده است 3
    */

    if (mysqli_query($link, $query) === true) {
        echo ("<p style='color: green;'><br><b>سفارش شما با موفقیت در سامانه ثبت شد</b></p>");

        echo ("<p style='color: brown;'><br><b>کاربر گرامی آقا/خانم $realname</b></p>");
        
        echo ("<p style='color: brown;'><br><b>محصول $pro_name با کد $pro_code به تعداد/مقدار $pro_qty با قیمت پایه $pro_price ریال را سفارش داده اید</b></p>");
        
        echo ("<p style='color: red;'><br><b>مبلغ قابل پرداخت برای سفارش ثبت شده $total_price ریال است</b></p>");
        
        echo ("<p style='color: blue;'><br><b>پس از بررسی سفارش و تایید آن با شما تماس گرفته خواهد شد</b></p>");
        
        echo ("<p style='color: blue;'><br><b>محصول خریداری شده از طریق پست جمهوری اسلامی ایران طبق آدرس درج شده ارسال خواهد شد</b></p>");
        
        echo ("<p style='color: blue;'><br><b>در هنگام تحویل گرفتن محصول آن را بررسی و از صحت و سالم بودن آن اطمینان حاصل کنید سپس مبلغ کالا را طبق فاکتور ارائه شده به مامور پست تحویل دهبد</b></p>");

        $query = "UPDATE products SET pro_qty = pro_qty - $pro_qty WHERE pro_code = '$pro_code'";
        mysqli_query($link, $query);

    } else 
        echo ("<p style = 'color: red;'<b>خطا در ثبت سفارش</b></p>");

    
    include ("includes/footer.php");
?>