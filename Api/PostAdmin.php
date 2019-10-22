<?php
    require_once('../autoloader.php');
    
    use Helper\Admin as Admin;

    //echo(Admin::say_hello());

    /**
     * 
     */
    class PostAdmin {
    	$db;
    	
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
    	}

        public function publish()
        {
            


        }


        public function unpublish($id)
        {
                    # code...
        }

        public function edit($id)
        {
            # code...
        }

    }
   
?>