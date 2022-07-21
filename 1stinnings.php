<?php 
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>1st INNINGS</title>
	<!-- <link rel="stylesheet" type="text/css" href="nouse.css"> -->
	<link rel="stylesheet" type="text/css" href="live.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
  <style>
     table{
        position:absolute;
        left:5%;
        right:5%;
     	margin-top: 26px;
        transform: :translate(-50%,-50%);
        border-collapse: collapse;
        width:90%;
        height:200px;
        border:1px solid #bcd3c7;
        box-shadow: 2px 2px 12px rgba(0,0,0,0.2),-1px -1px 8px rgba(0,0,0,0.2);

        background-color:#f5f5f5;

    }
    tr{
        transition: all .3s ease-in;
        height: 10px;
        padding:0;
       
    }
    th, td {
        padding: 0px;
        text-align: center;
        border-bottom: 1px solid #111;
        /*border-right: 1px solid #ddd;*/
        
    }
    #header{
        background-color: #16a085;
        color:#fff;
    }
    #video{
    position: fixed;
    right:0;
    bottom:0;
    min-width: 100%;
    min-height: 100%;
    z-index: -1;
  }

    /*.rows td:hover{
        background-color:#f5f5f5;
        transform: scale(1.02);
        opacity: 85%;
        box-shadow: 2px 2px 12px rgba(0,0,0,0.2),-1px -1px 8px rgba(0,0,0,0.3)
    }*/

    /*@media only screen and(max-width: 768px){
        table{
            width:90%;
        }
    }	*/	
    input{
      display: block;
    	background-color:#f5f5f5;
    	width:100px;
      height: 35px;
    	text-align: center;
      padding:0;
    }
    select{
      display: block;
    	background-color:#f5f5f5;
    	width:130px;
    }

    </style>
</head>




<body>
   <video autoplay muted loop id='video'><source src="live.mp4" type="video/mp4"></video>

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



