<?php
// Beispiel SQLite
// Datenbankabfrage
// Datenbankverbindung herstellen
$dbPath = str_replace("/inc","/".$album."/sqlite3.db",__DIR__);

// Setup ###############################################################

function create($handle){			// Datenbank für neuen Ordner erstellen
	// Gallery : GID (varchar 32) | title (varchar 255) | lastUp (int) | lastZip (int) | items (int) | lastNewsItems (int) | size (int)
	$handle->query(
		'CREATE TABLE IF NOT EXISTS Gallery(
			GID varchar(64),
			title varchar(255),
			lastUp int,
			lastZip int,
			items int,
			lastNewsItems int,
			size int
		);');
	// EMAIL : UID (varchar 32)| FirstName (varchar 128) | email (varchar 255) | status (int)
	$handle->query(
		"CREATE TABLE IF NOT EXISTS Mail(
			UID varchar(64) UNIQUE,
			FirstName varchar(128),
			email varchar(255),
			status int(1)
		);");
}
function connect(){
	global $dbPath;
	if (!file_exists($dbPath)){
		$db = new SQLite3($dbPath , SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
		create($db);
		return $db;
	}
	return new SQLite3($dbPath , SQLITE3_OPEN_READWRITE);
}
function close($handle){
	$handle->close();
}
function query($sql){
	$db = connect();
	$result = $db->query($sql);
	close($db);
	return $result;
}
function queryS($sql){
	$db = connect();
	$result = $db->querySingle($sql);
	close($db);
	return $result;
}


// Usage ################################################################
function get_FolderName(){		// Titel des Ordners
	return queryS('SELECT title FROM Gallery WHERE GID='.$gid);}	
function get_foldersize($gid){	// verbrauchten Speicherplatz ausgeben
	return queryS('SELECT size FROM Gallery WHERE GID='.$gid);}
function get_countitems($gid){	// Anzahl an Dateien im Ordner
	return queryS('SELECT items FROM Gallery WHERE GID='.$gid);}
function get_lastUp(){			// Zeit des letzten Uploads
	return queryS('SELECT lastUp FROM Gallery WHERE GID='.$gid);}
function get_lastZip(){			// Zeit der letzten Zip-Erstellung
	return queryS('SELECT lastZip FROM Gallery WHERE GID='.$gid);}

// Newsletter ###########################################################
// EMAIL : UID (varchar 32)| FirstName (varchar 128) | email (varchar 255) | status TRUE/FALSE
function create_user($mail){
	$id = md5($mail."2wok37u9w9");
	if(get_username($id) == Null){
		$name="Follower";
		$status = 0;
		query("INSERT INTO Mail (UID, FirstName, email, status) VALUES('$id', '$name', '$mail', $status);");
		return $id;
	}
	return "ERROR";
}
function enable_user($userid){
	return query("UPDATE Mail SET status=1 WHERE UID='$userid';");}
function update_username($userid,$name){
	query("UPDATE Mail SET FirstName='$name' WHERE UID='$userid';");}
function delete_user($userid){
	query("DELETE From Mail WHERE UID='$userid';");}
	
function get_users(){			// alle NutzerIDs für Newsletter ausgeben
	return query('SELECT UID FROM Mail;');}
function get_username($userid){	// Name der NutzerID (für Newsletters)
	return queryS("SELECT FirstName FROM Mail WHERE UID = '$userid';");}
function get_usermail($userid){	// E-Mail Adresse der NutzerID (für Newsletters)
	return queryS("SELECT email FROM Mail WHERE UID = '$userid';");}
function get_ImgsOnNewsletter($gid){ // Anzahl der Bilder die es beim letzten Newsletter gab
	return queryS("SELECT lastNewsItems FROM Gallery WHERE GID = '$gid';");}
?>