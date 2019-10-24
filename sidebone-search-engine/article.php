<?php
 include 'header.php'; 
 ?>


<h1>Article page</h1>


<div class="article-container">
	<?php 
	//separate the search result from the rest of the article


	//This display the title of the page we are currently on 
		$title = mysqli_real_escape_string($conn, $_GET['title']);
		//This display the date of the page we are currently on
		$date = mysqli_real_escape_string($conn, $_GET['date']);

		$sql = "SELECT * FROM article WHERE a_title='$title' AND a_date='$date'";
		$result = mysqli_query($conn,$sql);
		$queryResults = mysqli_num_rows($result);

		if ($queryResults > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				# code...
				echo "<div class='article-box'>
					<h3>".$row['a_title']."</h3>
					<p>".$row['a_text']."</p>
					<p>".$row['a_date']."</p>
					<p>".$row['a_author']."</p>

				</div>";
 
			}
		}
	 ?>
</div>

</body>
</html>