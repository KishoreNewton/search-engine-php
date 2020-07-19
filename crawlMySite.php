<?php
require_once("config.php");
require_once('header.php');
?>
<div class="wrapper indexPage">
	<div class="mainSection">
        <h2>In robots.txt</h2>
        <h4 class="left">"User-agent: findazBot/0.1 Disallow:"</h4>
        <h4 class="left"> </h4>

		<div class="searchContainer">
			<form action="crawl.php" method="POST">
				<input type="text" name="website" class="searchBox" required>
				<div>
					<input type="submit" value="Crawl My Website" class="searchButton">
				</div>
			</form>
		</div>
	</div>
</div>
