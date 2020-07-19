<?php
require_once("config.php");
require_once('header.php');
?>
<div class="wrapper indexPage">
	<div class="mainSection">
        <h2>In robots.txt</h2>
        <h4 class="left">"User-agent: findazBot/0.1 Disallow:"</h4>
        <h6 class="left">Crawling takes time depending on data or deep links in webpage</h6>

		<div class="searchContainer">
			<form action="crawl.php" method="POST">
                <h3 id="warn"></h3>
				<input type="text" id="crawl" name="website" class="searchBox" required>
				<div>
					<input id="submit" type="submit" value="Crawl My Website" class="searchButton">
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    document.getElementById('crawl').addEventListener("input", (e) => {
        if(e.target.value.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g)){
            document.getElementById('submit').style.display = "block"
            document.getElementById('warn').innerText = ""
        } else {
            document.getElementById('submit').style.display = "none"
            document.getElementById('warn').innerText = 'Please enter a valid url'
        }
    })
</script>
<script src="assets/js/index.js"></script>