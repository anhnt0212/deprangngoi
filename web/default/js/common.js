/**
 * Created by JOBZREFER on 11/21/2016.
 */
Number.prototype.format = function (n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
var App = {
    advInit: function () {
        var slideInterval;
        STEP_SLIDE_SCROLL = 5;

        function effectSlide() {
            var slideLeft = $("#slide-left");
            var slideRight = $("#slide-right");
            var start = slideLeft.position().top;
            var end = $(window).scrollTop() + ($(window).height() - slideLeft.height()) / 2;

            clearInterval(slideInterval);

            slideInterval = setInterval(function () {
                if (start + STEP_SLIDE_SCROLL < end) {
                    slideLeft.css("top", start += STEP_SLIDE_SCROLL);
                    slideRight.css("top", start);
                } else if (start > end + STEP_SLIDE_SCROLL) {
                    if (start - STEP_SLIDE_SCROLL <= 200) {
                        return;
                    }

                    slideLeft.css("top", start -= STEP_SLIDE_SCROLL);
                    slideRight.css("top", start);
                }
            }, 10);
        }

        var slideLeftInterval, slideRightInterval;

        function checkSlide() {
            var slideLeft = $("#slide-left");
            var slideRight = $("#slide-right");
            var wapper = $(".wrapper").width();
            var w = $(window);

            if (w.width() < wapper + slideLeft.width() + slideRight.width()) {
                slideLeft.hide();
                slideRight.hide();
            } else {
                slideLeft.css("left", (w.width() - wapper - 15) / 2 - slideLeft.width());
                slideRight.css("right", (w.width() - wapper - 20) / 2 - slideRight.width());
                effectSlide();
                slideLeft.show();
                slideRight.show();
            }
        }

        $(document).ready(function () {
            window.onscroll = effectSlide;
            window.onresize = checkSlide;
            checkSlide();

            var clear = setInterval(function () {
                checkSlideMiddle();
                clearInterval(clear);
            }, 1000);
        });

        function checkSlideMiddle() {
            var w = $(window);

            var slideMiddle = $("#slide-middle");
            var markSlideMiddle = $(".mark-slide-middle");
            var href = window.location.href;

            if (href.indexOf(".htm") == -1 && slideMiddle.children().length > 0) {
                slideMiddle.css("top", (w.height() - slideMiddle.height()) / 2);
                slideMiddle.css("left", (w.width() - slideMiddle.width()) / 2);
                markSlideMiddle.fadeIn("slow");
                slideMiddle.fadeIn("slow");
            }

            markSlideMiddle.click(function () {
                $(this).remove();
                slideMiddle.remove();
            });

            $(window).keyup(function (e) {
                if (e.keyCode == 27) {
                    $(".mark-slide-middle").remove();
                    $("#slide-middle").remove();
                }
            });
        }

    },
    bxSlider: function () {
        $(document).ready(function () {
            $('.sliders').bxSlider({});
        });
    },
    loadCity: function () {
        $('select[name="city_trans"]').change(function () {
            var city_code = $(this).find(":selected").val();
            if (city_code) {
                jQuery.ajax({
                    type: "POST",
                    url: $('input[name="base_url"]').val() + '/_ajax/get_data/load_city',
                    data: {'city_code': city_code},
                    success: function (response) {
                        var $json = jQuery.parseJSON(response);
                        if ($json.status == 200) {
                            $('select[name="dist_trans"]').html($json.html);
                            $('select[name="dist_trans"]').removeAttr('disabled');
                            App.changePrice();
                        } else {
                            alert($json.message);
                            return false
                        }
                    },
                    error: function () {
                        alert('Hệ thống quá tải,thử lại sau');
                    }
                });
            }
            return false;
        });
    },
    changePrice: function () {
        var shipPrice = parseFloat($('select[name="dist_trans"]').find(":selected").val());
        var productTotal = parseFloat($('input[name="priceTotal"]').val());
        var total = parseFloat(shipPrice+productTotal);
        $('#shipPrice').text((shipPrice.format())+'VNĐ');
        $('#total').text((total.format())+'VNĐ');
        $('input[name="totalCard"]').val(total);
        $('input[name="shipPrice"]').val(shipPrice);
    }
};

$(document).ready(function () {
    App.advInit();
    App.bxSlider();
    App.loadCity();
    $('.search-panel .dropdown-menu').find('a').click(function (e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#", "");
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);
    });
    $('.navbar a.dropdown-toggle').on('click', function (e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');

        if (!$parent.parent().hasClass('nav')) {
            $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
        }

        $('.nav li.open').not($(this).parents("li")).removeClass("open");

        return false;
    });
});