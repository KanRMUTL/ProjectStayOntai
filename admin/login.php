<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stay Ontai</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    
    <style type="text/css">
        .loginbox{
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 450px;
            height: 300px;
            box-sizing: border-box;
            background:rgba(0,0,0,.5);
        }
        h3{
            font-weight: bold;
            color: #FFFFFF;
        }
        h5{
            font-weight: bold;
            color: #FFFFFF;
            margin: 0px 0px 0px -50px;
        }
        .col-sm-3 {
            width: 35%; 

        }
        .form-control{
            width: 240%;
            margin: 0px 0px 0px -50px;
        }
    </style>

</head>

<body style="margin:0;padding:0; background-size:cover;background-image: url('assets/img/ontai.jpg');">


<div class="container">
    <div class="loginbox">
    <div class="row" id="admin-main">
        <div class="col-md-6 col-md-offset-3">
            <h3 align ='center'>สำหรับผู้ดูแลระบบ</h3><br>
            <div class="admin-border-radius">
                <form action="process/check_login.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-3 control-lable">
                            <h5>ชื่อผู้ใช้ :</h5>
                        </div>
                        <div class="col-sm-6">
                            <input type="email" name="email" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3 control-lable">
                            <h5>รหัสผ่าน :</h5>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>




</body>
</html>