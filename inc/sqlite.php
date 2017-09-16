<?php

$dbPath = str_replace("/inc","/".$album."/sqlite3.db",__DIR__);
// Setup ###############################################################

function RandomIDGenerator($len = 5) {
    $base='abcdefghjkmnpqrstwxyzABCDEFGHKLMNOPQRSTWXYZ0123456789';
    $activatecode='';
    mt_srand((double)microtime()*1000000);
    while (strlen($activatecode)<$len)
        $activatecode.=$base{mt_rand(0,strlen($base)-1)};
    return $activatecode;
}
function init(){
    global $dbPath;
    if (!file_exists($dbPath)){
        $db = new SQLite3($dbPath , SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        createGalleryDB($db);
        createMainDB($db);
        close($db)
    }
}

function createMainDB($handle){     // Hauptdatenbank erstellen
    // Users
    $handle->query(
        'CREATE TABLE IF NOT EXISTS Users (
            id VARCHAR(5) PRIMARY KEY NOT NULL, 
            email VARCHAR(255) NOT NULL, 
            password VARCHAR(255) NOT NULL, 
            forename VARCHAR(128) NOT NULL, 
            surname VARCHAR(128) NOT NULL, 
            created_at INTEGER NOT NULL DEFAULT CURRENT_TIMESTAMP, 
            updated_at INTEGER DEFAULT NULL, 
            subscription VARCHAR(64) NOT NULL DEFAULT free
            );');
    $handle->query(
        'CREATE TABLE IF NOT EXISTS Galleries (
            uid VARCHAR(5) NOT NULL, 
            gid VARCHAR(3) NOT NULL
        );');
}

function createGalleryDB($handle){  // Datenbank für neuen Ordner erstellen
    // Gallery :
    $handle->query(
        'CREATE TABLE IF NOT EXISTS Gallery(
            GID VARCHAR(3) UNIQUE,
            title VARCHAR(255),
            lastUp INTEGER,
            lastZip INTEGER,
            items INTEGER,
            lastNewsItems INTEGER DEFAULT NULL,
            lastNewsTime INTEGER DEFAULT NULL,
            size INTEGER
        );');
    // EMAIL
    $handle->query(
        "CREATE TABLE IF NOT EXISTS Mail(
            UID VARCHAR(8) PRIMARY KEY NOT NULL,
            FirstName VARCHAR(128) NOT NULL,
            email VARCHAR(255) NOT NULL,
            status INTEGER(1)
        );");
}
function connect(){
    global $dbPath;
    if (!file_exists($dbPath)){
        $db = new SQLite3($dbPath , SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        createGalleryDB($db);
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
    do {
        $GID = RandomIDGenerator(3);
        $album = $UID.$GID;
    } while (!is_dir( str_replace("/inc","/u/".$album,__DIR__) ));
    $dbPath = str_replace("/inc","/u/".$album."/sqlite3.db",__DIR__);
    
    $tmpdir = str_replace("/inc","/u/".$GID,__DIR__);
    if(!is_dir($tmpdir)){mkdir($tmpdir, 0777, true);}
    //echo "<a href='index.php?a=".$GID."'>".$GID."</a></br>";
    if(queryS("SELECT GID FROM Gallery;")==NULL){
        query("INSERT INTO Gallery (GID, title, lastUp, lastZip, items, lastNewsItems, size) VALUES('$GID', '$title', 0, 0, 0, 0, 0);");
    }else{
        
    }
    return $GID;
}
// Usage ################################################################
// SET
//function set_FolderName(){// Titel des Ordners
//    return queryS('SELECT title FROM Gallery WHERE GID='.$gid);}    
function set_FolderName($title){    // Titel des Ordners
    return query('UPDATE Gallery SET title = "'.$title.'";'    );}    
function plus_foldersize($size){    // verbrauchten Speicherplatz ausgeben
    return query('UPDATE Gallery SET size = size + '.$size.';'        );}
function set_foldersize($size){    // verbrauchten Speicherplatz ausgeben
    return query('UPDATE Gallery SET size = '.$size.';'        );}
function set_itemcount($count){    // verbrauchten Speicherplatz ausgeben
    return query('UPDATE Gallery SET items = '.$count.';'        );}
function plus_item(){        // Anzahl an Dateien im Ordner
    set_lastUp();
    return query('UPDATE Gallery SET items = items + 1;'    );}
function minus_item(){        // Anzahl an Dateien im Ordner
    set_lastUp();
    return query('UPDATE Gallery SET items = items - 1;'    );}
function set_lastUp(){        // Zeit des letzten Uploads
    return query('UPDATE Gallery SET lastUp = '.time().';'    );}
function set_lastZip(){        // Zeit der letzten Zip-Erstellung
    return query('UPDATE Gallery SET lastZip = '.time().';'    );}

// GET    
function get_FolderName(){    // Titel des Ordners
    return queryS('SELECT title FROM Gallery;'    );}    
function get_foldersize(){    // verbrauchten Speicherplatz ausgeben
    return queryS('SELECT size FROM Gallery;'    );}
function get_countitems(){    // Anzahl an Dateien im Ordner
    return queryS('SELECT items FROM Gallery;'    );}
function get_lastUp(){        // Zeit des letzten Uploads
    return queryS('SELECT lastUp FROM Gallery;'    );}
function get_lastZip(){        // Zeit der letzten Zip-Erstellung
    return queryS('SELECT lastZip FROM Gallery;');}

// Newsletter ###########################################################
// User-Handling
function create_user($mail){
    $id = md5($mail."2wok37u9w9");
    if(get_username($id) == NULL){
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
function get_users(){            // alle NutzerIDs für Newsletter ausgeben
    $db = connect();
    $result = $db->query('SELECT UID FROM Mail WHERE status=1;');
    $out = array();
    while ($line = $result->fetchArray()){array_push($out, $line["UID"]);}
    $db->close();
    return $out;
}
function get_username($userid){    // Name der NutzerID (für Newsletters)
    return queryS("SELECT FirstName FROM Mail WHERE UID = '$userid';");}
function get_usermail($userid){    // E-Mail Adresse der NutzerID (für Newsletters)
    return queryS("SELECT email FROM Mail WHERE UID = '$userid';");}
    
function get_lastNewsItems(){ // Anzahl der Bilder die es beim letzten Newsletter gab
    return queryS("SELECT lastNewsItems FROM Gallery;");}
function set_lastNewsItems(){ // Anzahl der Bilder die es beim letzten Newsletter gab
    
    return query("UPDATE Gallery SET lastNewsItems = ".get_countitems().";");}
    
function get_lastNewsTime(){ // Zeitpunkt des letzten Newsletters
    return queryS("SELECT lastNewsTime FROM Gallery;");}
function set_lastNewsTime(){ // Anzahl der Bilder die es beim letzten Newsletter gab
    return query("UPDATE Gallery SET lastNewsTime=".time().";");}
    
?>