<form action='' method='POST'>
	<table>
                          <tr id='header'>
                             <td>Batsman</td>
                            <td>Player State</td>
                            <td>Fours</td>
                            <td>Sixes</td>
                            <td>Balls</td>
                            <td>Runs</td>
                            <td> VERSUS</td>
                            <td>Bowler</td>
                            <td>Overs</td>
                            <td>Runs</td>
                            <td>Wickets</td>
                            <td>Extras</td>
                          </tr>

                          <?php 
                              include 'connection.php';
                                $match_id=$_SESSION['match_id'];
                                $t1=mysqli_query($con,"SELECT * from `matches_schedule` where match_id=$match_id;");
                                while($row=mysqli_fetch_assoc($t1)){
                                $tossNchoise=$row['tossNchoise'];
                                $teamx=$row['team_x'];
                                $teamy=$row['team_y'];
                                $match_overs=$row['overs'];
                              }
                              $Bat="/Bat/"; $teamxpat="/$teamx/"; $teamypat="/$teamy/"; $Bowl="/Bowl/";

                              if((preg_match($Bat, $tossNchoise) and preg_match($teamxpat, $tossNchoise)) or (preg_match($Bowl, $tossNchoise) and preg_match($teamypat, $tossNchoise))){
                                  $teambat=$teamx; $teambowl=$teamy;
                                }
                                else{
                                  $teambat=$teamy;  $teambowl=$teamx;
                                }
                                $str1="SELECT * from `batting_team` where match_id=$match_id and team_name='$teambat'";     $table1=mysqli_query($con,$str1);
                                $str2="SELECT * from `bowling_team` where match_id=$match_id and team_name='$teambowl'";     $table2=mysqli_query($con,$str2);

                          while($batsman=mysqli_fetch_assoc($table1) and $bowler=mysqli_fetch_assoc($table2)){
                            echo "<tr class='rows'>";
                            echo "<td style='display:none'><input type='number' name='id[]' value=".$batsman['id']."></td>";
                            echo "<td>".$batsman['player_name']."</td>";
                            echo "<td><select name='state[]'>
                              <option>".$batsman['player_state']."</option>
                              <option>NOT OUT</option>
                              <option>OUT</option>
                              <option>YET TO BAT</option>
                              </select></td>";
                              echo "<td><input type='number' name='fours[]' placeholder=".$batsman['fours']."></td>";
                            echo "<td><input type='number' name='sixes[]'' placeholder=".$batsman['sixes']."></td>";
                            echo "<td><input type='number' name='balls[]' placeholder=".$batsman['balls']."></td>";
                            echo "<td style='border-right: 1px solid #111;'><input type='number' name='runs[]' placeholder=".$batsman['runs']."></td>";
                            echo "<td style='border-bottom: 1px solid #f5f5f5;'></td>";                         
                           echo "<td style='display:none;'><input type='number' name='idb[]' value=".$bowler['id']."></td>";
                            echo "<td style='border-left: 1px solid #111;'>".$bowler['player_name']."</td>";
                            $o=(intdiv($bowler['overs'],6))+(($bowler['overs']%6)/10);
                              echo "<td><input type='number' name='overs[]' step='any' placeholder=".$o."></td>";
                           echo "<td><input type='number' name='runsgiven[]' placeholder=".$bowler['runsgiven']."></td>";
                            echo "<td><input type='number' name='wicks[]' placeholder=".$bowler['wicks']."></td>";
                            echo "<td><input type='number' name='extras[]' placeholder=".$bowler['extras']."></td>";
                              echo "</tr>";
                          }      
                      echo "<tr class='rows'>";
                            echo "<td style='display:none'><input type='number' name='id[]' value=".$batsman['id']."></td>";
                            echo "<td>".$batsman['player_name']."</td>";
                            echo "<td><select name='state[]'>
                              <option>".$batsman['player_state']."</option>
                              <option>NOT OUT</option>
                              <option>OUT</option>
                              <option>YET TO BAT</option>
                              </select></td>";
                              echo "<td><input type='number' name='fours[]' placeholder=".$batsman['fours']."></td>";
                            echo "<td><input type='number' name='sixes[]'' placeholder=".$batsman['sixes']."></td>";
                            echo "<td><input type='number' name='balls[]' placeholder=".$batsman['balls']."></td>";
                            echo "<td style='border-right: 1px solid #111;'><input type='number' name='runs[]' placeholder=".$batsman['runs']."></td>";                      
                            echo "<tr></tr>";
                          while($batsman=mysqli_fetch_assoc($table1)){
                            echo "<tr class='rows'>";
                            echo "<td style='display:none'><input type='number' name='id[]' value=".$batsman['id']."></td>";     
                            echo "<td>".$batsman['player_name']."</td>";
                            echo "<td><select name='state[]'>
                              <option>".$batsman['player_state']."</option>
                              <option>NOT OUT</option>
                              <option>OUT</option>
                              <option>YET TO BAT</option>
                              </select></td>";
                              echo "<td><input type='number' name='fours[]' placeholder=".$batsman['fours']."></td>";
                            echo "<td><input type='number' name='sixes[]'' placeholder=".$batsman['sixes']."></td>";
                            echo "<td><input type='number' name='balls[]' placeholder=".$batsman['balls']."></td>";
                            echo "<td style='border-right: 1px solid #111;'><input type='number' name='runs[]' placeholder=".$batsman['runs']."></td>";
                            echo "<td style='border-bottom: 1px solid #f5f5f5;'></td>";                         
                           echo "</tr>";                    
                          }
                          ?>                  
                          <tr class='rows'>
                            <td  style='border-bottom: 1px solid #f5f5f5;'></td>
                          	<td  style='border-bottom: 1px solid #f5f5f5;' ></td>
                            <td  style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td  style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td  style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td  style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td  style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td style="background: linear-gradient(-135deg, #000a02de, #1e7e34);color: white;">TEAM</td>
                            <td style="background: linear-gradient(-135deg, #000a02de, #1e7e34);color: white;">OVERS</td>
                          	<td style="background: linear-gradient(-135deg, #000a02de, #1e7e34);color: white;">RUNS</td>
                          	<td style="background: linear-gradient(-135deg, #000a02de, #1e7e34);color: white;">WICKETS</td>
                          	
                            
                            <td style="border-radius:10px;border-bottom: 1px solid #f5f5f5;"><input type="submit" name="update" value="UPDATE" style="background: linear-gradient(-135deg, #7d31e8ed, #4a1c93);color: white;border-radius:10px;"></td>          
                          </tr>
                           <tr class='rows'>
                            <td style='border-bottom: 1px solid #f5f5f5;'></td>
                          	<td style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td style='border-bottom: 1px solid #f5f5f5;'></td>
                            <td style='border-bottom: 1px solid #f5f5f5;'></td>
                      <td style="background: linear-gradient(-135deg, #000a02de, #1e7e34);color: white;">
                              <?php 
                                if($teambat=='India')echo   "<img style='width:54px;height544px' src='india.jpeg'>";
                                elseif($teambat=='England')   echo   "<img src='england.jpeg' style='teambatwidth:54px;height:54px'>";
                                elseif($teambat=='Australia')  echo   "<img src='australia.jpeg' style='width:54px;height:54px'>";
                                 else    echo   "<img src='westindies.jpeg' style='width54px;height:54px'>";
                               ?>
                            </td>
                            <?php  
                            $str4="CALL `calculate_score`($match_id, '$teambowl');";
                                $sql=mysqli_query($con,$str4);
                                $row=mysqli_fetch_assoc($sql);
                                $matchovers=$row['match_overs'];
                                $wickts=$row['wickts'];
                                $total_runs=$row['total_runs'];
                            ?>
                            <td style="background: linear-gradient(-135deg, #000a02de, #1e7e34);color: white;"><?php echo "$matchovers"; ?></td>
                          	<td style="background: linear-gradient(-135deg, #000a02de, #1e7e34);color: white;"><?php  echo "$total_runs"; ?></td>
                          	<td style="background: linear-gradient(-135deg, #000a02de, #1e7e34);color: white;"><?php  echo "$wickts"; ?></td>	
                          	<td style="border-radius:10px;"><input type="submit" name="next" value="NEXT" style="background: linear-gradient(-135deg, #7d31e8ed, #4a1c93);color: white;border-radius:10px;"></td>                            
                          </tr>
      </table>
  </form>

