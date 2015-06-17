<?php
	require_once("../functions.php");
	// if a form was submitted, update page
	if (isset($_POST['un']) && isset($_POST['pw'])) {
		$username=addslashes($_POST['un']);
		$password=addslashes($_POST['pw']);
		$sitename=addslashes($_POST['sitename']);
		$description=addslashes($_POST['description']);
		$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if (mysqli_connect_errno()) {
			echo "Connection failed: ". mysqli_connect_error();
			exit();
		}
		runMultiSQL(file_get_contents("tinyCMS.sql"));
		addSite($sitename, $description, $username, $password);

		header("Location: /page_admin.php");
	} else {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>My Website</title>
<link rel='stylesheet' href='styles/bootstrap.min.css' />
<link rel='stylesheet' href='styles/custom.css' />
<script src="js/respond.js"></script>
</head>

<body>
<header class="row"><h1>My Website</h1></header>
<div class="row">
<hr /><p style="text-align:right;">
<a href="/user_list.php">view all</a>
</p><hr />
<form method="post" action="install.php">
<p>Website Name:<br /><input type="text" size="77" name="sitename"></p>
<p>Website Description: (this text will appear on your front page)<br />
<textarea cols="80" rows="10" name="description"></textarea></p>
<p>Username: <input type="text" size="20" name="un" value="">
Password: <input type="password" size="20" name="pw" value=""></p>
<p style="text-align:center;"><input type="submit" value="Create My Site"></p></form>
</div>
<footer class="row"><hr /><p style="text-align:right;">Copyright &copy; <?php echo date("Y", time()); ?></p></footer>
<!-- javascript -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php
	}
