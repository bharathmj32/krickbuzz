
<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Score Updations</title>
	<link rel="stylesheet" type="text/css" href="live.css">
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
        
        background-image: url('bg7.jpg');
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
      <li class="nav-item"><a class="nav-link" href="matches.php">Matches </a></li>
      <li class="nav-item"><a class="nav-link" href="teampoints.php">Team Points</a></li>
      <li class="nav-item"><a class="nav-link" href="records.php">Records</a></li>
      <li class="nav-item active"><a class="nav-link" href="#">Admin</a></li>
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









<div id="kontainer">
  <br>
      <div style="margin-left: 410px">
        <label  class='rd'><input type="radio" style="display: none;" name="forcommon" value="score" checked="">&emsp;Score Updations&emsp;</label>
      &emsp;&emsp;<label class='rd'><input type="radio" style="display: none;" name="forcommon" value="add_player">&emsp;Add New Player&emsp;</label>
      &emsp;&emsp;<label  class='rd'><input type="radio" style="display: none;" name="forcommon" value="match_scheduling">&emsp;Schedule a Match&emsp;</label>
      </div>  
<div class="score box">
           <div class="wrapper" >
                          <?php  
                          include 'connection.php';
                          $selectquery="SELECT * FROM matches_schedule  where status=2 order by`date` asc limit 1";
                          $resultquery=mysqli_query($con,$selectquery);
                          if(mysqli_num_rows($resultquery)==1)
                          {
                            while($row=mysqli_fetch_assoc($resultquery)){
                              $teamx=$row['team_x'];
                              $teamy=$row['team_y'];
                              $match_id=$row['match_id'];
                              $overs=$row['overs'];
                            }
                            $_SESSION['match_id']=$match_id;
                          }
                          else echo "NO Matches Scheduled";
                          ?>
                              <div class="title" style="background: linear-gradient(-135deg, #000a02de, #1e7e34)";><?php echo "$teamx"; ?> VS <?php echo "$teamy"; ?></div><br>
                                      <form action="" method="POST">
                                          <div class="input_field">
                                                                                      <label>Toss</label>
                                                                                      <div class="custom_select">
                                                                                            <select name="toss" required>
                                                                                              <option>Select</option>
                                                                                              <option ><?php echo "$teamx"; ?></option>
                                                                                              <option ><?php echo "$teamy"; ?></option>
                                                                                            </select>
                                                                                      </div>
                                                                                      <label>Choose To</label>
                                                                                      <div class="custom_select">
                                                                                            <select name="choise" required>
                                                                                              <option>Select</option>
                                                                                              <option>Bat</option>
                                                                                              <option>Bowl</option>
                                                                                            </select>
                                                                                      </div>
                                            </div>

                                          <div class="input_field" style="height:25%">
                                                                     <label>Select  <?php echo "$teamx"; ?> Batsmen</label>
                                                                     <div class="custom_select"style="height:90%;width:110%">
                                                                                            <select class="input" name="teamxbatsmen[]" multiple size="5" required="">
                                                                                <?php
                                                                                include 'connection.php';
                                                                                $sqlquery="SELECT * from player p where p.team='$teamx' and p.role like '%Batsman%' and p.role not like '%Bowler%'";
                                                                                $resultquery=mysqli_query($con,$sqlquery);
                                                                                    if(mysqli_num_rows($resultquery)>0){
                                                                                      while($row=mysqli_fetch_assoc($resultquery)){
                                                                                        echo "<option>".$row['name']."</option>";
                                                                                      }
                                                                                    }
                                                                                  ?>
                                                                                                                                                                                                                                 
                                                                                  </select>
                                                                         </div>
                                                                    <label>Select  <?php echo "$teamy"; ?> Batsmen</label>   //similar as above div to select teamy batsman
                                                                   <div class="custom_select"style="height:90%;width:110%">
                                                                                            <select class="input" name="teamybatsmen[]" multiple size="5" required="">
                                                                                            <?php
                                                                                            include 'connection.php';
                                                                                            $sqlquery="SELECT * from player p where p.team='$teamy' and p.role like '%Batsman%' and p.role not like '%Bowler%'";
                                                                                            $resultquery=mysqli_query($con,$sqlquery);
                                                                                                if(mysqli_num_rows($resultquery)>0){
                                                                                                  while($row=mysqli_fetch_assoc($resultquery)){
                                                                                                    echo "<option>".$row['name']."</option>";
                                                                                                  }
                                                                                                }
                                                                                              ?>                                                                  
                                                                                            </select>
                                                                          </div>
                                                </div>

                                                <div class="input_field" style="height:5%">
                                                                                      <label>Select  <?php echo "$teamx"; ?> All Rounders</label>
                                                                                      <div class="custom_select"style="height:90%">
                                                                                            <select class="input" name="teamxallrounders[]" multiple size="2" required>
                                                                                              <?php
                                                                                include 'connection.php';
                                                                                $sqlquery="SELECT * from player p where p.team='$teamx' and p.role like '%Allrounder%'";
                                                                                $resultquery=mysqli_query($con,$sqlquery);
                                                                                    if(mysqli_num_rows($resultquery)>0){
                                                                                      while($row=mysqli_fetch_assoc($resultquery)){
                                                                                        echo "<option>".$row['name']."</option>";
                                                                                      }
                                                                                    }
                                                                                  ?>                                  
                                                                                  </select>
                                                                                      </div>

                                                                                      <label>Select  <?php echo "$teamy"; ?> All Rounders</label>
                                                                                      <div class="custom_select" style="height:90%;width:120%">
                                                                                            <select class="input" name="teamyallrounders[]" multiple size="2" required>
                                                                                              <?php
                                                                                include 'connection.php';
                                                                                $sqlquery="SELECT * from player p where p.team='$teamy' and p.role like '%Allrounder%'";
                                                                                $resultquery=mysqli_query($con,$sqlquery);
                                                                                    if(mysqli_num_rows($resultquery)>0){
                                                                                      while($row=mysqli_fetch_assoc($resultquery)){
                                                                                        echo "<option>".$row['name']."</option>";
                                                                                      }
                                                                                    }
                                                                                  ?>

                                                                                            </select>
                                                                                    </div>
                                                </div>

          
                                                        <div class="input_field" style="height:25%">
                                                                                      <label>Select  <?php echo "$teamx"; ?> Bowlers</label>
                                                                                      <div class="custom_select"style="height:90%">
                                                                                            <select class="input" name="teamxbowlers[]" multiple size="4" required>
                                                              <?php
                                                                                include 'connection.php';
                                                                                $sqlquery="SELECT * from player p where p.team='$teamx' and p.role like '%Bowler%' and p.role not like '%Batsman%'";
                                                                                $resultquery=mysqli_query($con,$sqlquery);
                                                                                    if(mysqli_num_rows($resultquery)>0){
                                                                                      while($row=mysqli_fetch_assoc($resultquery)){
                                                                                        echo "<option>".$row['name']."</option>";
                                                                                      }
                                                                                    }
                                                                                  ?>                                  
                                                                                  </select>
                                                                                      </div>

                                                                                      <label>Select  <?php echo "$teamy"; ?> Bowlers</label>
                                                                                      <div class="custom_select" style="height:90%;width:120%">
                                                                                            <select class="input" name="teamybowlers[]" multiple size="4" required>
                                                                                              <?php
                                                                                include 'connection.php';
                                                                                $sqlquery="SELECT * from player p where p.team='$teamy' and p.role like '%Bowler%' and p.role not like '%Batsman%'";
                                                                                $resultquery=mysqli_query($con,$sqlquery);
                                                                                    if(mysqli_num_rows($resultquery)>0){
                                                                                      while($row=mysqli_fetch_assoc($resultquery)){
                                                                                        echo "<option>".$row['name']."</option>";
                                                                                      }
                                                                                    }
                                                                                  ?>

                                                                                            </select>
                                                                                    </div>
                                                        </div>
                                                        <br>

                                                        <div class="input_field">
                                                          <input type="submit" name="submitforlive" value="Start Match" class="btn" style="background: linear-gradient(-135deg, #000a02de, #1e7e34)";>
                                                        </div>          
                                           

                                        </form>                      
                                      <?php
                                        
                                            include('connection.php');
                                            if(isset($_POST['submitforlive']))
                                            {             
                                          $toss=$_POST['toss'];
                                          $choise=$_POST['choise'];
                                          $teamybatsmen=$_POST['teamybatsmen'];
                                          $teamxbatsmen=$_POST['teamxbatsmen'];
                                          $teamxbowlers=$_POST['teamxbowlers'];
                                           $teamybowlers=$_POST['teamybowlers'];
                                           $teamxallrounders=$_POST['teamxallrounders'];
                                           $teamyallrounders=$_POST['teamyallrounders'];
                                          
                                            $sqll=mysqli_query($con,"UPDATE `matches_schedule` set `tossNchoise`='$toss$choise' where `match_id`=$match_id");
                                            mysqli_query($con,"UPDATE `team_points` set no_matches=no_matches+1 where team_name='$teamx'");
                                            mysqli_query($con,"UPDATE `team_points` set no_matches=no_matches+1 where team_name='$teamy'");
                                            mysqli_query($con,"UPDATE matches_schedule set status=1 where match_id='$match_id'");

                                           foreach ($teamxbatsmen as $name) {
                                              $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT p.id from player p where p.name = '$name'"));
                                              $id=$row['id'];
                                              $str2="INSERT into `batting_team` (player_name,id,team_name,match_id,player_state) values('$name','$id','$teamx','$match_id','YET TO BAT')";
                                                 mysqli_query($con,$str2);

                                                 mysqli_query($con,"UPDATE player_stats set matches_played=matches_played+1 where stat_id=$id");
                                              }
                                           foreach ($teamybatsmen as $name) {
                                              $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT p.id from player p where p.name = '$name'"));
                                              $id=$row['id'];
                                               
                                              $str2="INSERT into `batting_team` (player_name,id,team_name,match_id,player_state) values('$name','$id','$teamy','$match_id','YET TO BAT')";
                                                 mysqli_query($con,$str2);
                                                 mysqli_query($con,"UPDATE player_stats set matches_played=matches_played+1 where stat_id=$id");
                                            } //simialr code snipet to insert teamy batsman

                                           foreach ($teamxallrounders as $name) {
                                                  $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT p.id from player p where p.name = '$name'"));
                                                $id=$row['id'];
                                                 
                                                $str2="INSERT into `batting_team` (player_name,id,team_name,match_id,player_state) values('$name','$id','$teamx','$match_id','YET TO BAT')";
                                                   mysqli_query($con,$str2);
                                                $str3="INSERT into `bowling_team` (player_name,id,team_name,match_id) values('$name','$id','$teamx','$match_id')";
                                                mysqli_query($con,$str3);
                                                mysqli_query($con,"UPDATE player_stats set matches_played=matches_played+1 where stat_id=$id");
                                               }
                                               foreach ($teamyallrounders as $name) {
                                              $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT p.id from player p where p.name = '$name'"));
                                                  $id=$row['id'];
                                                   
                                                  $str2="INSERT into `batting_team` (player_name,id,team_name,match_id,player_state) values('$name','$id','$teamy','$match_id','YET TO BAT')";
                                                     mysqli_query($con,$str2);
                                                  $str3="INSERT into `bowling_team` (player_name,id,team_name,match_id) values('$name','$id','$teamy','$match_id')";
                                                  $table=mysqli_query($con,$str3);
                                                  mysqli_query($con,"UPDATE player_stats set matches_played=matches_played+1 where stat_id=$id");
                                               } // simialr code snipet to insert teamy allrounder


                                        foreach ($teamxbowlers as $name) {
                                                $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT p.id from player p where p.name = '$name'"));
                                              $id=$row['id'];
                                               
                                              $str2="INSERT into `batting_team` (player_name,id,team_name,match_id,player_state) values('$name','$id','$teamx','$match_id','YET TO BAT')";
                                                 mysqli_query($con,$str2);
                                              $str3="INSERT into `bowling_team` (player_name,id,team_name,match_id) values('$name','$id','$teamx','$match_id')";
                                              mysqli_query($con,$str3);
                                              mysqli_query($con,"UPDATE player_stats set matches_played=matches_played+1 where stat_id=$id");
                                             }

                                       foreach ($teamybowlers as $name) {
                                              $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT p.id from player p where p.name = '$name'"));
                                                $id=$row['id'];
                                                 
                                                $str2="INSERT into `batting_team` (player_name,id,team_name,match_id,player_state) values('$name','$id','$teamy','$match_id','YET TO BAT')";
                                                   mysqli_query($con,$str2);
                                                $str3="INSERT into `bowling_team` (player_name,id,team_name,match_id) values('$name','$id','$teamy','$match_id')";
                                                $table=mysqli_query($con,$str3);
                                                 mysqli_query($con,"UPDATE player_stats set matches_played=matches_played+1 where stat_id=$id");
                                               }
                                             echo "<script> location.href='1stinnings.php'; </script>";
                                              } // similar code to insert teamy bowler
                                        
                                    ?>   


                                        
                                        

                         </div>
                      
                            
      </div>













      <div class="add_player box">
                            <div class="wrapper" >
                                                      <div class="title" style="background: linear-gradient(-135deg, #000a02de, #1e7e34)";>Add Player</div><br>
                                                  <form action="" method="POST">
                                                        <div class="input_field">
                                                          <label>Enter Name</label>
                                                          <input type="text" class="input" required="*" name="playername">
                                                        </div>
                                                        <div class="input_field">
                                                          <label>Select Team</label>
                                                          <div class="custom_select">
                                                            <select name="team">
                                                              <option value=" ">Select</option>
                                                              <option value="India">India</option>
                                                              <option value="Australia">Australia</option>
                                                              <option value="England">England</option>
                                                              <option value="West Indies">West Indies</option>
                                                            </select>
                                                          </div>
                                                        </div>
                                                        <div class="input_field">
                                                          <label>Enter Role</label>
                                                          <input type="text" class="input" required="*" name="role">
                                                        </div>
                                                        <div class="input_field">
                                                          <label>Matches Played</label>
                                                          <input type="number" class="input" required="*" name="matches">
                                                          <label>Highest Score</label>
                                                          <input type="number" class="input" required="*" name="highscore">

                                                        </div>
                                                        <div class="input_field">
                                                          <label>Runs scored</label>
                                                          <input type="number" class="input" required="*" name="runs">
                                                      
                                                          <label>Wickets</label>
                                                          <input type="number" class="input" required="*"name="Wickets">
                                                        </div>
                                                        <div class="input_field">
                                                          <label>Balls Faced</label>
                                                          <input type="number" class="input" required="*"name="ballsfaced">
                                                      
                                                          <label>Overs</label>
                                                          <input type="number" class="input" required="*"name="overs">
                                                        </div>
                                                        <div class="input_field">
                                                          <label>50's</label>
                                                          <input type="number" class="input" required="*"name="50s">
                                                      
                                                          <label>Runs given</label>
                                                          <input type="number" class="input" required="*"name="runsgiven">
                                                        </div>
                                                        <div class="input_field">
                                                          <label>100's</label>
                                                          <input type="number" class="input" required="*"name="100s">
                                                      
                                                          <label>Highest Wickets</label>
                                                          <input type="number" class="input" required="*"name="highestwickets">
                                                        </div>
                                                        <div class="input_field">
                                                          <input type="submit" name="submitplayer" value="Add" class="btn" style="background: linear-gradient(-135deg, #000a02de, #1e7e34)";>
                                                        </div>
                                                      </form>   
                                  <?php
                                    include('connection.php');
                                    if(isset($_POST['submitplayer']))
                                    {
                                      $name = $_POST['playername'];
                                      $team = $_POST['team'];
                                      $role = $_POST['role'];
                                      $matches = $_POST['matches'];
                                      $highscore = $_POST['highscore'];
                                      $runs = $_POST['runs'];
                                      $wickets = $_POST['wickets'];
                                      $ballsfaced = $_POST['ballsfaced'];
                                      $overs = $_POST['overs'];
                                      $f50s = $_POST['50s'];
                                      $runsgiven = $_POST['runsgiven'];
                                      $h100s = $_POST['100s'];
                                      $highestwickets = $_POST['highestwickets'];
                                      

                                        $string1 =  "INSERT into player (name,team,role) values('$name','$team','$role')";
                                        $sql = mysqli_query($con,$string1);


                                        $string2="SELECT p.id from player p where p.name = '$name'";
                                        $result=mysqli_query($con,$string2);
                                        $row=mysqli_fetch_assoc($result);
                                        $id=$row['id'];


                                        $string3="INSERT into player_stats (stat_id,matches_played,runs_scored,balls_faced,50s,100s,highest_score,balls_bowled,runs_given,wickets,highest_wickets) values('$id','$matches','$runs','$ballsfaced','$f50s','$h100s','$highscore','$overs*6','$runsgiven','$wickets','$highestwickets')";
                                        $sql2 = mysqli_query($con,$string3);

                                        if($sql and $sql2){
                                          echo "<h2>Added successfully</h2>";
                                          header('Location: live.php');
                                        }
                                        else{
                                          echo "<h2>Error occurred while adding</h2>";
                                          header('Location: live.php');
                                        }
                                    }
                                    ?>
                            </div>

      </div>

      <div class="match_scheduling box">
        <style type="text/css">.nn{height:480px;}</style>
                          <div class="wrapper nn">
                                        <div class="title" style="background: linear-gradient(-135deg, #000a02de, #1e7e34)";>Match Scheduling</div><br>
                                          <form action=" " method="POST">
                                          <div class="input_field">
                                            <label>Select Team </label>
                                            <div class="custom_select">
                                              <select name="teamx" required>
                                                
                                                <option value="India">India</option>
                                                <option value="Australia">Australia</option>
                                                <option value="England">England</option>
                                                <option value="West Indies">West Indies</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="input_field">
                                            <label>Select Team </label>
                                            <div class="custom_select">
                                              <select name="teamy" required>
                                                
                                                <option value="India">India</option>
                                                <option value="Australia">Australia</option>
                                                <option value="England">England</option>
                                                <option value="West Indies">West Indies</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="input_field">
                                            <label>Schedule Date</label>
                                            <input type="date" class="input" required name="date">
                                          </div>
                                          <div class="input_field">
                                            <label>Schedule Time</label>
                                            <input type="time" class="input" required name="time">
                                          </div>
                                          <div class="input_field">
                                                          <label>Match Overs</label>
                                                          <input type="number" class="input" required name="overs">


                                            </div>
                                          <div class="input_field">
                                            <input type="submit" name="submitmatch" value="Submit" class="btn" style="background: linear-gradient(-135deg, #000a02de, #1e7e34)";>
                                          </div>
                                        </form>   
                                        <?php 
                                        

                                        if(isset($_POST['submitmatch']))  
                                        {
                                          include 'connection.php';
                                        $teamx=$_POST['teamx'];
                                        $teamy=$_POST['teamy'];
                                        $date=$_POST['date'];
                                        $time=$_POST['time'];
                                        $overs=$_POST['overs'];
                                          $string="INSERT into matches_schedule (team_x,team_y,`date`,`time`,overs) values('$teamx','$teamy','$date','$time','$overs')";
                                          $result=mysqli_query($con,$string);

                                        
                                        if($result){
                                          header('Location : live.php');
                                        }
                                        else{
                                          echo "<h1>Match Scheduling Falied</h1>";
                                        }

                                      }
                                         ?>

                            </div>
      </div>
































</div>

</body>
</html>