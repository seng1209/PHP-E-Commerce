<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            <?php
            global $db;
            $categories = $db->read("categories");
            foreach ($categories as $row) {
            ?>
            <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="./admin/uploads/images/categories/<?=$row['image']?>" alt="<?=$row['image']?>" width="300px">

                    <a href="index.php?p=product"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                <?=$row['category']?>
                            </span>

                            <span class="block1-info stext-102 trans-04">
                                <?=$row['description']?>
                            </span>
                        </div>

                        <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                Shop Now
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>