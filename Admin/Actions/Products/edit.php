<?php
    include ("../../../conn.php");
    $id = $_POST['id'];
    $admin_product = "SELECT * FROM product WHERE id='$id' ORDER BY product.id ASC";
    // 2. Thực thi câu lệnh truy vấn (mục đích trả về dữ liệu các bạn cần)
    $query_product = mysqli_query($conn, $admin_product);

    // 3. Hiển thị ra dữ liệu bạn vừa lấy được
    $row = mysqli_fetch_array($query_product);

    if(isset($_POST['sbm'])){
        $product_type_id = $_POST['product_type_id'];
        $brand_id = $_POST['brand_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sale_priceil = $_POST['sale_price'];
        $import_date = $_POST['import_date'];
        $quantity = $_POST['quantity'];
        $warranty_day = $_POST['warranty_day'];
        $detail = $_POST['detail'];

        $query ="UPDATE `product` SET `product_type_id`='$product_type_id',`brand_id`='$brand_id',`name`='$name',
        `price`='$price',`sale_price`='$sale_priceil',`import_date`='$import_date',`quantity`='$quantity',
        `warranty_day`='$warranty_day',`detail`='$detail' 
        WHERE id=$id";
        $query_run = mysqli_query($conn, $query);
   
        echo "
          <script type='text/javascript'>
                alert('Bạn đã sửa thành công');
                window.location.href='../../index.php?nav=products';
          </script>";         
    }
    
?>
