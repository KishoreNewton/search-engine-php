<?php
class DomDocumentParser{
    
    private $doc;
    
    public function __construct($url){
        $options = array('http'=>array('method'=>"GET", 'header'=>"User-Agent: findazBot/0.1\n"));
        $context = stream_context_create($options);
        $this->doc = new DomDocument();
        @$this->doc->loadHTML(file_get_contents($url, false, $context)); //@is don't show me any warrings
    }
    
    public function getlinks(){
        return $this->doc->getElementsByTagName("a"); //get all element of tag <a></a>
    }
    
    public function getTitletags(){
        return $this->doc->getElementsByTagName("title");
    }
    
    public function getMetaTags(){
        return $this->doc->getElementsByTagName("meta");
    }
    
    public function getImages(){
        return $this->doc->getElementsByTagName("img");
    }

    public function getVideos(){
        return $this->doc->getElementsByTagName("video");
    }

    public function getSource(){
        return $this->doc->getElementsByTagName("source");
    }
}

?>