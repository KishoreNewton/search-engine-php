<?php
 require_once('header.php');
 ?>
<div class="wrapper indexPage">
	<div class="mainSection">
		<div class="logoContainer">
			<img src="assets/icons/logo.png" alt="">
		</div>
		<div class="searchContainer">
			<form action="search.php" method="GET">
				<input type="text" name="term" class="searchBox" required>
				<div>
					<input type="submit" value="Search" class="searchButton">
					<a class="searchButton" href="crawlMySite.php">Crawl My Website</a>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
<script src="assets/js/index.js"></script>
</html>