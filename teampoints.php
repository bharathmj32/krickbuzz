<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Team Points</title>
	<link rel="stylesheet" type="text/css" href="teampoints.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
  <style type="text/css">
    .body{
    
    background-image: url('bg2.jpg');
    background-repeat: no-repeat;
    background-size: cover;
  }

  </style>
</head>
<body class='body'>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand active" href="home.html"><img src="logo.png" height="45" width="45"> KricBuzz</a>

 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="matches.php">Matches </a></li>
      <li class="nav-item active"><a class="nav-link" href="#">Team Points</a></li>
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

<div id="kontainer">
          <?php
          include 'connection.php';

          $sqlquery="SELECT * FROM team_points order by points desc";
          $resultquery=mysqli_query($con,$sqlquery);


                   echo "<table style='margin-top:50px'>
                          <tr id='header'>
                            <td>Flags</td>
                            <td>Name</td>
                            <td>Matches</td>
                            <td>Wins</td>
                            <td>Loss</td>
                            <td>Draws</td>
                            <td>Points</td>
                          </tr>";

              if(mysqli_num_rows($resultquery)>0)
              {
                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                    if($row['team_name']=='India')     echo   "<td><img style='width:54px;height54px' src='india.jpeg'></td>";
                    elseif($row['team_name']=='England')   echo   "<td><img src='england.jpeg' style='width:54px;height:54px'></td>";
                    elseif($row['team_name']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:54px;height:54px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:54px;height:54px'></td>";
                              
                    
                    echo   "<td>".$row['team_name']."</td>";
                    echo   "<td>".$row['no_matches']."</td>";
                    echo   "<td>".$row['wins']."</td>";
                    echo   "<td>".$row['loss']."</td>";
                    echo   "<td>".$row['draws']."</td>";
                    echo   "<td>".$row['points']."</td>";
                           
                    echo    "</tr>";
                }

              }
            
                  echo  "</table>"
            ?>
</div>
</body> 
</html>