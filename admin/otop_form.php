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

    $sql = "SELECT * FROM tb_otop WHERE otop_id = '{$id}'";
    $row = row_array($sql);


    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div class="form_all">

                <legend>จัดการสินค้า OTOP</legend>

                <form role="form" action="process/otop_process.php" method="post"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $row['otop_id']; ?>">


                    <div class="form-group">
                        <label>สินค้า OTOP</label>
                        <input type="text" class="form-control" name="name" value="<?= $row['otop_name']; ?>"
                               required>
                    </div>


                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" name="detail"><?= $row['otop_detail']; ?></textarea>
                    </div>


                    <div class="form-group">
                        <label>รูปภาพสินค้า</label>
                        <input type="file" class="form-control" accept="image/*" name="img">
                    </div>

                    <p align="center">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="otop.php" class="btn btn-warning">ย้อนกลับ</a>
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