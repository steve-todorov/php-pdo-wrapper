<?php

// Example usage.

require_once('lib/Database.php');
use Database\Database;

/**
 * Enter a valid DSN connection string. The strings for all supported databases
 * can be found at http://php.net/manual/en/pdo.drivers.php
 *
 * Most used DSN strings
 *
 * MySQL DSN string:
 * mysql:host=localhost;port=3306;dbname=testdb
 * OR
 * mysql:unix_socket=/tmp/mysql.sock;dbname=testdb
 * (http://php.net/manual/en/ref.pdo-mysql.connection.php)
 *
 * PostgreSQL DSN string:
 * pgsql:host=localhost;port=5432;dbname=testdb;user=bruce;password=mypass
 * (http://php.net/manual/en/ref.pdo-pgsql.connection.php)
 *
 * SQLite DSN string:
 * sqlite:/opt/databases/mydb.sq3
 * sqlite::memory:
 * sqlite2:/opt/databases/mydb.sq2
 * sqlite2::memory:
 * (http://php.net/manual/en/ref.pdo-sqlite.connection.php)
 *
 */
$connect_string = "pgsql:host=127.0.0.1;port=5432;dbname=testing_database";
$db = new Database($connect_string, 'my_username', 'my_password');

// Create a prepared statement
$ps = $db->prepare('SELECT * FROM users WHERE username = :username');
$ps->bindValue(':username', 'admin');
$ps->execute();
$ps->fetchAll(PDO::FETCH_ASSOC);

// An invalid query (i.e. the query throws PDOException)
$ps = $db->prepare('SELECT * FROM users WHERE usernamee = :username');
$ps->bindValue(':username', 'admin');
$ps->execute();
$ps->fetchAll(PDO::FETCH_ASSOC);
// The result will be a DatabaseException with the following message
// Database\DatabaseException: SQLSTATE[42703]: Undefined column: 7 ERROR: column "usernamee" does not exist LINE 1: SELECT * FROM users WHERE usernamee = $1 ^ --- [ Query: [ SELECT * FROM users WHERE usernamee = 'admin' ] ] in /path/to/lib/QueryStatement.php on line 51
// and a stack trace which will show you exactly where the query was executed.

?>