<?php
class VideoResultsProvider{
    
    private $con;
    
    public function __construct($con){
        $this->con = $con;
    }
    
    public function getNumResults($term){
        $query = $this->con->prepare("SELECT COUNT(*) AS total FROM videos WHERE title LIKE :term");
        $searchTerm = "%".$term."%";
        $query->bindParam(":term", $searchTerm);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row["total"];
    }
    
    public function getResultsHtml($page, $pageSize, $term){
        
        $fromLimit = ($page - 1) * $pageSize;
        // page 1: (1 - 1) * 20 = 0
        // page 1: (2 - 1) * 20 = 20
        // page 1: (3 - 1) * 20 = 40
        
        
        $query = $this->con->prepare("SELECT * FROM videos WHERE title LIKE :term ORDER BY clicks DESC LIMIT :fromLimit, :pageSize");
        $searchTerm = "%".$term."%";
        $query->bindParam(":term", $searchTerm);
        $query->bindParam(":fromLimit", $fromLimit, PDO::PARAM_INT);
        $query->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
        $query->execute();
        
        $resultsHtml = "<div class='imageResults'>";
        
        $count = 0;
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $count++;
            $id = $row["id"];
            $imageUrl = $row["imageUrl"];
            $siteUrl = $row["siteUrl"];
            $title = $row["title"];
            $alt = $row["alt"];
            
            if($title){
                $displayText = $title;
            } else if($alt){
                $displayText = $alt;
            } else{
                $displayText = $imageUrl;
            }
            
            $resultsHtml .= "<div>
                                For YouTube video crawling visit https://developers.google.com/youtube
                            </div>";
        }
        
        $resultsHtml .= "</div>";
        return $resultsHtml;
    }
}
?>













