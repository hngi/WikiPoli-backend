<?php
    include_once('Database.php');
?>
<?php
/* 

    This is the Social Model Class 
*/
class Social{
    // DB Param
    private $db;

    // post rable properties
    // public $post_id;
    // public $post_title;
    // public $post_body;
    // public $post_author_name;
    // public $post_date;

    // construct with DB
    public function __construct() {
        $this->db = new Database();
    }

    // get all posts
    public function selectAllPosts(){
        // join the table of the users and the posts so as to get the user's name where the user_id is the same as the post_author
        $query = "SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.post_author = users.user_id ORDER BY post_id DESC";
        $result = $this->db->select($query);
        return $result;        
    }
}
?>