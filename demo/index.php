<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
		body{
			font-family: sans-serif;
			font-size:13px;
		}

		#form, #pages {
			margin: 60px 20px;
		}

		#pg, #pgs {
			width:50px;
		}

		#pages ul {
			padding:0;
			-webkit-touch-callout: none;
			  -webkit-user-select: none;
			   -khtml-user-select: none;
			     -moz-user-select: none;
				  -ms-user-select: none; 
					user-select: none; 
		}

		#pages ul li{
			list-style-type: none;
			display: inline-block;
			padding: 5px 7px;
			border: 1px solid #ddd;
			min-width: 20px;
			margin: 1px;
			text-align: center;
			color: #444;
		}

		#pages ul li.link{
			cursor: pointer;
		}

		#pages ul li.current, #pages ul li:hover{
			background: #333;
			color: #fff;
		}
	</style>
</head>
<body>
	<div id="form">Show page <input type="text" id="pg" value="1"> of <input type="text" id="pgs" value="10"></div>
	<div id="pages"></div>
	<script type="text/javascript">
		
		var links;

		document.querySelector( "#pg"  ).addEventListener( "change", loadPages );
		document.querySelector( "#pgs" ).addEventListener( "change", loadPages );

		function loadPages(){

			var pg  = document.querySelector( "#pg"  ).value;
			var pgs = document.querySelector( "#pgs" ).value;

			fetch( '/demo/pages.php?pg=' + pg + '&pgs=' + pgs )
		  	.then( function( response ) {
		    	return response.text();
		  	})
		  	.then( function( data ) {
				document.querySelector('#pages').innerHTML = data;
				
				links = document.querySelectorAll( ".link" );
				
				for( i = 0; i < links.length; i++ ){
					links[i].addEventListener( "click", function(e){
						var page =  e.target.dataset.p;
						document.querySelector( "#pg" ).value = page;
						loadPages();
					});
				}
		  	});
		}

		loadPages();

		

    	
    </script>
</body>
</html>