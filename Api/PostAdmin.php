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
    		$this->db = new Database();
    	}

        public function get($id = NULL)
    	{
    		



    	}
        public function publish()
        {
            # code...
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