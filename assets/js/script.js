// JavaScript Document

var timer;

$(document).ready(function(){
   $(".result").on("click", function(){
       
       var id = $(this).attr("data-linkId");
       var url = $(this).attr("href");
       
       if(!id){
           alert("data-linkId attribute not found");
       }
       
       increaseLinkClicks(id, url);
       return false;
   });
    
    var grid = $(".imageResults");
    
    grid.on("layoutComplete", function(){
        $(".gridItem img").css("visibility", "visible")
    });
    
    grid.masonry({
      columnWidth: 200,
      itemSelector: '.gridItem',
      gutter: 5,
      isInitLayout: false,
    });
    
    $("[data-fancybox]").fancybox({
        caption : function( instance, item ) {
            var caption = $(this).data('caption') || '';
            var siteUrl = $(this).data('siteurl') || '';

            if ( item.type === 'image' ) {
                caption = (caption.length ? caption + '<br />' : '') 
                    + '<a href="' + item.src + '">View Image</a><br>'
                    +  '<a href="' + siteUrl + '">View Page</a><br>' ;
            }

            return caption;
        },
        afterShow : function(instance, item){
            increaseIinkClicks(item.src);
        }

    });
    
});

function loadImage(src, className){
    var image = $("<img>");
    image.on("load", function(){
        $("." + className + " a").append(image);
        
        clearTimeout(timer);
        
        timer = setTimeout(function(){
            $(".imageResults").masonry();
        }, 100);
        
        
    });

    image.on("error", function(){
        $("." + className).remove();
        
        $.post("ajax/setBroken.php", {src: src});
    });
    
    image.attr("src", src);
    
}

function increaseLinkClicks(linkId, url){
    $.post("ajax/updateLinkCount.php", {linkId: linkId})
    .done(function(result){
       if(result != "") {
           alert(result);
           return;
       }
        window.location.href = url;
    });
}

function increaseIinkClicks(imageUrl){
    $.post("ajax/updateImageCount.php", {imageUrl: imageUrl})
    .done(function(result){
       if(result != "") {
           alert(result);
           return;
       }
        window.location.href = url;
    });
}