<?php
 include 'dbh.php'; 
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>search Engine</title>
	<style type="text/css">
		#searchBar {
			border: 1px solid #213CDC;
			border-right: none;
			font-size: 16px;
			padding: 10px; 
			outline: none;
			width: 250px;
			

		}

		#searchBtn {
			font-family: Lato;
			border: 1px solid #213CDC;
			font-size: 16px;
			padding: 10px;
			background: #213CDC;
			font-weight: bold;
			cursor: pointer;
			outline: none;
			color: #fff;
			
		}
		#searchBtn:hover {
			background: #f6e049; 
		}
		body {
			background-color: #f3f3f3;
			font-family: arial;
		}
		.article-container {
			width: 900px;
			background-color: #fff;
			padding: 30px;
		}
		.article-box {
			padding-bottom: 30px;
			width: 100%;
		}
		h3 {
			margin: 20px 0px 0px 0px;
			padding: 0;
		}
		p {
			margin: 0;
			padding: 0;
		}
	</style>

	<script type="text/javascript">
	function active(){
		var searchBar = document.getElementById('searchBar');
		//set the searchBar to empty and replace it with the placeholder info
		if(searchBar.value == 'Search...'){
			searchBar.value = ''
			searchBar.placeholder = 'Enter Politician'
		}
	}
	function inactive(){

		var searchBar = document.getElementById('searchBar');
		//set the searchBox to the value info
		if(searchBar.value == ''){
			searchBar.value = 'Search...'
			searchBar.placeholder = ''
		}
	}
</script>
</head>
<body>