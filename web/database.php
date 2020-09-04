<?php
/**********************************************************
* File: dbConnect.php
* Author: Br. Burton
* 
* Description: Shows how to connect using either local
* OR Heroku credentials, depending on whether the code
* is executing at heroku.
***********************************************************/
function get_db() {
	$db = NULL;
	try {
		// default Heroku Postgres configuration URL
        $dbUrl = getenv('DATABASE_URL');
        if (!isset($dbUrl) || empty($dbUrl)) {
			$dbUrl = "postgres://kfwjbcqzwzpacd:14dc1474a3f84e2ac1484d56d7bf301093b255e029553e74f2ed5e1f1d7703a8@ec2-174-129-27-158.compute-1.amazonaws.com:5432/degk0pjuc8c9sm";
		}
		// Get the various parts of the DB Connection from the URL
		$dbopts = parse_url($dbUrl);
        $dbHost = $dbopts["host"];
		$dbPort = $dbopts["port"];
		$dbUser = $dbopts["user"];
        $dbPassword = $dbopts["pass"];		
        $dbName = ltrim($dbopts["path"],'/');
		// Create the PDO connection
		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch (PDOException $ex) {
		// If this were in production, you would not want to echo
		// the details of the exception.
		echo "Error connecting to DB. Details: $ex";
		die();
    }
    var_dump($db);
	return $db;
}