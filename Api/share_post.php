<?php
    require_once('../autoloader.php');
    use Helper\Database as DB;
    use Helper\Jwt_client as jwt;

    // connect to the databse file
    $conn = DB::db_connect();

    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
   
        // get all posts from the database
        $getPosts = DB::getPostsToShare($conn, $post_id);

        // if the query is successful display the posts and the share link
        if ($getPosts) {
            // posts array
            $posts_arr = array();
            $posts_arr['data'] = array();
                
            while($row = mysqli_fetch_assoc($getPosts)) {
                // get current url
                $url = $_SERVER['REQUEST_URI'].$row['post_id'];

                $post_item = array(
                    'status'      => true,
                    'post_id'     => $row['post_id'],
                    'post_title'  => $row['post_topic'],
                    'post_body'   => html_entity_decode($row['post']),
                    'post_author' => $row['name'],
                    'post_date'   => $row['post_date_time'],
                    'twitter_share_link'    => "<a href='http://www.twitter.com/intent/tweet?url=http://www.localhost".$url."&text=".$row['post_topic']." target='_blank'>Share On Twitter</a>",
                    'facebook_share_link'   => "<a href='https://www.facebook.com/sharer/sharer.php?u=http://www.localhost".$url." target='_blank'>Share On Facebook</a>"
                );

                // push to data array
                array_push($posts_arr['data'], $post_item);
            }

            // convert the result to json and output it
            echo json_encode($posts_arr);
        } else {
            // if there is no post in the database
            echo json_encode(
                array(
                    'status'    => 404,
                    'message'   => 'No posts found'
                )
            );
        }
    } else {
        // if there is no post in the database
        echo json_encode(
            array(
                'status'    => 404,
                'message'   => 'Invalid post request'
            )
        );
    }
?>