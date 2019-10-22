<?php
    require_once('../autoloader.php');
    
    use Helper\Admin as Admin;


$url_array = explode("/", $_SERVER['REQUEST_URI']);
//I'm getting the link details here and I split with "/"

$indexOfIndexPHP = array_search("index.php", $url_array);
//Get position of index.php in the link in case the tester tests using deep folder

//Routing
if (array_key_exists($indexOfIndexPHP + 1, $url_array) && $url_array[$indexOfIndexPHP + 1] != "") {
	//If url as first parameter and the parameter is not /
	switch ($url_array[$indexOfIndexPHP + 1]) {
		case 'admin':
			require_once "PostAdmin.php";
			$PostAdmin = new PostAdmin;
			$method = $url_array[$indexOfIndexPHP + 2];
			$parameter = isset($url_array[$indexOfIndexPHP + 3]) ? $url_array[$indexOfIndexPHP + 3]: NULL;
			$PostAdmin->$method($parameter);
			/*modified so that /index.php/admin/edit/4
				will call the edit function and insert 4 as parameter post id
			*/
			break;
		default:
			echo "404";
	}
}

else {
  //home
	echo "This Home, Direct Access Not Allowed";
}


   
?>