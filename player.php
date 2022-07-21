<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Player Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
            <style>
              *{
              margin:0;
              padding:0;
            }
            .navbar-expand-lg {
                width: 92%;
                margin-left: 5%;
                margin-top: 20px;
            }
            #kontainer{
                width: 92%;
                margin-left: 5%;
                margin-top: 20px;
            }
            
            .box2{
              width:70%;
              float: left;
              background: pink;
              margin-left: 15%;
                  height: 420px;
            }
            h4{
              margin-left: 5%;
              background: linear-gradient(-180deg, #bd2130bf, #0006cc45);
              margin-right: 5%;
              padding-left: 5px;
              transform: translateZ(30px);
              box-shadow: 0px 0px 5px  rgba(0,0,0,0.3);
            }
            h4>b{padding-left: 15px;}
            #img{
              width:230px;
              height:220px;
            }
             #video{
    position: fixed;
    right:0;
    bottom:0;
    min-width: 100%;
    min-height: 100%;
    z-index: -1;
  }
  .box2{
    transform-style: preserve-3d;
    border-radius: 5px;
    box-shadow: 0px 15px 20px rgba(0,0,0,0.6);
    background: linear-gradient(-180deg, rgb(70 62 199 / 40%), rgb(189 33 48 / 24%));
    color:white;
  }

            </style>
</head>
<body style="background-color: #E6E6FA">
  <video autoplay muted loop id='video'><source src="gradient.mp4" type="video/mp4"></video>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand active" href="home.html"><img src="logo.png" height="45" width="45"> KricBuzz</a>

 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="matches.php">Matches </a></li>
      <li class="nav-item"><a class="nav-link" href="teampoints.php">Team Points</a></li>
      <li class="nav-item"><a class="nav-link" href="records.php">Records</a></li>
      <li class="nav-item"><a class="nav-link" href="login.php">Admin</a></li>
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




      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
    </form>

    <?php 
    include 'connection.php';
    if(isset($_POST['submit']))
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
<?php 
  include "connection.php";
  $id=$_SESSION['id'];
  $sql = "select * from player where id=$id";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
  $name=$row['name'];
  $team=$row['team'];
  $role=$row['role'];
  $sql = "select * from player_stats where stat_id=$id";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
  $matches=$row['matches_played'];
  $runs=$row['runs_scored'];
  $fifties=$row['50s'];
  $hundreds=$row['100s'];
  $highest_score=$row['highest_score'];
  $overs=$row['balls_bowled']/6;
  $wickets=$row['wickets'];
  $highest_wickets=$row['highest_wickets'];
   ?>
<div id="kontainer">
		<!--<div class="box1"><img src="logo.png" alt="Avatar" id="img" style="width:100%; height:494px;"></div>-->

		<div class="box2">
      <br>
      <div style="margin-left: 20px; margin-right: 20px;transform: translateZ(20px);box-shadow: 0px 0px 5px rgba(0,0,0,0.6);">
        <h2 style="background-color: grey; padding-left: 30px; height: 48px; border-radius: 6px;">
          <?php
            if($team=='India')     echo   "<img style='width:54px;height:40px' src='india.jpeg'>";
            elseif($team=='England')   echo   "<img src='england.jpeg' style='width:54px;height:40px'>";
            elseif($team=='Australia')  echo   "<img src='australia.jpeg' style='width:54px;height:40px'>";
            else    echo   "<img src='westindies.jpeg' style='width54px;height:40px'>";
          ?>
          <i style="padding-left: 10px;"><?php echo $team ?></i>
          <b><i style="float: right; padding-right: 15px;color:white;text-shadow: 0px 0px 2px  pink;"><?php echo $name ?></i></b>
        </h2>
      </div>
      <br>
      <div style="float: left; width: 65%;">
        <h4><b>Matches &emsp;&emsp;&emsp;&emsp;&emsp;/ &emsp;<?php echo $matches ?></b></h4>
        <h4><b>Runs &emsp;&emsp;&emsp;&emsp; &emsp; &emsp;/ &emsp;<?php echo $runs ?></b></h4>
        <h4><b>Fifties &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/ &emsp;<?php echo $fifties ?></b></h4>
        <h4><b>Hundreds &emsp; &emsp;&emsp;&emsp;/ &emsp;<?php echo $hundreds ?></b></h4>
        <h4><b>Wickets &emsp;&emsp;&emsp;&emsp;&emsp;/ &emsp;<?php echo $wickets ?></b></h4>
        <h4><b>Overs &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/ &emsp;<?php echo (int)($overs/6) ?></b></h4>
        <h4><b>Highest Score   &emsp;&emsp;/ &emsp;<?php echo $highest_score ?></b></h4>
        <h4><b>Highest Wickets &emsp;/ &emsp;<?php echo $highest_wickets ?></b></h4>
      </div>
      <div style="float: left; padding-left:4%;">
        <img src="player.jpg" alt="Avatar" id="img"><br><br>
        
      </div>
      <br>
      <b><i><!--Role &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/ &emsp;--><?php echo $role ?></i></b>
      <br><br>
</div>

 <script type="text/javascript" src="vanilla-tilt.js"></script>
<script type="text/javascript">
  VanillaTilt.init(document.querySelectorAll(".box2"), {
    max: 2,
    speed: 10,
    scale: 1.05,
    glare: true,
    "max-glare" : 0.2
    

  });
</script>

</body>
</html>