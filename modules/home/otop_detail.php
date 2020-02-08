<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>

        <div class="col-md-10 col-md-offset-1">
            <div class="content-all padding-inout">

                <?PHP
                extract($_GET);
                $sql = "SELECT * FROM tb_otop WHERE otop_id = '{$id}'";
                $row = row_array($sql);
                ?>

                <h1 class="title-page text-center"><?=$row['otop_name'];?></h1>

                <p class="text-center">
                    <small><?=$row['otop_date'];?></small> <br>
                    <img src="uploads/<?=$row['otop_picture'];?>" style="width: 100%; height: 300px;" alt="">
                </p>

                <hr>

                <?=$row['otop_detail'];?>

                <hr>

                <p>คลังรูปภาพ</p>

                <?PHP
                $sql = "SELECT * FROM tb_otoppic WHERE otop_id = '{$id}'";
                $list = result_array($sql);
                ?>

                <?PHP foreach ($list as $row){ ?>
                    <div class="col-md-2">
                        <div style="margin-bottom: 15px;">
                            <a href="uploads/<?=$row['otoppic_img'];?>" rel="group" class="fancybox">
                                <img src="uploads/<?=$row['otoppic_img'];?>" class="img-responsive" alt="">
                            </a>
                        </div>
                    </div>
                <?PHP } ?>


            </div>
        </div>
    </div>
</div>


