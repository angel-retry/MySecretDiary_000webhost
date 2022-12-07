<?php include("login.php"); ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>我的祕密日記</title>
    <style>
    .heroImage {
      background-image: url("https://www.popdaily.com.tw/shaper/wp-content/uploads/2019/01/39tnga5b7hicckg8okg0gg4owqdx0b3-1000x625.jpg?resize-w=900&resize-h=558");
      height: 100vh;
      border-radius: 0;
      background-size: cover;
    }

    .footer-height {
      height: 350px;
      margin-bottom: 0;
    }

    #appStoreImage {
      width: 300px;
      
    }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-xl navbar-light bg-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <a href="#" class="navbar-brand mr-auto">祕密日記</a>
         
          <form class="form-inline" method="post">
            <input class="form-control mr-2" type="email" name="loginemail" placeholder="郵箱地址" value="<?php echo addslashes($_POST['loginemail']);?>">
            <input class="form-control mr-2" type="password" name="loginpassword" placeholder="輸入密碼"  value="<?php echo addslashes($_POST['loginpassword']);?>">
            <button class="btn btn-outline-warning text-nowrap mr-2" type="submit" name="submit" value="Log In">登 入</button>
  
          </form>  
        </div>      
      </div>

    </nav>

    <div class="jumbotron heroImage text-center mb-0">
      <h1 class="display-4 font-weight-bolder text-light">祕密日記</h1>

      <p class="lead text-light">專屬於您的秘密日記，永遠會陪伴著您。</p>
      <p class="lead text-light">如果您想了解更多這款軟體更多資訊，請 <strong class="text-warning">加入我們討論群!</strong></p>

      
      <form method = "post">
        <div class="form-group col-md-6 col-lg-5 mx-auto">
          <?php 
          if($error) {
            echo '<div class="alert alert-danger ">'.addslashes($error).'</div>';
          }

          if($message) {
            echo '<div class="alert alert-success ">'.addslashes($message).'</div>';
          }

          ?>
        </div>

        <div class="form-group">
            <div class="input-group  col-md-6 col-lg-5 mx-auto">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="email">e-mail</label>
                </div>

                <input type="email" name="email" placeholder="請輸入您的郵件地址" class="form-control" value="<?php echo addslashes($_POST['email']);?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group col-md-6 col-lg-5 mx-auto">
                <div class="input-group-prepend">
                    <label for="password" class="input-group-text">密碼</label>
                </div>

                <input type="password" name="password" placeholder="請輸入您的密碼" class="form-control" value="<?php echo addslashes($_POST['password']);?>"/>
            </div>
        </div>
        <div class="mt-5">
            <button type="submit" name="submit" class="btn btn-warning btn-lg" value = "Sign Up">註 冊</button>
        </div> 
        </form>     
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


  </body>
</html>