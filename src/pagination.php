<?php
/**
 * PHP function to facilitate display of pages.
 * 
 * The function expects the current page and the total number of pages 
 * and returns HTML unordered list with number of pages to be displayed.
 * The list can easily be styled (e.g. using Bootstrap pagination )
 * 
 * The function automatically truncates long lists (stackoverflow style) 
 * 
 * @author V. Georgiev <vassbg@gmail.com>
 * @version 1.0.1
 * @license MIT
 * 
 * @param int $page  	The current page number
 * @param int $pages 	The total number of pages.
 * 
 * @return string HTML Unordered list of pages.
 */

function showPagination( $page, $pages ){

	# basic checks ... 
	if ( $page <= 0 || $pages <= 1 ) return;
	if ( $page > $pages ) $page = $pages;
	
	# the idea is to show 5 consecutive pages 
	$p = [];

	# ... so find the first ... 
		 if ( $page < 5 ) 				$p[1] = 1;
	else if ( $page > $pages - 4 )		$p[1] = $pages - 4;
	else if ( $page - 2 > 0 )			$p[1] = $page - 2;
	else if ( $page - 1 > 0 )			$p[1] = $page - 1;
	else								$p[1] = $page;

	# ... then find the other ... 
	if   	( $p[1] + 1 <= $pages ) 	$p[2] = $p[1] + 1;
	if   	( $p[1] + 2 <= $pages ) 	$p[3] = $p[1] + 2;
	if   	( $p[1] + 3 <= $pages ) 	$p[4] = $p[1] + 3;
	if   	( $p[1] + 4 <= $pages ) 	$p[5] = $p[1] + 4;

	# construct pagination to be returned
	$pagination = "<ul class='pagination'>";
	
	# elements to insert before the 5 pages row
	if ( $page >  1 ) 								$pagination .= "<li class='link' data-p='" . ($page - 1) . "'>prev</li>";
	if ( $p[1] >= 3 ) 								$pagination .= "<li class='link' data-p='1'>1</li>";
	if ( $p[1] >= 3 ) 								$pagination .= "<li>...</li>";

	# the 5 pages row
	foreach ( $p as $i ){
		if ( $i == $page ) 							$pagination .= "<li class='current'>$i</li>";
		else 										$pagination .= "<li class='link' data-p='$i'>$i</li>";
	}
	
	# elements to insert after the 5 pages row
	if ( isset ( $p[5] ) && $p[5] <= $pages - 2 )	$pagination .= "<li>...</li>";
	if ( isset ( $p[5] ) && $p[5] <= $pages - 2 )	$pagination .= "<li class='link' data-p='$pages'>$pages</li>";
	if ( $page <  $pages ) 							$pagination .= "<li class='link' data-p='" . ($page + 1) . "'>next</li>";

	# close ... 
	$pagination .= "<ul>";

	# ... and return
	return $pagination;
}

?>