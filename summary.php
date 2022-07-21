<!DOCTYPE html>
<html>
<head>
	<title>Summary</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="summary.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
                                                                                                                  
    <script type="text/javascript">                                                                         
            $(document).ready(function() { 
                $('input[type="radio"]').click(function() { 
                    var inputValue = $(this).attr("value"); 
                    var targetBox = $("." + inputValue); 
                    $(".box").not(targetBox).hide(); 
                    $(targetBox).show(); 
                }); 
            }); 
    </script>
  <style>
      .boxx{
          padding:10px;
          padding-left: 115px;
          box-shadow: 0px 15px 20px rgba(0,0,0,0.6);
          border-radius: 8px;
          transform-style: preserve-3d;
          margin-right: 5%;
           width: 75.8%;
          margin-bottom: 1%;
          margin-left: 11%;
          background: linear-gradient(-180deg, rgb(210 220 66 / 92%), rgb(255 66 10));
            
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
          font-size: 24px;
          font-weight: bold;
          color:white;
          text-shadow: 0px 0px 1px pink;
         }

         .p2{
          transform: translateZ(40px);
          font-family: sans-serif;
          font-size: 18px;
          font-weight: bold;
          padding-left: 10px;
          color:pink;
          text-shadow: 0px 0px 2px red;
         }
      body{
    
    background-image: url('bg11.jpg');
    background-repeat: no-repeat;
    background-size: cover;
  }
  .rd{
    background: linear-gradient(-135deg, #7d31e8ed, #4a1c93);
    color: white;
    border-radius:10px;
    cursor:pointer
  }
  .rd:hover{
    color:white;
    background:linear-gradient(-135deg, #fa0ceb, #fa0ceb33);
    transform: scale(1.1,1.1);
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
      <li class="nav-item active"><a class="nav-link" href="matches.php">Matches </a></li>
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
    $match_id=$_GET['match_id'];
    include 'connection.php';
    $selectquery="SELECT * FROM matches_schedule where match_id=$match_id";
    $resultquery=mysqli_query($con,$selectquery);
    $row=mysqli_fetch_assoc($resultquery);
     ?>

		<div class="kontainer boxx">
			<span> <?php  
              if($row['status']==1) echo "<p class='p0'>LIVE</p>"; 
        if($row['status']==2)  echo "<p class='p0'>SCHEDULED <span style='margin-left:120px'>".$row['date']."</span></p>";
         if($row['status']==3) echo "<p class='p0'>RESULT <span style='margin-left:120px'>".$row['date']."</span></p>";

         ?> </span>

			<?php 
            
      
                              
         echo "<div style='transform: translateZ(20px)'>";

          if($row['team_x']=='India')           echo   "<img  class='img' style='width:24px;height:24px;transform: translateZ(30px)' src='india.jpeg'>&emsp;<span class='p11'>India</span>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";
          elseif($row['team_x']=='England')     echo "<img  class='img' src='england.jpeg' style='width:24px;height:24px;transform: translateZ(30px)'>&emsp;<span class='p11'>England</span>&emsp;&emsp;&emsp;&emsp;&emsp;";
          elseif($row['team_x']=='Australia') echo "<img class='img'  src='australia.jpeg' style='width:24px;height:24px;transform: translateZ(30px)'>&emsp;<span class='p11'>Australia</span>&emsp;&emsp;&emsp;&emsp;";
          else                                   echo   "<img  class='img' src='westindies.jpeg' style='width:30px;height:24px;transform: translateZ(30px);'>&emsp;<span class='p11'>West Indies</span>&emsp;&emsp;&emsp;";

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
              echo "</div><br>";         

                            

          
             if($row['status']==2) echo "<p class='p2'>The Match is scheduled on ".$row['date']."</span> at <span>".$row['time']."</span> </p>";
            if($row['status']==3) {
              if($row['winner']==$row['team_x']) echo "<p class= 'p2'  >".$row['team_x']. " won the match</p>";
              elseif($row['winner']==$row['team_y']) echo "<p  class= 'p2' >".$row['team_y']. " won the match</p>";
              else echo "<p class='p2' '>Match has been Tied</p>";
            }
            if($row['status']==1){
              echo "<p class='p2' >Live Scores appear On updations by the admin</p>";
            }              //SIMILARLY AS ABOVE DIV TAG TO DISPLAY TEAM_Y MATCH FIGURES

       ?>


		
			<label class='rd'><input type="radio" name="hideOrShow" value="teamx_batting" checked style="display: none;"/>&emsp;<?php echo $row['team_x'] ?> batting&emsp;</label>&emsp;&emsp;  <label class='rd' ><input type="radio" name="hideOrShow" value="teamx_bowling" style="display: none;" />&emsp;<?php echo $row['team_x']; ?> bowling&emsp;</label>&emsp;&emsp;
			<label class='rd'><input type="radio" name="hideOrShow" value="teamy_batting" style="display: none;" />&emsp;<?php echo $row['team_y']; ?> batting&emsp;</label>&emsp;&emsp;
			<label class='rd'><input type="radio" name="hideOrShow" value="teamy_bowling"style="display: none;" />&emsp;<?php echo $row['team_y']; ?> bowling&emsp;</label>
		</div>
		
		<div class="teamx_batting box">                                                                                   
			<table>
                          <tr id="header">
                            <td>Batsman</td>
                            <td>State</td>
                            <td>Runs</td>
                            <td>Balls</td>
                            <td>Fours</td>
                            <td>Sixes</td>           
                            <td>Strike Rate</td>
                          </tr>

                          <?php 
                          $team=$row['team_x'];
                            $str="SELECT *  from batting_team where match_id=$match_id and team_name='$team'";
                            $table=mysqli_query($con,$str);
                            if(mysqli_num_rows($table)>0)
                            {
                              while($array=mysqli_fetch_assoc($table))
                              {
                                echo "<tr class='rows'>";
                                  echo   "<td>".$array['player_name']."</td>";
                                  echo   "<td>".$array['player_state']."</td>";
                                  echo   "<td>".$array['runs']."</td>";
                                  echo  "<td>".$array['balls']."</td>";
                                  echo   "<td>".$array['fours']."</td>";
                                  echo   "<td>".$array['sixes']."</td>";
                                  if($array['balls']!=0){
                                  $sr=(($array['runs']/$array['balls'])*100);
                                  echo   "<td>".number_format($sr,2,'.','')."</td>";
                                  }
                                  else echo "<td>Nill</td>";

                                  
                                  echo    "</tr>";
                              }

                            }

                           ?>

                    </table>
		</div>


    
		<div class="teamx_bowling box">
			<table>
                          <tr id="header">
                            <td>Bowler</td>
                            <td>Overs</td>
                            <td>Runs</td>
                            <td>Wickets</td>
                            <td>Extras</td>
                            <td>Economy</td>
                          </tr>

                          <?php 
                           $team=$row['team_x'];
                            $str="SELECT *  from bowling_team where match_id=$match_id and team_name='$team'";
                            $table=mysqli_query($con,$str);
                            if(mysqli_num_rows($table)>0)
                            {
                              while($array=mysqli_fetch_assoc($table))
                              {
                                echo "<tr class='rows'>";
                                  echo   "<td>".$array['player_name']."</td>";
                                   $ov=(intdiv($array['overs'],6))+(($array['overs']%6)/10);
                                  echo   "<td>".$ov."</td>";
                                  echo   "<td>".$array['runsgiven']."</td>";
                                  echo   "<td>".$array['wicks']."</td>";
                                  echo   "<td>".$array['extras']."</td>";
                                  if($array['overs']!=0){
                                  $ec=($array['runsgiven']+$array['extras'])/$ov;
                                  echo   "<td>".number_format($ec,2,'.','')."</td>";
                                }
                                else echo "<td>Nill</td>";
                                  echo    "</tr>";
                              }

                            }

                           ?>

                          


                    </table>
		</div>
		<div class="teamy_batting box">
			<table>
                          <tr id="header">
                            <td>Batsman</td>
                            <td>State</td>
                            <td>Runs</td>
                            <td>Balls</td>
                            <td>Fours</td>
                            <td>Sixes</td>           
                            <td>Strike Rate</td>
                          </tr>

                          <?php 
                          $team=$row['team_y'];
                            $str="SELECT *  from batting_team where match_id=$match_id and team_name='$team'";
                            $table=mysqli_query($con,$str);
                            if(mysqli_num_rows($table)>0)
                            {
                              while($array=mysqli_fetch_assoc($table))
                              {
                                echo "<tr class='rows'>";
                                  echo   "<td>".$array['player_name']."</td>";
                                  echo   "<td>".$array['player_state']."</td>";
                                  echo   "<td>".$array['runs']."</td>";
                                  echo  "<td>".$array['balls']."</td>";
                                  echo   "<td>".$array['fours']."</td>";
                                  echo   "<td>".$array['sixes']."</td>";
                                  if($array['balls']!=0){
                                  $sr=(($array['runs']/$array['balls'])*100);
                                  echo   "<td>".number_format($sr,2,'.','')."</td>";
                                  }
                                  else echo "<td>Nill</td>";

                                  
                                  echo    "</tr>";
                              }

                            }

                           ?>



                          
        </table>

		</div>
		<div class="teamy_bowling box">
			<table>
                          <tr id="header">
                            <td>Bowler</td>
                            <td>Overs</td>
                            <td>Runs</td>
                            <td>Wickets</td>
                            <td>Extras</td>
                            <td>Economy</td>
                          </tr>

                         <?php 
                          $team=$row['team_y'];
                            $str="SELECT *  from bowling_team where match_id=$match_id and team_name='$team'";
                            $table=mysqli_query($con,$str);
                            if(mysqli_num_rows($table)>0)
                            {
                              while($array=mysqli_fetch_assoc($table))
                              {
                                echo "<tr class='rows'>";
                                  echo   "<td>".$array['player_name']."</td>";
                                  $ov=(intdiv($array['overs'],6))+(($array['overs']%6)/10);
                                  echo   "<td>".$ov."</td>";
                                  echo   "<td>".$array['runsgiven']."</td>";
                                  echo   "<td>".$array['wicks']."</td>";
                                  echo   "<td>".$array['extras']."</td>";
                                  if($array['overs']!=0){
                                  $ec=($array['runsgiven']+$array['extras'])/$ov;
                                  echo   "<td>".number_format($ec,2,'.','')."</td>";
                                  }
                                  else echo "<td>Nill</td>";
                                  echo    "</tr>";
                              }

                            }

                           ?>
                    </table>
		</div>
</div>
<!-- <?php  echo "<meta http-equiv='refresh' content='10' url='matches.php'>"; ?> -->

<script type="text/javascript" src="vanilla-tilt.js"></script>
<script type="text/javascript">
  VanillaTilt.init(document.querySelectorAll(".boxx"), {
    max: 1,
    speed: 100,
    glare:true,
    "max-glare":0.2,
    scale:1
  });

</script>
</body>
</html>