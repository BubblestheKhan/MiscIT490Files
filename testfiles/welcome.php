<?php

//Initialize session
session_start();

//If no session variable set, redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	header("location: login.php");
	exit;
	}
?>

<!DOCTYPE HTML>
<head>
	<title>Welcome!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
	<style type="text/css">
	body{ font: 14px sans-serif; text-align: center;}
	</style>
</head>
<body>
	<div class="page-header">
	<h1>Hiya,<b><?php echo htmlspecialchrs($_SESSION['username']);?></b>! Let's get Hoppin'!
	<i class="em em-beer"></i>
	</h1>
	</div>

	<!--Search Bar-->
<!--
<script>
	function showResult(str){
		if(str.length==0){
			document.getElementById("livesearch").innerHTML="";
			document.getElementById("livesearch").style.border="0px";
			return;
		}
	if(window.XMLHttpRequest){
	//Works with Chrome, Firefox, Safari, Opera, IE7+
		xmlhttp=new XMLHttpRequest();
		}
	xmlhttp.onreadystatechange=function(){
		if(this.readyState==4 && this.status==200){
			document.getElementById("livesearch").innerHTML=this.responseText;
			document.getElementById("livesearch").style.border="1pm solid #A5ACB2";
			}
		}
		xmlhttp.open("GET","livesearch.php?q="+str,true);
		xmhttp.send();
		}
</script>
<form>
	<input type="text" size="30" onkeyup="showResult(this.value)">
	<div id="livesearch"></div>
</form>

-->
	<br></br>
	<br></br>
	<p><a href="logout.php class btn btn-danger">Sign Out</a></p>
</body>
</html>
