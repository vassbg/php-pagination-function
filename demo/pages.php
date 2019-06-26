<?php

$pg  = isset( $_GET['pg'] )  ? $_GET['pg']  : 0;
$pgs = isset( $_GET['pgs'] ) ? $_GET['pgs'] : 0;

require_once('../src/pagination.php');

echo showPagination( $pg, $pgs );

?>