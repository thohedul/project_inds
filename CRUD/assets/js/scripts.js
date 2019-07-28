wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    
    
    $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
    
    
    $(document).ready(function() {
              var owl = $('.owl-carousel');
              owl.owlCarousel({
                items: 3,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true
              });
              $('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [1000])
              })
              $('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
              })
            });
            
            //}p],m._d.O^o
            //aHMfHaf8u3H=
  $(function () {
        $('#js-news').ticker({
            speed: 0.10,
            titleText: 'PHP97 News'
        });
    });
    
    //[]iC2TLWcf+^
    
    
    //ypfOne
    //password:oW.7c;}_=?bH