<?php
$active = 'Shop';
include('header.php')

?>
<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Cửa Hàng</li>
            </ul>
            <?php
            include('sidebar.php')
            ?>
            <div class="shop__content">
                <!-- hiện thị Tiêu đề mà mô tả chung của các sản phẩm -->
                <?php
                if (!isset($_GET['p_cat'])) {

                    if (!isset($_GET['cat'])) {
                        echo " 
                        <div class='shop__title'>
                            <h1>Cửa Hàng</h1>
                            <br/>
                            <p>Mô tả sản phẩm</p>
                        </div>
                 ";
                    }
                }
                ?>
                <!-- hiện thị ra tất cả sản phẩm sắp xếp giảm dần theo id -->
                <?php
                if (!isset($_GET['p_cat'])) {

                    if (!isset($_GET['cat'])) {
                        // phân trang ,mỗi trang 12 sản phẩm
                        $per_page = 12;
                        // nếu có thì bằng số trang nếu ko thì là 1
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        // sản phẩm bắt đầu bằng (số trang -1 )nhân với 12
                        // chia trang
                        $start_from = ($page - 1) * $per_page;
                        
                        echo "<div class='shop__product' id='output'>";
                        // in ra số sản phẩm theo trang sắp xếp theo id
                        $sql = "select * from product order by product_id DESC LIMIT $start_from,$per_page";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($res)) {
                            $product_id = $row['product_id'];
                            $product_title = $row['product_title'];
                            $product_price = $row['product_price'];
                            $product_img = $row['product_img'];
                            // echo $product_id;
                            echo "
                        <div class='content__product'>
                        <a href='details.php?product_id=$product_id' class='content__link'>
                            <img src='image/$product_img' alt=''>
                        </a>
                        <div class='context__text'>
                            <h3>
                                $product_title
                            </h3>
                            <p>
                                $product_price VND
                            </p>
                            <p class='content__btn'>
                                <a href='details.php?product_id=$product_id'>
                                    Xem chi tiết
                                </a>
                            </p>
                        </div>
                    </div>
                ";
                        }
                        echo "</div>";
                    }
                }
                ?>
                <!-- hiện thị sản phẩm theo id danh mục sản-->
                <?php

                if (isset($_GET['p_cat'])) {
                    $p_cat_id = $_GET['p_cat'];
                    $sql = "SELECT * FROM `product_categories` where p_cat_id='$p_cat_id'";
                    $res = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($res);
                    $p_cat_title = $row['p_cat_title'];
                    $p_cat_desc = $row['p_cat_desc'];
                    $sql_2 = "select * from product where p_cat_id='$p_cat_id'";
                    $res_2 = mysqli_query($con, $sql_2);

                    $count = mysqli_num_rows($res_2);
                    if ($count == 0) {

                        echo "
                            <div class='shop__title'>
                            <h1> Không tìm thấy sản phẩm nào trong danh mục sản phẩm này </h1>
                        </div>
                            ";
                    } else {
                        echo " 
                            <div class='shop__title'>
                                <h1>{$p_cat_title}</h1>
                                <br/>
                                <p>{$p_cat_desc}</p>
                            </div>
                            
                     ";
                    }
                    echo "<div class='shop__product'id='output'>";
                    while ($row_2 = mysqli_fetch_array($res_2)) {
                        $product_id = $row_2['product_id'];
                        $product_title = $row_2['product_title'];
                        $product_price = $row_2['product_price'];
                        $product_img = $row_2['product_img'];
                        echo "
                            <div class='content__product'>
                            <a class='content__link' href='details.php?product_id=$product_id'>
                                <img src='image/$product_img' alt=''>
                            </a>
                            <div class='context__text'>
                                <h3>
                                    $product_title
                                </h3>
                                <p>
                                    $product_price VND
                                </p>
                                <p class='content__btn'>
                                    <a href='details.php?product_id=$product_id'>
                                        Xem chi tiết
                                    </a>
                                </p>
                            </div>
                        </div>
                    ";
                    }
                    echo "</div>";
                }
                ?>
                <!-- hiện thị sản phẩm theo id thể loại-->
                <?php

                if (isset($_GET['cat'])) {
                    $cat_id = $_GET['cat'];
                    $sql = "SELECT * FROM `categories` where cat_id='$cat_id'";
                    $res = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($res);
                    $cat_title = $row['cat_title'];
                    $cat_desc = $row['cat_desc'];
                    $sql_2 = "select * from product where cat_id='$cat_id'";
                    $res_2 = mysqli_query($con, $sql_2);
                    $count = mysqli_num_rows($res_2);
                    if ($count == 0) {
                        echo "
            <div class='shop__title'>
            <h1> Không tìm thấy sản phẩm nào trong danh mục sản phẩm này </h1>
        </div>
            ";
                    } else {
                        echo " 
            <div class='shop__title'>
                <h1>{$cat_title}</h1>
                <br/>
                <p>{$cat_desc}</p>
            </div>
            
     ";
                    }
                    echo "<div class='shop__product'id='output'>";
                    while ($row_2 = mysqli_fetch_array($res_2)) {
                        $product_id = $row_2['product_id'];
                        $product_title = $row_2['product_title'];
                        $product_price = $row_2['product_price'];
                        $product_img = $row_2['product_img'];
                        echo "
            <div class='content__product'>
            <a class='content__link' href='details.php?product_id=$product_id'>
                <img src='image/$product_img' alt=''>
            </a>
            <div class='context__text'>
                <h3>
                    $product_title
                </h3>
                <p>
                    $product_price VND
                </p>
                <p class='content__btn'>
                    <a href='details.php?product_id=$product_id'>
                        Xem chi tiết
                    </a>
                </p>
            </div>
        </div>
    ";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <ul class="pagination">
            <?php
    
            $sql = "select * from product";
    
            $res = mysqli_query($con, $sql);
    
            $total = mysqli_num_rows($res);
            // tính số trang ,hàm làm tròn lên
            $total_pages = ceil($total / $per_page);
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li><a href='shop.php?page=" . $i . "'> " . $i . " </a></li>";
            };
    
    
            ?>

        </ul>
    </div>
</div>
</div>

<?php

include('footer.php')

?>


<!-- <input type="text"  id="search_product" placeholder="Tìm kiếm sản phẩm" class="form-control" /> -->

<!--  -->
<!-- <script>
	
$(document).ready(function(){
	// tải dữ liệu từ máy chủ
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"shop_search_ajax.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#output').html(data);
			}
		});
	}
	
	$('#search_product').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script> -->




