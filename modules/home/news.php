<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">ข่าวสารประชาสัมพันธ์</h1>

        <?PHP
        $sql = "SELECT * FROM tb_news ORDER BY news_id DESC ";
        $result = result_array($sql);
        ?>


        <div class="col-md-12">
            <?PHP foreach ($result as $row) { ?>
                <div class="content-all margin-bottom-20">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="uploads/<?=$row['news_picture'];?>" class="img-responsive" alt="" style="
                            width: 100%;
                            ">
                        </div>
                        <div class="col-md-8">
                            <div class="list-news-detail">
                                <h2><?=$row['news_title'];?></h2>
                                <p>
                                    <?=$row['news_short'];?>
                                </p>

                                <p>
                                    วันที่ : <?=$row['news_date'];?>
                                </p>

                                <a href="index.php?module=home&action=news_detail&id=<?=$row['news_id'];?>"
                                 class="btn bg_main color_white pull-right">อ่านต่อ...</a>

                             </div>

                         </div>
                     </div>

                 </div>

                 <?PHP } ?>
             </div>

         </div>
     </div>



