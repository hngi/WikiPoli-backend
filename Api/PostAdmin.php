<?php
    require_once('../autoloader.php');
    
    use Helper\Admin as Admin;
    use Helper\Database as Database;

    //echo(Admin::say_hello());

    /**
     * 
     */
    class PostAdmin {
    	public $db;
    	
    	function __construct()
    	{
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Method: *");
        header('Content-Type: application/json');

    		$this->db = new Database();
    	}

        public function get($id = NULL)
    	{
    		
          $post = $this->db->select("SELECT * FROM posts WHERE post_id =$id;");
          if (!$post) {

          echo json_encode(['error'=>1,'message'=>'No Post Yet'],true);

          }else{

          echo json_encode(['error'=>0,'message'=>'Post Gotten Successfully','post'=>$post[0]],true);

          }

          $this->db->close();
    	}

        public function publish($id)
        {
            
 if ($this->db->query("UPDATE posts SET post_status='published' WHERE post_id =$id ")) {
            
            echo json_encode(['error'=>0,'message'=>'Post Published Successfully','post_id'=>$id],true);

          }else{

            echo json_encode(['error'=>1,'message'=>'Error Occured','post_id'=>$id],true);

        }
                  $this->db->close();

        }


        public function unpublish($id)
        {

 if ($this->db->query("UPDATE posts SET post_status='draft' WHERE post_id =$id ")) {
            
            echo json_encode(['error'=>0,'message'=>'Post Unpublished Successfully','post_id'=>$id],true);

          }else{

            echo json_encode(['error'=>1,'message'=>'Error Occured','post_id'=>$id],true);

        }
                  $this->db->close();
        }

        public function edit($id)
        {

          $title = $_POST['title'];
          $contents = $_POST['contents'];
          if ($this->db->query("UPDATE posts SET post_topic=$title,post=$contents  WHERE post_id =$id ")) {
            
            echo json_encode(['error'=>0,'message'=>'Post Edited Successfully','post_id'=>$id],true);

          }else{

            echo json_encode(['error'=>1,'message'=>'Error Occured','post_id'=>$id],true);

        }
                  $this->db->close();

          }

    }
   
