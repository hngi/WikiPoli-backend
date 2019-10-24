<?php
 include 'header.php'; 
 ?>


<form action="search.php" method="POST">
	<input type="text" id="searchBar" placeholder="Enter Politician" name="search" value="Search..." maxlength="25" autocomplete="off" onmousedown="active();" onblur="inactive();"><input type="submit" id="searchBtn" value="search" name="submit-search">
</form>
	<h1>Front Page</h1>
	<h2>All article</h2>

	<div class="article-container">
	<?php
	//Get the articles from database
		$sql = "SELECT * FROM article";

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