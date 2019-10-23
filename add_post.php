<? php
$connect = new PDO('mysql:host=localhost;dbname=createpost','root', '');

$error = '';
$Post_name = '';
$Post_content = '';
if (empty($_POST["Post_name"])) 
{
	$error .= '<p class="text-danger">Name is required</p>';
}
else
{
	$Post_name = $_POST["Post_name"];
}
if(empty($_POST["Post_content"]))
{
	$error .= '<p class="text-danger">Post is required</p>';
}
else
{
	$Post_content = $_POST["Post_content"];
}
if ($error == '') {
	$query = "
	INSERT INTO `createpost`(`Post_id`, `Parent_post_id`, `Post`, `Post_sender_name`, `date`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':Parent_post_id'   =>    '0',
			':Post'             =>    $Post_content,
			':Post_sender_name' =>    $post_name
			 )
	);
	$error = '<label class= "text-success"> Post Added</label>';
}
$data = array(
'error' => $error
);
echo json_encode($data);
?>



