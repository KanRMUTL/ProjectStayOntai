<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">สินค้า OTOP</h1>

        <?PHP
        $sql = "SELECT * FROM tb_otop ORDER BY otop_id DESC ";
        $result = result_array($sql);
        ?>

        <div class="row">

            <div class="col-md-10 col-md-offset-1">
                <div class="list-travel">
                    <div class="row">
                        <?PHP foreach ($result as $row) { ?>
                            <div class="col-md-4 mb25">
                                <div class="content-all">
                                    <a href="index.php?module=home&action=otop_detail&id=<?=$row['otop_id'];?>">
                                        <img src="uploads/<?=$row['otop_picture'];?>" alt="">
                                        <p><?=$row['otop_name'];?></p>
                                    </a>
                                </div>
                            </div>
                        <?PHP } ?>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>



