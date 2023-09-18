<?php

$connStr = "host=localhost port=5432 dbname=apirest_i9u3_dev user=postgres password=123456";
//          host=localhost port=5432 dbname=apirest_i9u3_dev user=postgres password=12345

//simple check
$conn = pg_connect($connStr);
$result = pg_query($conn, "SELECT *FROM citas");
var_dump(pg_fetch_all($result));

?>