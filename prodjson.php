<?php

require 'conn.php';

$q = "SELECT * FROM Products";

$res = $link->query( $q );

$arr = [];

while( $row = mysqli_fetch_assoc( $res )) {

  array_push($arr, $row);

}

echo ( json_encode( $arr ) ) ;