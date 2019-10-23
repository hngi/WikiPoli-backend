<?php


require_once('../autoloader.php');
    
use Helper\Database as DB;

public function selectAllPosts(){
    // connect to database
    $conn = DB::db_connect();

    // join the table of the users and the posts so as to get the user's name where the user_id is the same as the post_author
    $query = "SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.post_author = users.user_id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $res['status'] = 'true';
        $res['message'] = 'Posts Found';
        $res['posts'] = $data;

        return response()->json($res, 200);
    } 
    else {
        $res['status'] = false;
        $res['message'] = 'Posts cannot be retrieved at the moment';
        return response()->json($res, 500);
    }
}
?>