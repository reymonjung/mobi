<script type="text/javascript">
var curnetIndex="";
var flag = [true,true,true,true,true,true];


$(document).ready(function() { 
    var jssor_1_options = {
      $AutoPlay: false,
        $ThumbnailNavigatorOptions: {
        $Class: $JssorThumbnailNavigator$,              
        $Cols: 5,
        $Align: 0,
        $NoDrag: true
      }
    };

    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
        

        
    swipedetect(document.getElementById('jssor_1'));

        
        //console.log(          jssor_1_slider.$CurrentIndex());
    

    
        /*responsive code begin*/
        /*you can remove responsive code if you don't want the slider scales while window resizing*/



    function OnSlidePark(slideIndex, fromIndex) {

        console.log(slideIndex+"//"+fromIndex);
        if(slideIndex==3) $("#ca3_menu").show();
        if(slideIndex == fromIndex) return ; 

        if(!fromIndex && !slideIndex) return ;
        curnetIndex=slideIndex;
        $('html, body').animate({scrollTop : 0});
        $("header .menu ul li:nth-child("+(fromIndex+1)+") a").removeClass('active')
        if(flag[slideIndex]){
            flag[slideIndex]=false;
            
            $.ajax({
                type: "GET", 
                async: true,
                data: {mem_link:js_mem_link[slideIndex]},
                url: js_mem_link[slideIndex], 
                cache: false,
                beforeSend: function () {
                    $("#div_ajax_load_image").show();
                         
                },
                complete: function () {
                            
                    $("#div_ajax_load_image").fadeOut();
                },
                success: function(data) 
                {                     
                 // createFile(data.tag,value+'.php');


                    $("#"+js_swipe_contents[slideIndex]).html(data).promise().done(function(){
                      $("#div_ajax_load_image").fadeOut();
                      $("header .menu ul li:nth-child("+(slideIndex+1)+") a").addClass('active');
                      
                      if(slideIndex==3) $("#ca3_menu").show();
                      else $("#ca3_menu").hide();
                      
                      


                      $('html , body').scrollTop('top' , '0');
                    });
                },
                error: function(xhr, status, error) { ; } 
            });

            
      //  shopAjax.forEach(ShowShop);
                
            
            
        } else {

            if(slideIndex==3) $("#ca3_menu").show();
            else $("#ca3_menu").hide();

            

            $("header .menu ul li:nth-child("+(slideIndex+1)+") a").addClass('active');
            $('html , body').scrollTop('top' , '0');
        }


    }

//    $(window).bind("load", OnSlidePark);
 //   $(window).bind("resize", OnSlidePark);



    
    jssor_1_slider.$On($JssorSlider$.$EVT_PARK, OnSlidePark);
    $("#div_ajax_load_image").fadeOut('slow');


});

function reload_rg(val){

  //if(!val2) return;
  console.log('val'+val);
  $('#jssor_1').height($('#'+val).height()+53);
  $('#jssor_1>div>div').height($('#'+val).height()+53);


}

function swipedisable_rg(){
    swipedisable(document.getElementById('bxslider'));
    // swipedisable(document.getElementById('banner_01'));
    // swipedisable(document.getElementById('banner_02'));
    // swipedisable(document.getElementById('banner_03'));
}

function swipedetect(el, callback){

   var touchsurface = el,
   swipedir,
   startX,
   startY,
   distX,
   distY,
   threshold = 100, //required min distance traveled to be considered swipe
   restraint = 80, // maximum distance allowed at the same time in perpendicular direction
   allowedTime = 500, // maximum time allowed to travel that distance
   elapsedTime,
   startTime,
   handleswipe = callback || function(swipedir){}

   touchsurface.addEventListener('touchstart', function(e){
    reload_rg(js_swipe_contents[curnetIndex]);
    var touchobj = e.changedTouches[0]
    swipedir = 'none'
    dist = 0
    startX = touchobj.pageX
    startY = touchobj.pageY
    startTime = new Date().getTime() // record time when finger first makes contact with surface
  //  e.preventDefault()

   }, false)

   touchsurface.addEventListener('touchmove', function(e){

        var touchobj = e.changedTouches[0]
    distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
    distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
    elapsedTime = new Date().getTime() - startTime // get time elapsed
    if (elapsedTime <= allowedTime){ // first condition for awipe met

     if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
      swipedir = (distX < 0)? 'left' : 'right' // if dist traveled is negative, it indicates left swipe
     }
     else if (Math.abs(distY) >= threshold && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
      swipedir = (distY < 0)? 'up' : 'down' // if dist traveled is negative, it indicates up swipe
     }
    }


  if(swipedir=='up' || swipedir=='down' || swipedir=='none' ){
          e.stopPropagation();
  }
   


  //  e.preventDefault() // prevent scrolling when inside DIV
   }, false)

   touchsurface.addEventListener('touchend', function(e){

    var touchobj = e.changedTouches[0]
    distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
    distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
    elapsedTime = new Date().getTime() - startTime // get time elapsed
    if (elapsedTime <= allowedTime){ // first condition for awipe met
     if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
      swipedir = (distX < 0)? 'left' : 'right' // if dist traveled is negative, it indicates left swipe
     }
     else if (Math.abs(distY) >= threshold && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
      swipedir = (distY < 0)? 'up' : 'down' // if dist traveled is negative, it indicates up swipe
     }
    }


  //  handleswipe(swipedir)
  //  e.preventDefault()
   }, false)

      return touchsurface;
}






function swipedisable(el, callback){

  var touchsurface = el,
  handleswipe = callback || function(swipedir){}

  touchsurface.addEventListener('touchstart', function(e){

  //e.preventDefault();
    e.stopPropagation();
  }, false)

  touchsurface.addEventListener('touchmove', function(e){
  //e.preventDefault();
  e.stopPropagation();
  }, false)

  touchsurface.addEventListener('touchend', function(e){
  //e.preventDefault(); 
  e.stopPropagation();

  }, false)

  return touchsurface;
}
</script>


<div id="jssor_1" style="height:2000px;">

  <div data-u="slides">
<?php

//광고영역






if (element('menu', $layout)) {
    $menu = element('menu', $layout);
    if (element(0, $menu)) {
        foreach (element(0, $menu) as $mkey => $mval) {


          echo '
          <div class="backPannel" >
            <div style="position:absolute;top:0px;left:0px; z-index:0;">
              <div style="overflow: hidden; ">
                <div  id="contents_'.$mkey.'">
                </div>          
              </div>
            </div>
            <div data-u="thumb">'.html_escape(element('men_name', $mval)).'</div>
          </div>
          ';
        }
    }
}
?>
</div>



    <!-- Thumbnail Navigator -->
  <div data-u="thumbnavigator" class="jssort12"> 
    <!-- Thumbnail Item Skin Begin -->
    <div data-u="slides" style="cursor: default; top: 0px; left: 0px; border-left: 1px solid gray;">
      <div data-u="prototype" class="p">
        <div class="w">
          <div data-u="thumbnailtemplate" class="c">
           
          </div>
        </div>
      </div>
    </div>
    <!-- Thumbnail Item Skin End --> 
  </div>
</div>