<?php  if(isset($_POST['next'])) echo "<script> location.href='2ndinnings.php'; </script>"; ?>
<?php 
    if($matchovers>=$match_overs){ echo "<script>alert('overs completed');</script>"; }
    if($wickts==10){ echo "<script>alert('all 10 Wickets out');</script>"; }
?>
<?php 
       include 'connection.php';
if(isset($_POST['update'])){ 
    $bcount=count($_POST['id']); $countb=count($_POST['idb']);
        if(($matchovers<$match_overs) and ($wickts<10)){        
              for($j=0;$j<$countb;$j++){
                $idb=$_POST['idb'][$j];  $overs=$_POST['overs'][$j];   $runsgiven=$_POST['runsgiven'][$j];   $wicks=$_POST['wicks'][$j];   $extras=$_POST['extras'][$j];

                if(isset($overs)){
                  $ob=((int)$overs)*6+($overs-(int)$overs)*10;
                  $strr="UPDATE `bowling_team` SET overs=$ob where match_id=$match_id and team_name='$teambowl' and id=$idb ";  
                  $sql=mysqli_query($con,$strr);
                }
                else{
                  $strr="UPDATE `bowling_team` SET overs=$overs where match_id=$match_id and team_name='$teambowl' and id=$idb ";  
                  $sql=mysqli_query($con,$strr);
                }


                if(isset($runsgiven)){
                  $str="UPDATE `bowling_team` SET runsgiven=$runsgiven where match_id=$match_id and team_name='$teambowl' and id=$idb ";   $sql=mysqli_query($con,$str);
                }
                if(isset($wicks)){
                  $str="UPDATE `bowling_team` SET wicks=$wicks where match_id=$match_id and team_name='$teambowl' and id=$idb ";     $sql=mysqli_query($con,$str);
                }
                if(isset($extras)){
                  $str="UPDATE `bowling_team` SET extras=$extras where match_id=$match_id and team_name='$teambowl' and id=$idb ";   $sql=mysqli_query($con,$str);
                }
              }
              for($i=0;$i<$bcount;$i++){
                $fours=$_POST['fours'][$i];  $sixes=$_POST['sixes'][$i];    $balls=$_POST['balls'][$i];  $runs=$_POST['runs'][$i];   $id=$_POST['id'][$i];  $player_state=$_POST['state'][$i];

                if(isset($runs)){
                  $str="UPDATE `batting_team` SET runs=$runs where match_id=$match_id and team_name='$teambat' and id=$id ";    $sql=mysqli_query($con,$str);
                }
                if($runs>=50 and $runs<100){
                  $str="UPDATE `batting_team` SET count=1 where match_id=$match_id and team_name='$teambat' and id=$id ";  $sql=mysqli_query($con,$str);
                }
                if($runs>=100){
                  $str="UPDATE `batting_team` SET count=2 where match_id=$match_id and team_name='$teambat' and id=$id ";    $sql=mysqli_query($con,$str);
                }
                if(isset($fours)){
                  $str="UPDATE `batting_team` SET fours=$fours where match_id=$match_id and team_name='$teambat' and id=$id ";  $sql=mysqli_query($con,$str);
                }
                if(isset($sixes)){
                  $str="UPDATE `batting_team` SET sixes=$sixes where match_id=$match_id and team_name='$teambat' and id=$id ";  $sql=mysqli_query($con,$str);
                }
                if(isset($balls)){
                  $str="UPDATE `batting_team` SET balls=$balls where match_id=$match_id and team_name='$teambat' and id=$id ";  $sql=mysqli_query($con,$str);
                }
                if(isset($player_state)){
                  $str="UPDATE `batting_team` SET player_state='$player_state' where match_id=$match_id and team_name='$teambat' and id=$id ";   $sql=mysqli_query($con,$str);
                }
              }
         echo "<meta http-equiv='refresh' content='0' url='1stinnings.php'>";        
    }
  }
?>
      


</body>
</html>
