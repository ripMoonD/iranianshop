<?php 
    include ("includes/header.php");
    
    $link = mysqli_connect("localhost", "root", "", "shop_db");

    if (mysqli_connect_errno())
        exit("خطایی با شرح زیر رخ داده است:".mysqli_connect_errno());

    $query = "SELECT * FROM products";
    $result = mysqli_query($link, $query);
?>

    <table border="1" width="100%">
        <tr>
    <?php 
        $counter = 0;
        while ($row = mysqli_fetch_array($result)) {
            $counter++;
    ?>

    <td style="border-style: dotted dashed; vertical-align: top; width: 33%;">

    <h4 style="color: brown;"><?php echo ($row['pro_name']) ?></h4>

    <a href="product_detail.php?id=<?php echo ($row['pro_code']) ?>" >
    <img src="images/products/<?php echo ($row['pro_image']) ?>" width="250px" height="150px">
    </a>

    <br>
    قیمت : <?php echo ($row['pro_price']) ?>&nbsp; ریال
    <br>

    <br>
    تعداد موجودی : <span style="color: red;"><?php echo ($row['pro_qty']) ?></span>
    <br>
    
    <br>
    توضیحات : <span style="color: green;"><?php echo (substr($row['pro_detail'], 0, 120)) ?>...</span>
    <br>

    <br><br>

    <b><a href="product_detail.php?id=<?php echo ($row['pro_code']) ?>" style="text-decoration: none;">توضیحات تکمیلی و خرید</a></b>

    </td>

<?php
    if ($counter % 3 == 0)
        echo ("</tr><tr>");
    }

    if ($counter % 3 != 0)
        echo ("</tr>");
?>

    </table>

<?php
    include ("includes/footer.php");
?>