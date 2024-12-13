<?php
$active = 'Cart';
include('header.php');
?>
<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM product WHERE product_id='$product_id'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $p_cat_id = $row['p_cat_id'];
    $product_title = $row['product_title'];
    $product_price = $row['product_price'];
    $product_desc = $row['product_desc'];
    $product_img = $row['product_img'];
    $sql_2 = "SELECT * FROM `product_categories` WHERE p_cat_id='$p_cat_id'";
    $res = mysqli_query($con, $sql_2);
    $row_2 = mysqli_fetch_array($res);
    $p_cat_title = $row_2['p_cat_title'];
}
?>
<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Shop</li>
                <li>
                    <a href="shop.php?p_cat=<?php echo $p_cat_id; ?>"><?php echo $p_cat_title; ?></a>
                </li>
                <li> <?php echo $product_title; ?> </li>
            </ul>
            <?php
            include('sidebar.php');
            ?>
            <div class="details">
                <div class="details__img">
                    <a href="shop.php">
                        <img src="image/<?php echo $product_img; ?>" alt="">
                    </a>
                </div>
                <div class="detail__right">
                    <!-- thêm mặt hàng vào giỏ hàng ,nếu có trong giỏ hàng rồi thì báo trùng -->
                    <?php
                    if (isset($_GET['add_cart'])) {
                        $p_id = $_GET['add_cart'];
                        $ip_add = getRealIpUser();
                        $product_qty = $_POST['product_qty'];
                        $product_size = $_POST['product_size'];
                        $sql = "SELECT * FROM cart WHERE ip_add='$ip_add' AND p_id='$p_id'";
                        $res = mysqli_query($con, $sql);
                        if (mysqli_num_rows($res) > 0) {
                            echo "<script>alert('Sản phẩm này đã được thêm vào giỏ hàng')</script>";
                            echo "<script>window.open('details.php?product_id=$p_id','_self')</script>";
                        } else {
                            $sql_2 = "INSERT INTO cart (p_id,ip_add,qty,size)
                            VALUES ('$p_id','$ip_add','$product_qty','$product_size')";
                            $res_2 = mysqli_query($con, $sql_2);
                            echo "<script>window.open('details.php?product_id=$p_id','_self')</script>";
                        }
                    }
                    ?>
                    <form class="detail__box" action="details.php?add_cart=<?php echo $product_id; ?>" method="post">
                        <div class="details__desc">
                            <h2> <?php echo $product_title; ?></h2>
                        </div>
                        <div class="details__number">
                            <p>
                                Số lượng sản phẩm
                            </p>
                            <select name="product_qty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                                <option value="66">66</option>
                                <option value="67">67</option>
                                <option value="68">68</option>
                                <option value="69">69</option>
                                <option value="70">70</option>
                                <option value="71">71</option>
                                <option value="72">72</option>
                                <option value="73">73</option>
                                <option value="74">74</option>
                                <option value="75">75</option>
                                <option value="76">76</option>
                                <option value="77">77</option>
                                <option value="78">78</option>
                                <option value="79">79</option>
                                <option value="80">80</option>
                                <option value="81">81</option>
                                <option value="82">82</option>
                                <option value="83">83</option>
                                <option value="84">84</option>
                                <option value="85">85</option>
                                <option value="86">86</option>
                                <option value="87">87</option>
                                <option value="88">88</option>
                                <option value="89">89</option>
                                <option value="90">90</option>
                                <option value="91">91</option>
                                <option value="92">92</option>
                                <option value="93">93</option>
                                <option value="94">94</option>
                                <option value="95">95</option>
                                <option value="96">96</option>
                                <option value="97">97</option>
                                <option value="98">98</option>
                                <option value="99">99</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="details__size">
                            <p>
                                Kích thước sản phẩm
                            </p>
                            <select name="product_size">
                                <option value="S">S Nam</option>
                                <option value="M">M Nam</option>
                                <option value="L">L Nam</option>
                                <option value="XL">XL Nam</option>
                                <option value="XXL">XXL Nam</option>
                                <option value="S">S Nữ</option>
                                <option value="M">M Nữ</option>
                                <option value="L">L Nữ</option>
                                <option value="XL">XL Nữ</option>
                                <option value="XXL">XXL Nữ</option>
                            </select>
                        </div>
                        <div class="details__center">
                            <div class="details__price">
                                <?php echo $product_price; ?>VND
                            </div>
                            <div class="details__button">
                                <button type="submit" class="fa fa-shopping-cart">
                                    THÊM VÀO GIỎ HÀNG
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="details__tt">
                        <?php
                        $sql = "select * from product order by rand() LIMIT 0,3";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($res)) {
                            $product_id = $row['product_id'];
                            $product_title = $row['product_title'];
                            $product_img = $row['product_img'];
                            $product_price = $row['product_price'];
                            echo "
                            <div class='details__img'>
                                <a href='details.php?product_id=$product_id'>
                                    <img src='image/$product_img' alt=''>
                                </a>
                                <div>
                                <h3> <a href='details.php?product_id=$product_id'> $product_title </a> </h3>
                                    
                                <p class='price'> $ $product_price </p>
                                </div>
                            </div>
                            
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<?php
include('footer.php');
?>