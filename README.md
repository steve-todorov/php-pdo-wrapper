php-pdo-wrapper
===============

This is a PDO wrapper class. Whenever a `PDOException` is thrown,
it will be catched and a `DatabaseException` will be thrown instead.
The `DatabaseException` will hold the executed SQL.
If the query was prepared, the `DatabaseException` will show
the prepared query with it's binded values.