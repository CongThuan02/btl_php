<div class="shop__sidebar">
    <div class="sidebar">
        <div class="sidebar__title">
            <h3>
                Thể loại
            </h3>
        </div>
        <div class="sidebar__body">
            <ul class="sidebar__list">
                <!-- hiện thị ra danh sách sản phẩm -->
                <?php
                $sql = "SELECT * FROM `product_categories`";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                    $p_cat_id = $row['p_cat_id'];
                    $p_cat_title = $row['p_cat_title'];
                    echo "
                    <li class='sidebar__item'>
                        <a href='shop.php?p_cat=$p_cat_id' class='sidebar__link'>
                        $p_cat_title
                        </a>
                    </li>
                    ";
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="sidebar">
        <div class="sidebar__title">
            <h3>
                Danh mục
            </h3>
        </div>
        <div class="sidebar__body">
            <ul class="sidebar__list">
                <!-- hiện thị danh sách ra thể loại  -->
                <?php
                $sql = "SELECT * FROM `categories`";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "
                    <li class='sidebar__item'>
                        <a href='shop.php?cat=$cat_id' class='sidebar__link'>
                         $cat_title 
                        </a>
                    </li>
                    ";
                }
                ?>
            </ul>
        </div>
    </div>
</div>