<!DOCTYPE html>
<html>
<head>
	<title>Records</title>
	<link rel="stylesheet" type="text/css" href="records.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap.js"></script>


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

   

<style type="text/css">
            *{
            padding:0;
            margin:0;
          }
          body{
           
    position: relative;
    background-image: url('bg7.jpg');
    background-repeat: no-repeat;
    background-size: cover;
 
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

          table{
              position:absolute;
              left:25%;
              right:15%;
              transform: :translate(-50%,-50%);
              border-collapse: collapse;
              width:70%;
              height:150px;
              border:1px solid #bcd3c7;
              box-shadow: 2px 2px 12px rgba(0,0,0,0.2),-1px -1px 8px rgba(0,0,0,0.2);

              background-color:#f5f5f5;
          }
          tr{
              transition: all .3s ease-in;
              /*cursor:pointer;*/
          }
          th,td{
              padding:0px;
              text-align:center;
              border-bottom:1px solid #ddd;
              border-right: 1px solid #ddd;
          }
          .header{

              background-color: #16a085;
              color:#fff;
              padding:50px;
              height:40px;
          }


          .rows:hover{
              background-color:#f5f5f5;
              transform: scale(1.02);
              box-shadow: 2px 2px 12px rgba(0,0,0,0.2),-1px -1px 8px rgba(0,0,0,0.3)
          }

          @media only screen and(max-width: 768px){
              table{
                  width:90%;
              }
          }

          .box{
              display:none;
          }
          .MostRuns{
              display: block;
          }



          #leftbox{
            width:15%;
            float: left;
            margin-left:3%;
          }

          #rightbox{
            width:50%;
            float:left;
          }
          label{
            float:top;
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
      <li class="nav-item active"><a class="nav-link" href="#">Records</a></li>
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
  <div id="leftbox">
    <br>
      <label class='rd'>&emsp;<input type="radio" style="display: none;" name="hideOrShow" value="MostRuns" checked/>&emsp;Most Runs&emsp;&emsp;&emsp;</label>
      <br><br>
      <label class='rd'>&emsp;<input type="radio" style="display: none;" name="hideOrShow" value="HighestScore"/>&emsp;Highest Scorers&emsp;</label>
      <br><br>
      <label class='rd'>&emsp;<input type="radio" style="display: none;" name="hideOrShow" value="Most100s"/>&emsp;Most Hundreds&emsp;</label>
      <br><br>
      <label  class='rd'>&emsp;<input type="radio" style="display: none;" name="hideOrShow" value="Most50s"/>&emsp;Most Fifties&emsp;&emsp;&emsp;</label>
      <br><br>
      <label  class='rd'>&emsp;<input type="radio" style="display: none;" name="hideOrShow" value="MostWickets"/>&emsp;Most Wickets&emsp;&emsp;</label>
      <br><br>
      <label class='rd'>&emsp;<input type="radio" style="display: none;" name="hideOrShow" value="HighestWickets"/>&emsp;Highest Wickets&emsp;</label>
      <br><br>
      <label class='rd'>&emsp;<input type="radio" style="display: none;" name="hideOrShow" value="BestEconomy"/>&emsp;Best Economy&emsp;&emsp;</label>
      <br><br>
      <label class='rd'>&emsp;<input type="radio" style="display: none;" name="hideOrShow" value="BestAverage"/>&emsp;Best Average&emsp; &emsp;</label>
      <br>
  </div>


  <div id="rightbox">

    <div class="MostRuns box">
        <?php
          include 'connection.php';
          $sqlquery="SELECT *,p.name,ps.runs_scored,ps.matches_played,(ps.runs_scored/ps.matches_played) as 'avg',(ps.runs_scored/ps.balls_faced)*100 as sr from  player_stats ps,player p where  p.id=ps.stat_id  order by ps.runs_scored desc limit 10";
          $resultquery=mysqli_query($con,$sqlquery);


              if(mysqli_num_rows($resultquery)>0)
              {
                echo "<table>
                          <tr class='header' >
                            <td>Country</td>
                            <td>Player Name</td>
                            <td>Total Runs</td>
                            <td>Matches</td>
                            <td>Average</td>
                            <td>Strike Rate</td>
                            
                          </tr>";

                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                    if($row['team']=='India')     echo   "<td><img style='width:34px;height:34px' src='india.jpeg'></td>";
                    elseif($row['team']=='England')   echo   "<td><img src='england.jpeg' style='width:34px;height:34px'></td>";
                    elseif($row['team']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:34px;height:34px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:34px;height:34px'></td>";
                    echo   "<td>".$row['name']."</td>";
                    echo   "<td style='font-size:30px;'>".$row['runs_scored']."</td>";
                    echo   "<td>".$row['matches_played']."</td>";
                    echo   "<td>".number_format($row['avg'],2,'.','')."</td>";
                    echo   "<td>".number_format((float) $row['sr'],2,'.','')."</td>";
                    echo    "</tr>";
                }

              }
              echo  "</table>";
            ?>
          </div>

    <div class="HighestScore box">
        <?php
          include 'connection.php';
          $sqlquery="SELECT *,(ps.runs_scored/ps.balls_faced)*100 as sr,ps.runs_scored/ps.matches_played as avg from  player_stats ps,player p where  p.id=ps.stat_id order by ps.highest_score desc limit 10";
          $resultquery=mysqli_query($con,$sqlquery);


              if(mysqli_num_rows($resultquery)>0)
              {
                echo "<table>
                          <tr class='header'>
                          <td>Country</td>

                            <td>Player Name</td>
                            <td>High SCore</td>
                            <td>Matches</td>
                            <td>Average</td>
                            <td>Strike Rate</td>
                            
                          </tr>";

                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                    echo   "<tr class='rows'>";
                    if($row['team']=='India')     echo   "<td><img style='width:34px;height:34px' src='india.jpeg'></td>";
                    elseif($row['team']=='England')   echo   "<td><img src='england.jpeg' style='width:34px;height:34px'></td>";
                    elseif($row['team']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:34px;height:34px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:34px;height:34px'></td>";
                    echo   "<td>".$row['name']."</td>";
                    echo   "<td style='font-size:30px;'>".$row['highest_score']."</td>";
                    echo   "<td>".$row['matches_played']."</td>";
                    echo   "<td>".number_format($row['avg'],2,'.','')."</td>";
                    echo   "<td>".number_format((float) $row['sr'],2,'.','')."</td>";

                  
                    echo    "</tr>";
                }

              }
              echo  "</table>";
            ?>
          </div>

    <div class="Most100s box">
        <?php
          include 'connection.php';
          $sqlquery="SELECT *,(ps.runs_scored/ps.balls_faced)*100 as sr,ps.runs_scored/ps.matches_played as avg from  player_stats ps,player p 
          where  p.id=ps.stat_id
          order by 100s desc limit 10";
          $resultquery=mysqli_query($con,$sqlquery);


              if(mysqli_num_rows($resultquery)>0)
              {
                echo "<table>
                          <tr class='header'>
                          <td>Country</td>
                            <td>Player Name</td>
                            <td>Hundreds</td>
                            <td>Matches</td>
                            <td>HighestScore</td>
                            <td>Average</td>
                            <td>Strike Rate</td>
                            
                          </tr>";

                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                   echo   "<tr class='rows'>";
                    if($row['team']=='India')     echo   "<td><img style='width:34px;height:34px' src='india.jpeg'></td>";
                    elseif($row['team']=='England')   echo   "<td><img src='england.jpeg' style='width:34px;height:34px'></td>";
                    elseif($row['team']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:34px;height:34px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:34px;height:34px'></td>";
                    echo   "<td>".$row['name']."</td>";
                    echo   "<td style='font-size:30px;'>".$row['100s']."</td>";
                    echo   "<td>".$row['matches_played']."</td>";
                    echo   "<td>".$row['highest_score']."</td>";     
                    echo   "<td>".number_format($row['avg'],2,'.','')."</td>";
                    echo   "<td>".number_format((float) $row['sr'],2,'.','')."</td>";

                  
                    echo    "</tr>";
                }

              }
              echo  "</table>";
            ?>
          </div>

    <div class="Most50s box">
        <?php
          include 'connection.php';
          $sqlquery="SELECT *,(ps.runs_scored/ps.balls_faced)*100 as sr,ps.runs_scored/ps.matches_played as avg from  player_stats ps,player p 
          where  p.id=ps.stat_id
          order by 50s desc limit 10";
          $resultquery=mysqli_query($con,$sqlquery);


              if(mysqli_num_rows($resultquery)>0)
              {
                echo "<table>
                          <tr class='header'>
                          <td>Country</td>
                            <td>Player Name</td>
                            <td>Fifties</td>
                            <td>Matches</td>
                            <td>HighestScore</td>
                            <td>Average</td>
                            <td>Strike Rate</td>
                            
                          </tr>";

                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                   echo   "<tr class='rows'>";
                    if($row['team']=='India')     echo   "<td><img style='width:34px;height:34px' src='india.jpeg'></td>";
                    elseif($row['team']=='England')   echo   "<td><img src='england.jpeg' style='width:34px;height:34px'></td>";
                    elseif($row['team']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:34px;height:34px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:34px;height:34px'></td>";
                    echo   "<td>".$row['name']."</td>";
                    echo   "<td style='font-size:30px;'>".$row['50s']."</td>";
                    echo   "<td>".$row['matches_played']."</td>";
                    echo   "<td>".$row['highest_score']."</td>";     
                    echo   "<td>".number_format($row['avg'],2,'.','')."</td>";
                    echo   "<td>".number_format((float) $row['sr'],2,'.','')."</td>";

                  
                    echo    "</tr>";
                }

              }
              echo  "</table>";
            ?>
          </div>




    <div class="MostWickets box">
        <?php
          include 'connection.php';
          $sqlquery="SELECT *,runs_given/(balls_bowled/6) as economy from player_stats ps,player p 
          where  p.id=ps.stat_id
          order by wickets desc limit 10";
          $resultquery=mysqli_query($con,$sqlquery);


              if(mysqli_num_rows($resultquery)>0)
              {
                echo "<table>
                          <tr class='header'>
                          <td>Country</td>
                            <td>Player Name</td>
                            <td>Total Wickets</td>
                            <td>Matches</td>
                            <td>Highest Wickets</td>
                            <td>Economy</td>
                          </tr>";

                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                   echo   "<tr class='rows'>";
                    if($row['team']=='India')     echo   "<td><img style='width:34px;height:34px' src='india.jpeg'></td>";
                    elseif($row['team']=='England')   echo   "<td><img src='england.jpeg' style='width:34px;height:34px'></td>";
                    elseif($row['team']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:34px;height:34px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:34px;height:34px'></td>";
                    echo   "<td>".$row['name']."</td>";
                    echo   "<td style='font-size:30px;'>".$row['wickets']."</td>";
                    echo   "<td>".$row['matches_played']."</td>";
                    echo   "<td>".$row['highest_wickets']."</td>";     
                    echo   "<td>".number_format($row['economy'],2,'.','')."</td>";
                    echo    "</tr>";
                }
                
              }
              echo  "</table>";
            ?>
          </div>
     <div class="HighestWickets box">
        <?php
          include 'connection.php';
          $sqlquery="SELECT *,runs_given/(balls_bowled/6) as economy from player_stats ps,player p 
          where  p.id=ps.stat_id
          order by highest_wickets desc limit 10";
          $resultquery=mysqli_query($con,$sqlquery);


              if(mysqli_num_rows($resultquery)>0)
              {
                echo "<table>
                          <tr class='header'>
                          <td>Country</td>
                            <td>Player Name</td>
                            <td>Highest Wickets</td>
                            <td>Matches</td>
                            <td>Total Wickets</td>
                            <td>Economy</td>
                          </tr>";

                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                    echo   "<tr class='rows'>";
                    if($row['team']=='India')     echo   "<td><img style='width:34px;height:34px' src='india.jpeg'></td>";
                    elseif($row['team']=='England')   echo   "<td><img src='england.jpeg' style='width:34px;height:34px'></td>";
                    elseif($row['team']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:34px;height:34px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:34px;height:34px'></td>";
                    echo   "<td>".$row['name']."</td>";
                    echo   "<td style='font-size:30px;'>".$row['highest_wickets']."</td>";
                    echo   "<td>".$row['matches_played']."</td>"; 
                    echo   "<td>".$row['wickets']."</td>";    
                    echo   "<td>".number_format($row['economy'],2,'.','')."</td>";
                    echo    "</tr>";
                }
                
              }
              echo  "</table>";
            ?>
          </div>
     
     <div class="BestEconomy box">
          <?php
          include 'connection.php';
          $sqlquery="SELECT *,runs_given/(balls_bowled/6) as economy from player_stats ps,player p 
          where  p.id=ps.stat_id and role like '%Bowler%'
          order by economy limit 10";
          $resultquery=mysqli_query($con,$sqlquery);


              if(mysqli_num_rows($resultquery)>0)
              {
                echo "<table>
                          <tr class='header'>
                          <td>Country</td>
                            <td>Player Name</td>
                            <td>Best Economy</td>
                            <td>Matches</td>
                            <td>Total Wickets</td>
                            <td>Highest Wickets</td>
                          </tr>";

                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                   echo   "<tr class='rows'>";
                    if($row['team']=='India')     echo   "<td><img style='width:34px;height:34px' src='india.jpeg'></td>";
                    elseif($row['team']=='England')   echo   "<td><img src='england.jpeg' style='width:34px;height:34px'></td>";
                    elseif($row['team']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:34px;height:34px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:34px;height:34px'></td>";
                    echo   "<td>".$row['name']."</td>";
                    echo   "<td style='font-size:30px;'>".number_format($row['economy'],2,'.','')."</td>";
                    echo   "<td>".$row['matches_played']."</td>"; 
                    echo   "<td>".$row['wickets']."</td>"; 
                       
                    echo   "<td>".$row['highest_wickets']."</td>";
                    echo    "</tr>";
                }
                
              }
              echo  "</table>";
            ?>
          </div>
   
      <div class="BestAverage box">
        <?php
          include 'connection.php';
          $sqlquery="SELECT *,runs_given/(balls_bowled/6) as economy,runs_given/matches_played as avg from player_stats ps,player p 
          where  p.id=ps.stat_id and role like '%Bowler%'
          order by economy limit 10";
          $resultquery=mysqli_query($con,$sqlquery);


              if(mysqli_num_rows($resultquery)>0)
              {
                echo "<table>
                          <tr class='header'>
                          <td>Country</td>
                            <td>Player Name</td>
                            <td>Best Average</td>
                            <td>Matches</td>
                            <td>Total Wickets</td>
                            <td>Highest Wickets</td>
                            <td>Economy</td>
                          </tr>";

                while($row=mysqli_fetch_assoc($resultquery))
                {
                    echo   "<tr class='rows'>";
                   echo   "<tr class='rows'>";
                    if($row['team']=='India')     echo   "<td><img style='width:34px;height:34px' src='india.jpeg'></td>";
                    elseif($row['team']=='England')   echo   "<td><img src='england.jpeg' style='width:34px;height:34px'></td>";
                    elseif($row['team']=='Australia')  echo   "<td><img src='australia.jpeg' style='width:34px;height:34px'></td>";
                    else                echo   "<td><img src='westindies.jpeg' style='width:34px;height:34px'></td>";
                    echo   "<td>".$row['name']."</td>";
                    echo   "<td style='font-size:30px;'>".number_format($row['avg'],2,'.','')."</td>";
                    echo   "<td>".$row['matches_played']."</td>"; 
                    echo   "<td>".$row['wickets']."</td>"; 
                       
                    echo   "<td>".$row['highest_wickets']."</td>";
                    echo   "<td>".number_format($row['economy'],2,'.','')."</td>";
                    echo    "</tr>";
                }
                
              }
              echo  "</table>";
            ?>
          </div>








  </div>


</div>


</body>
</html>