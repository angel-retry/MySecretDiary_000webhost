<?php include("login.php"); 

session_start(); 

include("connection.php");
require "connection.php";

$id = $_SESSION['id'];

$query = "SELECT diary FROM users WHERE id=? LIMIT 1 ";
$statement = mysqli_stmt_init($connection);
if(!mysqli_stmt_prepare($statement, $query)) {

    header("Location: mainpage.php?error=sqlerror");
    exit();

} else {
    mysqli_stmt_bind_param($statement, "s", $id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    if($row = mysqli_fetch_assoc($result)) {
        $diary = $row['diary'];
    }else {
        
        header("Location: mainpage.php?error=nouser");
        exit();
    }
    
}



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>我的祕密日記</title>
    <style>
    .heroImage {
      background-image: url("https://image.photocnc.com/aoaodcom/2020-11/25/2020112503195157b7bdd4de6d71031a3c4f2d359bd098.jpg.h700.webp");
      height: 100vh ;
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
        <a href="#" class="navbar-brand mr-auto">祕密日記</a>
         
        <ul class="navbar-nav nav">
            <li><a href="index.php?logout=1">Log Out</a></li>

        </ul>
      </div>

    </nav>

    <div class="jumbotron heroImage text-center mb-0">
           <textarea class="form-control mx-auto col-md-10  col-lg-6 col-xl-6" ><?php echo $diary;?></textarea>
    </div>

    <script>
      $("textarea").css("min-height", $(".heroImage").height());
          		
  		$("textarea").keyup(function() {
  		
        $.post("updatediary.php", {diary:$("textarea").val()});
        
      
      });
    
    </script>
  </body>
</html>