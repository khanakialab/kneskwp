/* 
    Core
    Global
*/
var debug = 1;
var $window, root, body, scrollTop;


window.sideNav = {
	open : function() {
	    document.getElementById("mySidenav").style.width = "250px";
	    document.getElementById("main").style.marginLeft = "250px";
		// document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
		document.body.classList.toggle('sideMenuOpened')

	},

	close : function() {
	    document.getElementById("mySidenav").style.width = "0";
	    document.getElementById("main").style.marginLeft= "0";
		// document.body.style.backgroundColor = "white";
		document.body.classList.toggle('sideMenuOpened')
	}
	
}



/* Core
   ----------------------------------------------------------------- */

var Core = {

    init: function() {
        $window = jQuery(window);
        root = jQuery('html, body');
        body = jQuery('body');
        $window.on('ready scroll', function() {
            scrollTop = $window.scrollTop();
        });
    }
};



var Shared = {
   
}    


var Global = {
    init: function() {
    
        function toggleIcon(e) {
            jQuery(e.target)
                .prev('.accHeading')
                .find(".more-less")
                .toggleClass('fa-minus fa-plus');
        }
        
        jQuery('.accordion').on('hidden.bs.collapse', toggleIcon);
        jQuery('.accordion').on('shown.bs.collapse', toggleIcon);


        jQuery(window).resize(function () {
            if (jQuery(window).width() > 1200) {
                jQuery("#mySidenav").css("width", "");
            }
        });

        
        this.sideNav()
        this.addIEclasses()
    
    },


    sideNav: function() {
        jQuery("#mySidenav .menu-item-has-children > a").click(function(){
            console.log('menu clicked')
            jQuery(this).parent().children('.sub-menu').toggle('fast')
        })
        
    },

    /**
* detect IE
* and add a specific class to the body
* function modified from this: http://stackoverflow.com/questions/19999388/check-if-user-is-using-ie-with-jquery
*/
addIEclasses : function() {
    var ua = window.navigator.userAgent;
    var b = "";
    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        b = "msie ie" + parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }
 
    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        b = "trident ie"+parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }
 
    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
        // Edge (IE 12+) => return version number
        b = "edge ie"+parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
 
    }
 
    // other browser
    if(b!="") {
        jQuery('body').addClass(b);
    }
}

}


var pageHome = {
    init: function() {
        
        // window.onload = function() {
        //     jQuery('#videoIframe').attr('src', 'https://www.youtube.com/embed/fhK3dtt05Gw?rel=0&modestbranding=0&showinfo=0&ps=docs');
        // }
    },
}


function responsiveTable() {
    // DIRTY Responsive pricing table JS
    jQuery( "article.pricing ul" ).on( "click", "li", function() {
        console.log('li clicked');
      var pos = jQuery(this).index()+2;
      jQuery("tr").find('td:not(:eq(0))').hide();
      jQuery('td:nth-child('+pos+')').css('display','table-cell');
      jQuery("tr").find('th:not(:eq(0))').hide();
      jQuery('li').removeClass('active');
      jQuery(this).addClass('active');
    });
  
    // Initialize the media query
      var mediaQuery = window.matchMedia('(min-width: 640px)');
  
      // Add a listen event
      mediaQuery.addListener(doSomething);
  
      // Function to do something with the media query
      function doSomething(mediaQuery) {    
        if (mediaQuery.matches) {
            jQuery('.sep').attr('colspan',5);
        } else {
            jQuery('.sep').attr('colspan',2);
        }
      }
  
      // On load
      doSomething(mediaQuery);
}

/* Start ------------------------------------- */

jQuery(function() {
    Core.init();
    Global.init();
    
    responsiveTable();
    if(body.hasClass("home")) {
        pageHome.init();
    }
});


