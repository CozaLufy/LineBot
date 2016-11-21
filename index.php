<!DOCTYPE html>
<html>
<head>
<title>Line API Message</title>
<meta charset="utf-8" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
<meta http-equiv="content-type" content="text/plain; charset=iso-8859-1" />
<script src="jquery-1.9.0.min.js"></script>
<script type="text/javascript" language="javascript">
$(function() {
      
      $('ul.tabs li').click(function(){
    		var tab_id = $(this).attr('data-tab');
    
    		$('ul.tabs li').removeClass('current');
    		$('.tab-content').removeClass('current');
    
    		$(this).addClass('current');
    		$("#"+tab_id).addClass('current');
    	});
});

</script>

<style>
body{
			margin-top: 100px;
			font-family: 'Trebuchet MS', serif;
			line-height: 1.6
		}
		.container{
			width: 800px;
			margin: 0 auto;
		}



		ul.tabs{
			margin: 0px;
			padding: 0px;
			list-style: none;
		}
		ul.tabs li{
			background: none;
			color: #222;
			display: inline-block;
			padding: 10px 15px;
			cursor: pointer;
		}

		ul.tabs li.current{
			background: #ededed;
			color: #222;
		}

		.tab-content{
			display: none;
			background: #ededed;
			padding: 15px;
		}

		.tab-content.current{
			display: inherit;
		}
    
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    
    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
</head>

<body>   
<div class="container">

	<ul class="tabs">
		<li class="tab-link current" data-tab="tab-1">User Follow</li>
		<li class="tab-link" data-tab="tab-2">Tab Two</li>
		<li class="tab-link" data-tab="tab-3">Tab Three</li>
		<li class="tab-link" data-tab="tab-4">Tab Four</li>
	</ul>

	<div id="tab-1" class="tab-content current">
  <table>
  <tr>
    <th>displayName</th>
    <th>userId</th>
    <th>pictureUrl</th>
    <th>statusMessage</th>
  </tr>
  <?php
  $json = file_get_contents("https://dice.in.th/LineBot/friends_list.json");
  $obj = json_decode($json, true);
  //var_dump($obj);
  $access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';  
 
  foreach($obj as $rs) {       
      $url  =  "https://api.line.me/v2/bot/profile/".$rs["userId"];     
      echo $url;       
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $result = curl_exec($ch);
      curl_close($ch);
      $ch_result = json_decode($result, true);
      var_dump($ch_result);
  ?>
  <tr>
    <td><?php echo $ch_result["displayName"] ?></td>
    <td><?php echo $ch_result["userId"] ?></td>
    <td><img style="width: 50px;height: 48px;" src="<?php echo $ch_result["pictureUrl"] ?>"></td>
    <td>Germany</td>
  </tr>
  <?php 
  }  
  ?>
	</table>
	</div>
	<div id="tab-2" class="tab-content">
		 Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div>
	<div id="tab-3" class="tab-content">
		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
	</div>
	<div id="tab-4" class="tab-content">
		Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
	</div>

</div><!-- container -->
</body>
</html>

