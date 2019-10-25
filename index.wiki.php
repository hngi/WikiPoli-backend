
<!DOCTYPE html>
<?php
include('config.wiki.php');
$login_button = '';
if(isset($_GET["code"])) {
	$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
	if(!isset($token['error'])) {
		$google_client->setAccessToken($token['access_token']);
		$_SESSION['access_token'] = $token['access_token'];
		$google_service = new Google_Service_Oauth2($google_client);
		$data = $google_service->userinfo->get();
		
		if (!empty($data['given_name'])) {
			$_SESSION['user_first_name'] = $data['given_name'];
		}
		if (!empty($data['family_name'])) {
			$_SESSION['user_last_name'] = $data['family_name'];
		}
		if (!empty($data['email'])) {
			$_SESSION['user_email_address'] = $data['email'];
		}
		if (!empty($_SESSION['gender'])) {
			$_SESSION['user_gender'] = $data['gender'];
		}
		if (!empty($_SESSION['picture'])) {
			$_SESSION['user_image'] = $data['picture'];
		}
		
	}
}
if (!isset($_SESSION['access_token'])) {
	$login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="img/google-sign-up.png" /></a>';
}
?>
<html>
<head>
	<title>wikipoli</title>
</head>
	<center><body>
		<div class="container">
				<br />
				<h2 align="centre">PHP Login using google Account</h2>
				<br />
				<div class="panel panel-default">
				<?php
					if($login_button == '') 
					{
						echo "<div>Welcome User</div><div>";
						echo '<img src="'.$_SESSION["user_image"].'"/>';
						echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
						echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
						echo '<h3><a href="logout.wiki.php">Logout</h3></div>';
					}
					else
					{
						
						echo '<div align="centre">'.$login_button.'</div>';
					}
				?>
			</div>
		</div>
	</body></center>
</html>

    
