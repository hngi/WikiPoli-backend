<!DOCTYPE html>
<html>
<head>
  <title>Create post</title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<h2 align="center"><a href="#">Create Post</a></h2>
<br>
<div class="container">
  <form method="POST" id="Post_form">
    <div class="form-group">
      <input type="text" name="Post_name" id="Post_name" class="form-control" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <textarea type="text" name="Post_content" id="Post_content" class="form-control" placeholder="Enter Post" rows="7" cols="20"></textarea>
    </div>
    <div class="form-group">
      <input type="submit" name="submit" id="submit" class="btn btn-info" value="submit">
    </div>
  </form>
  <span id="Post_message"></span><br>
  <div id="display_post"></div>
</div>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#Post_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
          url: "add_post.php",
          method: "POST",
          data:form_data,
          dataType:"JSON",
          success:function(data)
          {
            if (data.error != '')
             {
                $('#Post_form')[0].reset();
                $('#Post_message').html(data.error);
            }
          }
        })
    });
  });
</script>








