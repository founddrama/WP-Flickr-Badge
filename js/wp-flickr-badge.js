flickr={onHover:function(){var b,a=$("#flickr_www_wrapper");$(".flickr_badge_image").hover(function(){b=$(this).children("a").children("img");var c=$(this).find("img").attr("title");b.css({border:"4px solid #ff1c92",margin:"-4px",zIndex:"200"});a.fadeOut("slow",function(){a.empty().append(c).fadeIn("slow")})},function(){b.css({border:"none",margin:"0",zIndex:"100"});a.fadeOut("fast",function(){a.empty().append('flick<span style="color:#ff1c92;">r</span>').fadeIn("fast")})})}};$(flickr.onHover);