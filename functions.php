<?php
require_once(dirname(__FILE__)."/defaultconfig.php");

function runSQL($sql) {
	$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	if (mysqli_connect_errno()) {
		echo "Connection failed: ". mysqli_connect_error();
		exit();
	}
	if($result = $db->query($sql)) {
		return $result;
	} else {
		echo "Query failed: " . $db->error; 
		exit();
	}
	$db->close();
}

function runMultiSQL($sql) {
	echo "multisql: " . $sql;
	$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	if (mysqli_connect_errno()) {
		echo "Connection failed: ". mysqli_connect_error();
		exit();
	}
	if($result = $db->multi_query($sql)) {
		$allResults[] = $result;
		while ($nextResult = $db->next_result()) {
			$allResults[] = $nextResult;
		}

		return $allResults;
	} else {
		echo "Multi query failed: " . $db->error; 
		exit();
	}
	$db->close();
}

function listPages($siteID) {
	$sql = "SELECT pageID, title FROM pages WHERE userID={$siteID}";
	return runSQL($sql);

}

function listSites() {
	$sql = "SELECT uid, sitename FROM users";
	$result = runSQL($sql);
}

function listUsers() {
	$sql = "SELECT uid, username FROM users";
	$result = runSQL($sql);
}

function addSite($title, $description, $username, $password) {
	$sql = "INSERT INTO users (username, password, sitename, description) VALUES ('{$username}', MD5('{$password}'), '{$title}', '{$description}')";
	$result = runSQL($sql);
	// would be nice to return the new userID here, and have a new user be logged in when they sign up
}

function addPage($title, $content, $siteID, $parentID) {
	$sql = "INSERT INTO pages (title, content, userID, parentID) VALUES ('{$title}','{$contet}', {$siteID}, {$parentID})";
	$result = runSQL($sql);
}

function updateSite($siteID, $title, $content) {
	$sql = "UPDATE users SET sitename='{$title}', description='{$content}' WHERE uid={$siteID}";
	return runSQL($sql);
}

function updateUser($userID, $username, $password) {
	$sql = "UPDATE users SET username='{$username}', password='{$password}' WHERE uid={$userID}";
	return runSQL($sql);
}

function updatePage($pageID, $title, $content) {
	$sql = "UPDATE pages SET title='{$title}', content='{$content}' WHERE pageID={$pageID}";
	runSQL($sql);
}

function deleteSite($siteID) {
	$sql = "DELETE FROM pages WHERE userID={$siteID}";
	$result = runSQL($sql);
	$sql = "DELETE FROM users WHERE uid={$siteID}";
	$result = runSQL($sql);
}

function deletePage($pageID) {
	$sql = "DELETE FROM pages WHERE pageID={$pageID}";
	$result = runSQL($sql);
}

function getUserId($un, $pw) {
	$sql = "SELECT uid FROM users WHERE username='{$un}' AND password=MD5('{$pw}') LIMIT 1";
	$result = runSQL($sql);
	$row = $result->fetch_assoc();
	return $row['uid'];
}
