<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">สถานที่ท่องเที่ยว</h1>

        <?PHP
        $sql = "SELECT * FROM tb_visitplace ORDER BY visitplace_id DESC ";
        $result = result_array($sql);
        ?>

        <div class="row">

            <div class="col-md-10 col-md-offset-1">
                <div class="list-travel">
                    <div class="row">
                        <?PHP foreach ($result as $row) { ?>
                            <div class="col-md-4 mb25">
                                <div class="content-all">
                                    <a href="index.php?module=home&action=visitplace_detail&id=<?=$row['visitplace_id'];?>">
                                        <img src="uploads/<?=$row['visitplace_picture'];?>" alt="">
                                        <p><?=$row['visitplace_name'];?></p>
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



