<?php
include("includes/header.php");

if (!(isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true && $_SESSION["user_type"] == "admin")) {
    ?>
    <script>
        location.replace("index.php");
    </script>
    <?php
}

$link = mysqli_connect("localhost", "root", "", "shop_db");

if (mysqli_connect_errno())
    exit("خطایی با شرح زیر رخ داده است:" . mysqli_connect_errno());

$pro_code = "";
$pro_name = "";
$pro_qty = "";
$pro_price = "";
$pro_image = "";
$pro_detail = "";
$btn_caption = "افزودن کالا";
$action_type = "insert"; // Default action is insert

if (isset($_GET['action']) && $_GET['action'] == 'EDIT' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE pro_code = '$id'";
    $result = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($result)) {
        $pro_code = $row['pro_code'];
        $pro_name = $row['pro_name'];
        $pro_qty = $row['pro_qty'];
        $pro_price = $row['pro_price'];
        $pro_image = $row['pro_image'];
        $pro_detail = $row['pro_detail'];
        $btn_caption = "ویرایش کالا";
        $action_type = "update";  // Set action type to 'update'
    }
}
?>

<br>
<form action="action_admin_products.php" name="add_product" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action_type" value="<?php echo $action_type; ?>">
    <table style="width: 100%;" border="0" style="margin-left: auto; margin-right: auto;">

        <tr>
            <td style="width: 22%;">کد کالا<span style="color: red;">*</span></td>
            <td style="width: 78%;"><input type="text" id="pro_code" name="pro_code" value="<?php echo $pro_code; ?>"></td>
        </tr>

        <tr>
            <td>نام کالا<span style="color: red;">*</span></td>
            <td><input type="text" id="pro_name" name="pro_name" value="<?php echo $pro_name; ?>"></td>
        </tr>

        <tr>
            <td>موجودی کالا<span style="color: red;">*</span></td>
            <td><input type="text" id="pro_qty" name="pro_qty" value="<?php echo $pro_qty; ?>"></td>
        </tr>

        <tr>
            <td>قیمت کالا<span style="color: red;">*</span></td>
            <td><input type="text" id="pro_price" name="pro_price" value="<?php echo $pro_price; ?>">ریال</td>
        </tr>

        <tr>
            <td>آپلود تصویر کالا<span style="color: red;">*</span></td>
            <td><input type="file" id="pro_image" name="pro_image" size="30">
                <?php
                if (!empty($pro_image))
                    echo("<img src='images/products/$pro_image' width='80' height='40'>");
                ?>
            </td>
        </tr>

        <tr>
            <td>توضیحات تکمیلی کالا<span style="color: red;">*</span></td>
            <td><textarea id="pro_detail" name="pro_detail" cols="45" rows="10" wrap="virtual"><?php echo $pro_detail; ?></textarea></td>
        </tr>

        <tr>
            <td><br><br></td>
            <td><input type="submit" value="<?php echo $btn_caption; ?>">&nbsp;&nbsp;&nbsp;<input type="reset" value="جدید"></td>
        </tr>

    </table>
</form>

<?php
$query = "SELECT * FROM products";
$result = mysqli_query($link, $query);
?>

<table border="1px" width="100%">
    <tr>
        <td>کد کالا</td>
        <td>نام کالا</td>
        <td>موجودی کالا</td>
        <td>قیمت کالا</td>
        <td>تصویر کالا</td>
        <td>ابزار مدیریتی</td>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php echo($row['pro_code']); ?></td>
            <td><?php echo($row['pro_name']); ?></td>
            <td><?php echo($row['pro_qty']); ?></td>
            <td><?php echo($row['pro_price']); ?>&nbsp;ريال</td>
            <td><img src="images/products/<?php echo($row['pro_image']); ?>" width="150px" height="50px"/></td>
            <td>
                <b><a href="action_admin_products.php?action=DELETE&id=<?php echo($row['pro_code']); ?>"
                       style="text-decoration :none;">حذف</a></b>
                <b><a href="?action=EDIT&id=<?php echo($row['pro_code']); ?>" style="text-decoration :none;">ویرایش</a></b>
            </td>
        </tr>
        <?php
    }
    ?>

</table>

<?php
include("includes/footer.php");
?>