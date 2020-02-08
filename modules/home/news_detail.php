<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>

        <div class="col-md-12">
            <div class="content-all padding-inout">

                <?PHP
                extract($_GET);
                $sql = "SELECT * FROM tb_news WHERE news_id = '{$id}'";
                $row = row_array($sql);
                ?>

                <p class="text-right">
                    ข่าววันที่ : <?=$row['news_date'];?></small>
                </p>

                <h1 class="title-page text-left"><?=$row['news_title'];?></h1>

                <?=$row['news_detail'];?>

                <hr>

                <p>คลังรูปภาพ</p>

                <?PHP
                $sql = "SELECT * FROM tb_newspic WHERE news_id = '{$id}'";
                $list = result_array($sql);
                ?>

                <?PHP foreach ($list as $row){ ?>
                    <div class="col-md-2">
                        <div style="margin-bottom: 15px;">
                            <a href="uploads/<?=$row['newspic_img'];?>" rel="group" class="fancybox">
                                <img src="uploads/<?=$row['newspic_img'];?>" class="img-responsive" alt="">
                            </a>
                        </div>
                    </div>
                <?PHP } ?>



            </div>
        </div>
    </div>
</div>



