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
			GID varchar(64) UNIQUE,
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

function create_gallery($title){
	global $dbPath, $album;
	$GID=md5($title."2wok37u9w9");
	$dbPath = str_replace("/inc","/u/".$GID."/sqlite3.db",__DIR__);
	$album = $GID;
	
	$tmpdir = str_replace("/inc","/u/".$GID,__DIR__);
	if(!is_dir($tmpdir)){mkdir($tmpdir, 0777, true);}
	echo $GID ."</br>";
	if(queryS("SELECT GID FROM Gallery;")==NULL){
		query("INSERT INTO Gallery (GID, title, lastUp, lastZip, items, lastNewsItems, size) VALUES('$GID', '$title', 0, 0, 0, 0, 0);");
	}
	return $GID;
}
// Usage ################################################################
// SET
//function set_FolderName(){// Titel des Ordners
//	return queryS('SELECT title FROM Gallery WHERE GID='.$gid);}	
function plus_foldersize($size){	// verbrauchten Speicherplatz ausgeben
	return query('UPDATE Gallery SET size = size + '.$size.';'		);}
function set_foldersize($size){	// verbrauchten Speicherplatz ausgeben
	return query('UPDATE Gallery SET size = '.$size.';'		);}
function plus_item(){		// Anzahl an Dateien im Ordner
	set_lastUp();
	return query('UPDATE Gallery SET items = items + 1;'	);}
function minus_item(){		// Anzahl an Dateien im Ordner
	set_lastUp();
	return query('UPDATE Gallery SET items = items - 1;'	);}
function set_lastUp(){		// Zeit des letzten Uploads
	return query('UPDATE Gallery SET lastUp = '.time().';'	);}
function set_lastZip(){		// Zeit der letzten Zip-Erstellung
	return query('UPDATE Gallery SET lastZip = '.time().';'	);}

// GET	
function get_FolderName(){	// Titel des Ordners
	return queryS('SELECT title FROM Gallery;'	);}	
function get_foldersize(){	// verbrauchten Speicherplatz ausgeben
	return queryS('SELECT size FROM Gallery;'	);}
function get_countitems(){	// Anzahl an Dateien im Ordner
	return queryS('SELECT items FROM Gallery;'	);}
function get_lastUp(){		// Zeit des letzten Uploads
	return queryS('SELECT lastUp FROM Gallery;'	);}
function get_lastZip(){		// Zeit der letzten Zip-Erstellung
	return queryS('SELECT lastZip FROM Gallery;');}

// Newsletter ###########################################################
// User-Handling
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
	
// Newsletter
function get_users(){			// alle NutzerIDs für Newsletter ausgeben
	return query('SELECT UID FROM Mail;');}
function get_username($userid){	// Name der NutzerID (für Newsletters)
	return queryS("SELECT FirstName FROM Mail WHERE UID = '$userid';");}
function get_usermail($userid){	// E-Mail Adresse der NutzerID (für Newsletters)
	return queryS("SELECT email FROM Mail WHERE UID = '$userid';");}
function get_ImgsOnNewsletter($gid){ // Anzahl der Bilder die es beim letzten Newsletter gab
	return queryS("SELECT lastNewsItems FROM Gallery WHERE GID = '$gid';");}			// ? ? ? ? ? ? ? ? ? ? ? ? Differenz muss berechnet werden!
?>