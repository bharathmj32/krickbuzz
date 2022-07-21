<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>

<head>
	<title>KricBuzz</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
   
<style type="text/css">
   .box{
    	display: none;
    }
    .videos{
    	display: block;
    }

  #video{
    position: fixed;
    right:0;
    bottom:0;
    min-width: 100%;
    min-height: 100%;
    z-index: -1;
  }
  label{
    margin-top: 5px;
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
  input[type='radio']:active + label{
    color:white;
    background:linear-gradient(-135deg, #fa0ceb, #fa0ceb33) !important;
    
  }
</style>


<body>
  <video autoplay muted loop id='video'style='z-index=-2'><source src="gradient.mp4" type="video/mp4"></video>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand active" href="home.html"><img src="logo.png" height="45" width="45"> KricBuzz</a>

 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
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
          if(mysqli_num_rows($result)>0){       
                while($row=mysqli_fetch_assoc($result) ){ echo "<option>".$row['name']."</option>";}
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
        echo "<script>location.href='player.php'</script>";
      }  
    }
  ?>
  </div>




    
</nav>

<div id="bigkontainer">
    

     <div class="slideshow-container">

        <div class="mySlides ffade">
          <img id="img" src="logo.png" style="width:100%;height:546px;">
        </div>

        <div class="mySlides ffade">
          <img id="img" src="2.jpg" style="width:100%;height:546px;">
        </div>

        <div class="mySlides ffade">
          <img id="img" src="3.jpeg" style="width:100%;height:546px;">
        </div>
        <div class="mySlides ffade">
          <img id="img" src="4.jpg" style="width:100%;height:546px;">
        </div>
        <div class="mySlides ffade">
          <img id="img" src="5.jpeg" style="width:100%;height:546px;">
        </div>
        <div class="mySlides ffade">
          <img id="img" src="6.jpg" style="width:100%;height:546px;">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <br>
        </div> 
      <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
      setTimeout(showSlides, 5000); // Change image every 5 seconds
    }
      </script>

      
    <div class="iframe-container">
          <div style="background-color: rgb(52 58 64);padding-left: 170px">
           <label class='rd'>&emsp;Video&emsp;<input type="radio" style="display: none;" name="hide" value="video" checked/></label>
           &emsp;&emsp;<label class='rd'>&emsp;Latest News&emsp; <input type="radio" style="display: none;" name="hide" value="news"/></label>
            &emsp;&emsp;<label class='rd'>&emsp;Browse Player&emsp;<input type="radio" style="display: none;" name="hide" value="search "/></label>
          </div>

            <iframe class="video box" src="https://www.icc-cricket.com/video" style="width:100%;height:500px;"></iframe>
            <iframe class="news box" src="https://www.news18.com/cricketnext/" style="width:100%;height:500px;"></iframe>
            <iframe class="search box" src="https://www.cricketcountry.com/players/" style="width:100%;height:500px;"></iframe>
      </div>


     


</div>
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



</body>
</html>

