<?php
session_start();

if(isset($_SESSION["logged_in"])){
  $logged = $_SESSION["logged_in"];
}
else{
  $logged = false;
}
?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Startseite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
  </head>
  <body>
    <div id="navbar" class="container-fluid">
      <div class="row">
        <div class="col-sm-auto">
        </div>
        <div class="col-sm">
          <ul style="width: 100%;">
            <?php
              if(!$logged)
              echo <<<html
            <li style="display: block;float: right;"><a class="inbar" href="/login/index.php" style="float: right;">Login</a></li>
            <li style="display: block;float: right;"><a class="inbar" href="/register/index.html" style="float: right;">Register</a></li>
html;
              else
                echo <<<html
            <li style="display: block;float: right;"><a class="inbar" href="/logout/logout.php" style="float: right;">Logout</a></li>
html;
            ?>
            
          </ul>
        </div>  
      </div>
    </div>
    </div>
    <div id="hero">
      
    </div>
    <div class="container-fluid" style="margin-top: 25px;">
      <div class="row">
        <div class="col-md-5 col-lg-4 col-xl-3">
          <iframe src="/Kalender/prod.php"></iframe>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	
    <script src="/javascript/main.js"></script>
  </body>
</html>
