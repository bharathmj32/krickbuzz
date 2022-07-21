<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
   <script>                                                                         
            $(document).ready(function() { 
                $('input[type="radio"]').click(function() { 
                    var inputValue = $(this).attr("value"); 
                    var targetBox = $("." + inputValue); 
                    $(".box").not(targetBox).hide(); 
                    $(targetBox).show(); 
                }); 
            }); 
    </script>
    <style type="text/css">
      body{
           background-image: url('bg16.jpg');
         background-repeat: no-repeat;
         background-size: cover;
        }
        .title{
  font-size: 30px;
  font-weight: 600;
  text-align: center;
  line-height: 80px;
  color: #fff;
  user-select: none;
  border-radius: 10px 10px 10px 10px;
  background-color: #4158D0;
  z-index: 2;
}
.box{
  width: 45%; height: 435px; margin-top: 130px;margin-left: 34%;border-radius: 25px;
}
    </style>
  </head>
  <body style="background-color: #E6E6FA">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand active" href="home.html"><img src="logo.png" height="45" width="45"> KricBuzz</a>

 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="matches.php">Matches </a></li>
      <li class="nav-item"><a class="nav-link" href="teampoints.php">Team Points</a></li>
      <li class="nav-item"><a class="nav-link" href="records.php">Records</a></li>
      <li class="nav-item active"><a class="nav-link" href="login.php">Admin</a></li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="" method="POST">
      <input class="form-control mr-sm-2" type="text" placeholder=" Search Player" aria-label="Search" name="playername" list="search_player">
      <datalist id="search_player">
        <?php 
        include'connection.php';
          $string="SELECT name from player";
          $result=mysqli_query($con,$string);
          
          if(mysqli_num_rows($result)>0)
              {
               
                while($row=mysqli_fetch_assoc($result) )
                {
                  echo "<option>".$row['name']."</option>";
                  
                }
              }


         ?> 

      </datalist>




      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submitplayer">Search</button>
    </form>
 
    
    
    <?php 
    include 'connection.php';
    if(isset($_POST['submitplayer']))
    { 
      $name = $_POST['playername'];
          
      $sql = "SELECT * from player where name like '%$name%'";

      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
      $count = mysqli_num_rows($result);
              
      if($count == 1){
        $_SESSION['id'] = $row['id'];
        header('Location: player.php');
      }  
    }
  ?>




  </div>
</nav>
  <div class="container">
    <div class='boxx' style="transform-style: preserve-3d">
    <img src="admin_bg.jpg" style="width: 45%; height: 435px; margin-top: 130px;margin-left: 34%;border-radius: 25px;">
    <div class="wrapper" style='transform: translateZ(20px)'>
      <div class="title">Admin Login</div>
      <form action="login.php" method="POST">
        <div class="field">
            <input type="text" id="user" name="user" required>
            <label>Username</label>
        </div>
        <div class="field">
            <input type="password" id="pass" name="pass" required>
            <label>Password</label>
        </div>
        <br>

        <div class="field" style="margin-top: 30px;">
          <input type="submit" name="sumbitforlive" id="btn" value="Login">
        </div>
      </form>
    </div>
  </div>
  </div>


  <script type="text/javascript" src="vanilla-tilt.js"></script>
<script type="text/javascript">
  VanillaTilt.init(document.querySelectorAll(".boxx"), {
    max: 5,
    speed: 400,
    scale:1.2
  });

</script>
  </body>
</html>
<script>
  function alertFunction(){
    alert("Login failed. Invalid username or password.");
  }
</script>
<?php   
// include('connection.php');
if(isset($_POST['sumbitforlive']))
{ 
  $username = $_POST['user'];  
  $password = $_POST['pass']; 
          
  if($username=="admin" and $password=="1234"){
    
     echo "<script> location.href='live.php'; </script>";
  }  
  else{  
    echo "Login Failed! Invalid Username or Password";
  }
}  
?>
