<!doctype html>
<html>
<head>
    <?PHP include "include/script.php"; ?>
    <style>
        .form-group {
            overflow: hidden;
        }
    </style>
</head>
<body>


<?PHP include "include/header.php"; ?>

<div class="container main">

    <?PHP include "include/right.php"; ?>


    <?PHP
    $id = "";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $sql = "SELECT * FROM tb_news WHERE news_id = '{$id}'";
    $row = row_array($sql);



    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div class="form_all">

                <legend>จัดการข่าวสาร</legend>

                <form role="form" action="process/news_process.php" method="post"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $row['news_id']; ?>">


                    <div class="form-group">
                        <label>หัวข้อข่าว</label>
                        <input type="text" class="form-control" name="title" value="<?= $row['news_title']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>รายละเอียดแบบย่อ</label>
                        <textarea class="form-control" name="short"><?= $row['news_short']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>รายละเอียดเต็มๆ</label>
                        <textarea class="form-control" name="detail"><?= $row['news_detail']; ?></textarea>
                    </div>


                    <div class="form-group">
                        <label>รูปภาพข่าวสาร</label>
                        <input type="file" class="form-control" accept="image/*" name="img">
                    </div>

                    <p align="center">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="news.php" class="btn btn-warning">ย้อนกลับ</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>

<script type="text/javascript">
    CKEDITOR.replace( 'detail',{
        skin   : 'kama',
        language   : 'en',
        enterMode: 2,
        shiftEnterMode  :1,
        height : 200,

        toolbar :
            [
                //['Source'],
                //['Cut','Copy','Paste','PasteText','Preview'],
                //['Undo','Redo','-','SelectAll','RemoveFormat'],
                '/',
                ['Bold','Italic','Underline','Strike','-'],
                ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                //  ['Link','Unlink','Anchor'],
                ['Image','Flash','Table','Smiley','SpecialChar'],
                '/',
                ['Styles','Format','FontSize'],
                ['TextColor','BGColor'],
                // ['Maximize', 'ShowBlocks','-','About']
            ],
        filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    } );
</script>


</body>
</html>