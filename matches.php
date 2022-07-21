<!DOCTYPE html>
<html>
<head>
	<title>Matches</title>
	
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
  <link rel="stylesheet" type="text/css" href="matches.css">



  <style type="text/css">
        body{background-image: url('bg12.jpg');background-repeat: no-repeat;background-size: cover; }
         .img{width: 28px;height:28px;}

        
        .box{
          padding:10px;
          padding-left: 50px;
          box-shadow: 0px 15px 20px rgba(0,0,0,0.6);
          border-radius: 8px;
          transform-style: preserve-3d;
          margin-right: 5%;
            width: 40%;
            float: left;
            margin-left:5%;
            margin-bottom: 60px;
            
         }
         .p0{
          transform: :translateZ(16px);
          font-family: sans-serif;
          font-weight: bold;
          font-size: 20px;
          
         }
         .p11{
          transform: translateZ(20px);
          font-family: sans-serif;
          font-size: 17px;
          font-weight: bold;
          color:white;
        
         }
         .p1{
          transform: translateZ(20px);
          font-family: cursive;
          font-size: 14px;
          font-weight: bold;
          color:white;
          text-shadow: 0px 0px 1px pink;
         }

         .p2{
          transform: translateZ(40px);
          font-family: sans-serif;
          font-size: 15px;
          font-weight: bold;

          color:pink;
          text-shadow: 0px 0px 2px red;
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
      <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
      <li class="nav-item active"><a class="nav-link" href="#">Matches </a></li>
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



<div id="kontainer">


<?php  
include 'connection.php';
$selectquery="SELECT * FROM matches_schedule order by status asc,`date` asc,`time` asc";
$resultquery=mysqli_query($con,$selectquery);
if(mysqli_num_rows($resultquery)>0)
{
	while($row=mysqli_fetch_assoc($resultquery))
	{
    if($row['status']==1) $bg='background: linear-gradient(-180deg, rgb(70 62 199 / 55%), rgb(189 33 48 / 82%));';
    if($row['status']==2) $bg='background: linear-gradient(-180deg, rgb(30 126 52 / 49%), rgb(0 98 204 / 75%))';
    if($row['status']==3) $bg='background: linear-gradient(-180deg, rgb(210 220 66 / 92%), rgb(255 66 10))';

    echo "<a href='summary.php?match_id=".$row['match_id']."' style='text-decoration:none;color:inherit;'>";
    echo "<div class='box kontainer' style='".$bg."''>";
  		
  		  if($row['status']==1) echo "<p class='p0'>LIVE</p>"; 
        if($row['status']==2)  echo "<p class='p0'>SCHEDULED <span style='margin-left:120px'>".$row['date']."</span></p>";
         if($row['status']==3) echo "<p class='p0'>RESULT <span style='margin-left:120px'>".$row['date']."</span></p>";

             
                           
         echo "<div style='transform: translateZ(20px)'>";

		 			if($row['team_x']=='India') 		      echo   "<img  class='img' style='width:24px;height:24px;transform: translateZ(30px)' src='india.jpeg'>&emsp;<span class='p11'>India</span>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";
		 			elseif($row['team_x']=='England') 	  echo "<img  class='img' src='england.jpeg' style='width:24px;height:24px;transform: translateZ(30px)'>&emsp;<span class='p11'>England</span>&emsp;&emsp;&emsp;&emsp;&emsp;";
		 			elseif($row['team_x']=='Australia') echo "<img class='img'  src='australia.jpeg' style='width:24px;height:24px;transform: translateZ(30px)'>&emsp;<span class='p11'>Australia</span>&emsp;&emsp;&emsp;&emsp;";
		 			else 							                  	 echo   "<img  class='img' src='westindies.jpeg' style='width:30px;height:24px;transform: translateZ(30px);'>&emsp;<span class='p11'>West Indies</span>&emsp;&emsp;&emsp;";

					             if($row['status']==1 or $row['status']==3)   {
                                $id=$row['match_id'];
                                $team=$row['team_y'];

                                $str4="CALL `calculate_score`($id,'$team')";
                                $sql=mysqli_query($con,$str4);
                                $roww=mysqli_fetch_assoc($sql);
                                $matchovers=$roww['match_overs'];
                                $wickts=$roww['wickts'];
                                $total_runs=$roww['total_runs'];

                                echo "<span class='p1' style='transform: translateZ(20px)'>Overs:-".$matchovers."/".$row['overs']."&emsp;Runs:-".$total_runs."&emsp;Wickets:-".$wickts."</span>";
                            
                        }  
                 echo "</div>";         


					echo "<div style='transform: translateZ(20px)'>";

         if($row['team_y']=='India')          echo   "<img  class='img' style='width:24px;height:24px;transform: translateZ(30px)' src='india.jpeg'>&emsp;<span class='p11'>India</span>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";
          elseif($row['team_y']=='England')     echo "<img  class='img' src='england.jpeg' style='width:24px;height:24px;transform: translateZ(30px)'>&emsp;<span class='p11'>England</span>&emsp;&emsp;&emsp;&emsp;&emsp;";
          elseif($row['team_y']=='Australia') echo "<img class='img'  src='australia.jpeg' style='width:24px;height:24px;transform: translateZ(30px)'>&emsp;<span class='p11'>Australia</span>&emsp;&emsp;&emsp;&emsp;";
          else                                   echo   "<img  class='img' src='westindies.jpeg' style='width:30px;height:24px;transform: translateZ(30px);'>&emsp;<span class='p11'>West Indies</span>&emsp;&emsp;&emsp;";
                        if($row['status']==1 or $row['status']==3)   {
                                mysqli_next_result($con);
                                $id=$row['match_id'];
                                $team=$row['team_x'];

                                $str4="CALL `calculate_score`($id,'$team')";
                                $sql=mysqli_query($con,$str4);
                                $roww=mysqli_fetch_assoc($sql);
                                $matchovers=$roww['match_overs'];
                                $wickts=$roww['wickts'];
                                $total_runs=$roww['total_runs'];
                                mysqli_next_result($con);

                                echo "<span class='p1'>Overs:-".$matchovers."/".$row['overs']."&emsp;Runs:-".$total_runs."&emsp;Wickets:-".$wickts."</span>";
                            
                        }  
              echo "</div>";         

            
            if($row['status']==2) echo "<p class='p2' style='text-align:center;'>The Match is scheduled on ".$row['date']."</span> at <span>".$row['time']."</span> </p>";

            if($row['status']==3) {
              if($row['winner']==$row['team_x']) echo "<p class= 'p2'  style='text-align:center;'>".$row['team_x']. " won the match</p>";
              elseif($row['winner']==$row['team_y']) echo "<p  class= 'p2' style='text-align:center;'>".$row['team_y']. " won the match</p>";
              else echo "<p class='p2' style='text-align:center;'>Match has been Tied</p>";
            }


            if($row['status']==1){
              echo "<p class='p2' style='text-align:center;'>The Match is live,Click Card For Match Summary</p>";
            }
            
				echo  '</div>';
        echo "</a>";
		 
	}
}

?>
<?php  echo "<meta http-equiv='refresh' content='5' url='matches.php'>"; 
        ?>
<script type="text/javascript" src="vanilla-tilt.js"></script>
<script type="text/javascript">
  VanillaTilt.init(document.querySelectorAll(".box"), {
    max: 15,
    speed: 100,
    glare:true,
    scale:1.1
  });

</script>


</body>
</html>