<?php
include('db.php');
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($con, $_POST["query"]);
	$sql = "SELECT * FROM product 
	WHERE product_keywords LIKE '%$search%'";
}
else
{
	$sql = "SELECT * FROM product ORDER BY product_id";
}
$res = mysqli_query($con, $sql);
if(mysqli_num_rows($res) > 0)
{

	while ($row_2 = mysqli_fetch_array($res)) {
		$product_id = $row_2['product_id'];
		$product_title = $row_2['product_title'];
		$product_price = $row_2['product_price'];
		$product_img = $row_2['product_img'];
		$output .="
		<div class='content__product'>
			<a class='content__link' href='details.php?product_id=$product_id'>
			<img src='image/$product_img' alt=''>
		</a>
		<div class='context__text'>
<h3>
	$product_title
</h3>
<p>
	$product_price Triệu
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
	echo $output;
}
else
{
	echo 'Không tìm thấy';
}
?>