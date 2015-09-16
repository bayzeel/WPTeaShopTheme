function resize(){

    if($("div").is(".main-slider")){
        if(window.innerWidth > 620){
            $(".main-slider").addClass("flexslider");
            $(".main-slider.flexslider").flexslider({
                animation: "slide",
                slideshow: true,
                animationLoop: true,
                controlNav: false,
                pauseOnHover: true,
                animationSpeed: 600,
                slideshowSpeed: 5000,
                start: function(slider){
                    $("body").removeClass("loading");
                }
            });
        }else if(window.innerWidth <= 620){
            if($(".main-slider.flexslider").data('flexslider')){
                $(".main-slider.main-slider").flexslider('destroy');
            }
            $(".main-slider").removeClass("flexslider");
        }
    }
    if (window.innerWidth > 1000){
        $(".main-slider .flex-direction-nav .flex-prev").css({left: (window.innerWidth - 1099) / 2 });
        $(".main-slider .flex-direction-nav .flex-next").css({left: "auto", right: (window.outerWidth - 1111) / 2 });
    }else{
        $(".main-slider .flex-direction-nav .flex-prev").css({left: 10 });
        $(".main-slider .flex-direction-nav .flex-next").css({left: "auto", right: 10 });
    }

}

$(document).ready(function(){

    resize();
    $(window).resize(resize);


    //$(".header .menu li").find("a").unwrap().unwrap().wrapAll("<div class='menu-inner'></div>");
    $(".header .menu a").slice(-1).addClass("last");
    //$(".header .menu a.last").text("");
    //$(".header .menu a.last").append("<span class='icon-cart'></span>");

    $(".header .menu a").slice(0, 1).wrapInner("<span class='line'></span>");
    $(".header .menu a span.line").append("<span class='caret'></span>");


    //var totalSummInCart = $(".total-cart-summ tr.cart-subtotal span.amount").text();
    //$(".header .menu a.last").append(totalSummInCart);

    $(".footer .menu li").find("a").unwrap().unwrap().wrapAll("<div class='menu-inner'></div>");

    $(".content-format ul li ").wrapInner("<div class='content'></div>");
    $(".content-format ul li ").prepend("<div class='marker'></div>");

    $(".header .menu-wrapper ul.menu > li").slice(-1).css({marginLeft: 0, marginRight: 0});
    var accum_width = 0;
    $(".header .menu-wrapper ul.menu > li").each(function() {
        accum_width += ($(this).width() + 39);
    });
    accum_width -= (($(".header .menu-wrapper ul.menu > li").slice(-1)).width() + 55);
    $(".header .menu-wrapper ul.menu").css({
                                        width: accum_width + (($(".header .menu-wrapper").width() - accum_width) / 2),
                                        paddingLeft: ($(".header .menu-wrapper").width() - accum_width) / 2
                                        });
    //alert($(".header .menu-wrapper").width());

    if($("div").is(".main-slider")){
        if(window.innerWidth > 620){
            $(".main-slider").addClass("flexslider");
            $(".main-slider.flexslider").flexslider({
                animation: "slide",
                slideshow: true,
                animationLoop: true,
                controlNav: false,
                pauseOnHover: true,
                animationSpeed: 600,
                slideshowSpeed: 5000,
                start: function(slider){
                    $("body").removeClass("loading");
                }
            });
        }else if(window.innerWidth <= 620){
            if($(".main-slider.flexslider").data('flexslider')){
                $(".main-slider.main-slider").flexslider('destroy');
            }
            $(".main-slider").removeClass("flexslider");
        }
    }

    function cloneAttributes($from, $to){
        $.each($from, function() {
            $to.attr(this.name, this.value);
        });
    }

    if($(".page-home li").is(".product")) {
        var firstPr = $(".index-products li.product").slice(0, 1);

        cloneAttributes(firstPr.find("img").prop("attributes"), $("div.extended-description .inner img"));
        $("div.extended-description .inner .left").css({
            float: "left",
            width: $("div.extended-description .inner .left img").width()
        });
        $("div.extended-description .inner .right").css({
            float: "left",
            width: ($("div.extended-description .inner").width() - $("div.extended-description .inner .left img").width() - 40)
        });

        firstPr.parent().parent().find("div.extended-description .inner .right h3 a").text("");
        firstPr.parent().parent().find("div.extended-description .inner .right h3 a").append(firstPr.find(".text-info h3").text());
        cloneAttributes(firstPr.find(".text-info .hide-link-with-copy-attr a").prop("attributes"), firstPr.parent().parent().find("div.extended-description .inner .right h3 a"));
        firstPr.parent().parent().find("div.extended-description .inner .right span.amount").text("");
        firstPr.parent().parent().find("div.extended-description .inner .right span.amount").append(firstPr.find(".text-info span.amount").text());
        $("div.extended-description .inner .right .excerpt").empty();
        firstPr.find(".text-info").find(".excerpt").children().clone(true, true).appendTo(firstPr.parent().parent().find("div.extended-description .inner .right .excerpt"));
        cloneAttributes(firstPr.find(".text-info").find("a.add_to_cart_button").prop("attributes"), $("div.extended-description .inner .right a.add_to_cart_button"));
        firstPr.parent().parent().find("div.extended-description .inner .right a.add_to_cart_button").text("");
        firstPr.parent().parent().find("div.extended-description .inner .right a.add_to_cart_button").append(firstPr.find(".text-info a.add_to_cart_button").text());

        var clickk = function () {
            $(".index-products li.product").click(function () {

                $(".index-products li.product").unbind();
                setTimeout(function () {
                    clickk();
                }, 4000);

                $(".index-products li.product").removeClass("active");
                $(this).addClass("active");

                $(this).parent().parent().find("div.extended-description").fadeIn(1800);
                $('html, body').animate({
                    scrollTop: $("div.extended-description").offset().top
                }, 800);
                //var posTopExtDesc = $("div.extended-description").offset().top;
                //window.scrollTo(0, posTopExtDesc - 270);

                var thiss = $(this);
                setTimeout(function () {
                    cloneAttributes(thiss.find("img").prop("attributes"), $("div.extended-description .inner img"));
                    $("div.extended-description .inner .left").css({
                        float: "left",
                        width: $("div.extended-description .inner .left img").width()
                    });
                    $("div.extended-description .inner .right").css({
                        float: "left",
                        width: ($("div.extended-description .inner").width() - $("div.extended-description .inner .left img").width() - 40)
                    });

                    thiss.parent().parent().find("div.extended-description .inner .right h3 a").text("");
                    thiss.parent().parent().find("div.extended-description .inner .right h3 a").append(thiss.find(".text-info h3").text());
                    cloneAttributes(thiss.find(".text-info .hide-link-with-copy-attr a").prop("attributes"), thiss.parent().parent().find("div.extended-description .inner .right h3 a"));
                    thiss.parent().parent().find("div.extended-description .inner .right span.amount").text("");
                    thiss.parent().parent().find("div.extended-description .inner .right span.amount").append(thiss.find(".text-info span.amount").text());
                    $("div.extended-description .inner .right .excerpt").empty();
                    thiss.find(".text-info").find(".excerpt").children().clone(true, true).appendTo(thiss.parent().parent().find("div.extended-description .inner .right .excerpt"));
                    cloneAttributes(thiss.find(".text-info").find("a.add_to_cart_button").prop("attributes"), $("div.extended-description .inner .right a.add_to_cart_button"));
                    thiss.parent().parent().find("div.extended-description .inner .right a.add_to_cart_button").text("");
                    thiss.parent().parent().find("div.extended-description .inner .right a.add_to_cart_button").append(thiss.find(".text-info a.add_to_cart_button").text());
                }, 1000);

                $(this).parent().parent().find("div.extended-description").append("<div class='bg-preload'></div>");
                $(this).parent().parent().find("div.extended-description .bg-preload").animate({opacity: 1}, 600);

                $(this).parent().parent().find("div.extended-description .imgs-preloader .preloader img").remove();
                $(this).parent().parent().find("div.extended-description .imgs-preloader .preloader").remove();
                $(this).parent().parent().find("div.extended-description .imgs-preloader").remove();
                $(this).parent().parent().find("div.extended-description").append("<div class='imgs-preloader'></div>");
                $(this).parent().parent().find("div.extended-description .imgs-preloader").append("<div class='preloader'></div>");
                var timestamp = new Date().getTime();
                $(this).parent().parent().find("div.extended-description .imgs-preloader .preloader").append("<img src='/wp-content/themes/teashop-dev-104/images/preloader-hor-empty.png' />");
                $(this).parent().parent().find("div.extended-description .imgs-preloader .preloader img").attr("src", "/wp-content/themes/teashop-dev-104/images/preloader-hor.gif" + "?" + timestamp);
                $(this).parent().parent().find("div.extended-description .imgs-preloader .preloader img").animate({
                    marginLeft: 0,
                    opacity: 1
                }, 1000);
                $("div.extended-description .nav-left, div.extended-description .nav-right").fadeOut(600);

                setTimeout(function () {
                    $("div.extended-description .preloader img").animate({opacity: 0}, 3000).remove();
                    $("div.extended-description .nav-left, div.extended-description .nav-right").fadeIn(600);
                    $("div.extended-description .imgs-preloader").remove();
                    $("div.extended-description .bg-preload").fadeOut("slow", function () {
                        $("div.extended-description .bg-preload").remove()
                    });
                }, 3450);

                $("div.extended-description i.delete-icon").remove();
                $("div.extended-description").append("<i class='delete-icon fa fa-times fa-2x'></i>");

                $("div.extended-description i.delete-icon").on("click", function () {
                    $("div.extended-description .bg-preload").fadeOut("slow", function () {
                        $("div.extended-description .bg-preload").remove();
                        $("div.extended-description .nav-left, div.extended-description .nav-right").fadeOut(600);
                    });
                    $(this).parent().parent().find("div.extended-description").fadeOut("slow");
                    $("div.extended-description").fadeOut("slow");
                    $(".index-products li.product").removeClass("active");

                    $('html, body').animate({
                        scrollTop: $("div.index-products").offset().top - 10
                    }, 800);
                });
            });
        };
        clickk();

        var eqLiProduct = $(".index-products li.product").eq(0);

        var clikkArrow = function () {
            $("div.extended-description .nav-arrows-ext-desc").click(function () {
                $("div.extended-description .nav-arrows-ext-desc").unbind();
                setTimeout(function () {
                    clikkArrow();
                }, 4000);

                if ($(this).hasClass("nav-left")) {
                    if ($(".index-products li.product").eq(0).hasClass("active")) {
                        var eqLiProduct = $(".index-products li.product").eq(2);
                    }
                    if ($(".index-products li.product").eq(1).hasClass("active")) {
                        var eqLiProduct = $(".index-products li.product").eq(0);
                    }
                    if ($(".index-products li.product").eq(2).hasClass("active")) {
                        var eqLiProduct = $(".index-products li.product").eq(1);
                    }
                }
                if ($(this).hasClass("nav-right")) {
                    if ($(".index-products li.product").eq(0).hasClass("active")) {
                        var eqLiProduct = $(".index-products li.product").eq(1);
                    }
                    if ($(".index-products li.product").eq(1).hasClass("active")) {
                        var eqLiProduct = $(".index-products li.product").eq(2);
                    }
                    if ($(".index-products li.product").eq(2).hasClass("active")) {
                        var eqLiProduct = $(".index-products li.product").eq(0);
                    }
                }


                $(".index-products li.product").removeClass("active");
                eqLiProduct.addClass("active");

                eqLiProduct.parent().parent().find("div.extended-description").fadeIn(1800);
                $('html, body').animate({
                    scrollTop: $("div.extended-description").offset().top
                }, 800);

                //var thiss = $(this);
                setTimeout(function () {
                    cloneAttributes(eqLiProduct.find("img").prop("attributes"), $("div.extended-description .inner img"));
                    $("div.extended-description .inner .left").css({
                        float: "left",
                        width: $("div.extended-description .inner .left img").width()
                    });
                    $("div.extended-description .inner .right").css({
                        float: "left",
                        width: ($("div.extended-description .inner").width() - $("div.extended-description .inner .left img").width() - 40)
                    });

                    eqLiProduct.parent().parent().find("div.extended-description .inner .right h3 a").text("");
                    eqLiProduct.parent().parent().find("div.extended-description .inner .right h3 a").append(eqLiProduct.find(".text-info h3").text());
                    cloneAttributes(eqLiProduct.find(".text-info .hide-link-with-copy-attr a").prop("attributes"), eqLiProduct.parent().parent().find("div.extended-description .inner .right h3 a"));
                    eqLiProduct.parent().parent().find("div.extended-description .inner .right span.amount").text("");
                    eqLiProduct.parent().parent().find("div.extended-description .inner .right span.amount").append(eqLiProduct.find(".text-info span.amount").text());
                    $("div.extended-description .inner .right .excerpt").empty();
                    eqLiProduct.find(".text-info").find(".excerpt").children().clone(true, true).appendTo(eqLiProduct.parent().parent().find("div.extended-description .inner .right .excerpt"));
                    cloneAttributes(eqLiProduct.find(".text-info").find("a.add_to_cart_button").prop("attributes"), $("div.extended-description .inner .right a.add_to_cart_button"));
                    eqLiProduct.parent().parent().find("div.extended-description .inner .right a.add_to_cart_button").text("");
                    eqLiProduct.parent().parent().find("div.extended-description .inner .right a.add_to_cart_button").append(eqLiProduct.find(".text-info a.add_to_cart_button").text());
                }, 1000);

                eqLiProduct.parent().parent().find("div.extended-description").append("<div class='bg-preload'></div>");
                eqLiProduct.parent().parent().find("div.extended-description .bg-preload").animate({opacity: 1}, 600);

                eqLiProduct.parent().parent().find("div.extended-description .imgs-preloader .preloader img").remove();
                eqLiProduct.parent().parent().find("div.extended-description .imgs-preloader .preloader").remove();
                eqLiProduct.parent().parent().find("div.extended-description .imgs-preloader").remove();
                eqLiProduct.parent().parent().find("div.extended-description").append("<div class='imgs-preloader'></div>");
                eqLiProduct.parent().parent().find("div.extended-description .imgs-preloader").append("<div class='preloader'></div>");
                var timestamp = new Date().getTime();
                eqLiProduct.parent().parent().find("div.extended-description .imgs-preloader .preloader").append("<img src='/wp-content/themes/teashop-dev-104/images/preloader-hor-empty.png' />");
                eqLiProduct.parent().parent().find("div.extended-description .imgs-preloader .preloader img").attr("src", "/wp-content/themes/teashop-dev-104/images/preloader-hor.gif" + "?" + timestamp);
                eqLiProduct.parent().parent().find("div.extended-description .imgs-preloader .preloader img").animate({
                    marginLeft: 0,
                    opacity: 1
                }, 1000);
                $("div.extended-description .nav-left, div.extended-description .nav-right").fadeOut(600);

                setTimeout(function () {
                    $("div.extended-description .preloader img").animate({opacity: 0}, 3000).remove();
                    $("div.extended-description .nav-left, div.extended-description .nav-right").fadeIn(600);
                    $("div.extended-description .imgs-preloader").remove();
                    $("div.extended-description .bg-preload").fadeOut("slow", function () {
                        $("div.extended-description .bg-preload").remove()
                    });
                }, 3450);

                $("div.extended-description i.delete-icon").remove();
                $("div.extended-description").append("<i class='delete-icon fa fa-times fa-2x'></i>");

                $("div.extended-description i.delete-icon").on("click", function () {
                    $("div.extended-description .bg-preload").fadeOut("slow", function () {
                        $("div.extended-description .bg-preload").remove();
                        $("div.extended-description .nav-left, div.extended-description .nav-right").fadeOut(600);
                    });
                    eqLiProduct.parent().parent().find("div.extended-description").fadeOut("slow");
                    $("div.extended-description").fadeOut("slow");
                    $(".index-products li.product").removeClass("active");

                    $('html, body').animate({
                        scrollTop: $("div.index-products").offset().top - 10
                    }, 800);
                });

            });
        }
        clikkArrow();
    }

    $("div.extended-description a.add_to_cart_button").on("click", function(){
        setTimeout(function() {
            window.location = "cart/";
        }, 500);
    });

    $(".mailing-form form .sign-up-email input").keyup(function (e) {
        if (e.keyCode != "") {
            $(".mailing-form form .sign-up-email input").css({fontFamily: "BrownRegular", color: "#222222"});
        }if(e.keyCode == "" || e.keyCode == 8) {
            $(".mailing-form form .sign-up-email input").css({fontFamily: "BrownRegularReclining", color: "#999999"});
        }
    });

    /*shop page*/
    // http://stackoverflow.com/questions/3366529/wrap-every-3-divs-in-a-div
    var shopProduct = $(".shop-product");
    for(var i = 0; i < shopProduct.length; i+=3) {
        shopProduct.slice(i, i+3).wrapAll("<div class='shop-products-row'></div>");
    }
    /*end shop page*/


});