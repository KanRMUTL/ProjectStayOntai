<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stay Ontai</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    
    <style type="text/css">
    
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
    .form_all {
    background: #82b37a;
    border: 2px solid;
    border-radius: 30px;
    padding: 20px 30px;
    margin-bottom: 50px;
     margin-top: 100px;
     background: rgba(0,0,0,.5);
}





    </style>

</head>

<body style="margin:0;padding:0; background-repeat: no-repeat;background-attachment: fixed; background-size:cover;background-image: url('assets/img/ontai.jpg');">


<div class="container">
    <div class="row" id="admin-main">
        <div class="col-md-6 col-md-offset-3">
            
            <div class="form_all">
            <h3 align ='center'>สำหรับผู้ดูแลระบบ</h3><br>
            <div class="admin-border-radius">
                <form action="process/check_login.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        
                           <label style="color: #FFFFFF" >ชื่อผู้ใช้ :</label>
                        
                        
                            <input type="email" name="email" required class="form-control">
                        
                    </div>
                    <div class="form-group">
                      
                          <label style="color: #FFFFFF">รหัสผ่าน :</label>
                        
                        
                            <input type="password" name="password" required class="form-control">
                        
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