<?php
require_once("config.php");
require_once("classes/SiteResultsProvider.php");
require_once("classes/ImageResultsProvider.php");
require_once("classes/VideoResultsProvider.php");
if(isset($_GET["term"])){
    $term = $_GET["term"];
} else {
    exit("You must enetr a search term");
}

$type = isset($_GET["type"]) ? $_GET["type"] : "sites";
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

if(isset($_GET["type"])){
    $type = $_GET["type"];
} else {
    $type = "sites";
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Finder</title>
<link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
<link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/masonry.js"></script>
    <script src="assets/js/jquery.fancybox.min.js"></script>
</head>
<body>
	<div class="wrapper search">
		<div class="header">
			<div class="headerContent">
				<div class="logoContainer">
					<a href="index.php">
						<img src="assets/icons/logo.png" alt="">
					</a>
				</div>
				<div class="searchContainer">
					<form action="search.php" method="GET">
						<div class="searchBarContainer">
                            <input type="hidden" name="type" value="<?php echo $type; ?>">
							<input type="text" class="searchBox" name="term" value="<?php echo $term ?>">
							<button class="searchButton"><img src="assets/icons/md-search.svg" alt="search" title="search"></button>
						</div>
					</form>
				</div>
			</div>
            
            <div class="tabsContainer">
                <ul class="tabList">
                    <li class="<?php echo $type == 'sites' ? 'active' : ""; ?>"><a href='<?php echo "search.php?term=$term&type=sites" ?>'>Sites</a></li>
                    <li class='<?php echo $type == 'images' ? 'active' : ""; ?>'><a href='<?php echo "search.php?term=$term&type=images" ?>'>Images</a></li>
                    <li class='<?php echo $type == 'videos' ? 'active' : ""; ?>'><a href='<?php echo "search.php?term=$term&type=videos" ?>'>Videos</a></li>
                </ul>
            </div> 
		</div>
        <div class="mainResultsSection">
            <?php
                if($type == "sites"){
                    $resultsProvider = new SiteResultsProvider($con);
                    $pageSize = 20;
                } elseif($type == "images"){
                    $resultsProvider = new ImageResultsProvider($con);
                    $pageSize = 100;
                } elseif($type == "videos"){
                    $resultsProvider = new VideoResultsProvider($con);
                    $pageSize = 100;
                }
               
                
                $numResults = $resultsProvider->getNumResults($term);
                echo "<p class='resultsCount'>$numResults results found</p>";      
                echo $resultsProvider->getResultsHtml($page, $pageSize, $term);                                                                    
            ?>  
        </div>
        <div class="paginationContainer">
            <div class="pageButtons">
                <div class="pageNumberContainer">
                    <img src='assets/icons/pageStart.png'>
                </div>
                <?php 
                $pagesToShow = 10;
                $numPages = ceil($numResults/$pageSize);
                $pagesLeft = min($pagesToShow, $numPages);
                $currentPage = $page - floor($pagesToShow/2);
                if($currentPage < 1){
                    $currentPage = 1;
                }
                if($currentPage + $pagesLeft > $numPages + 1){
                    $currentPage = $numPages + 1 - $pagesLeft;
                }
                while($pagesLeft != 0 && $currentPage <= $numPages){
                    if($currentPage == $page){
                         echo "<div class='pageNumberContainer'>
                                    <img src='assets/icons/pageSelected.png'>
                                    <span class='pageNumber'>$currentPage</span>
                                </div>";
                    } else {
                          echo "<div class='pageNumberContainer'>
                                    <a href='search.php?term=$term&type=$type&page=$currentPage'>
                                    <img src='assets/icons/page.png'>
                                    <span class='pageNumber'>$currentPage</span>
                                    </a>
                                </div>";
                    }
                    
                   
                    $currentPage++;
                    $pagesLeft--;
                }
                ?>
                <div class="pageNumberContainer">
                    <img src='assets/icons/pageEnd.png'>
                </div>
             
            </div>
        </div>
	</div>
</body>
    <!-- <script src="assets/js/index.js"></script> -->
    <script src="assets/js/script.js"></script>
</html>