$(function(){
    // Image Fade
    $(".imageFade").hover(function(){
        $(this).fadeTo(300,0.8);
    },function(){
        $(this).fadeTo(300,1);
    });
    // Slick Customize
    $("#mainVisualImag").slick({
		autoplay: true,
		autoplayspeed:300,
		speed: 500,
		cssEase: 'ease-in',
        arrows: false,
        dots: true,
		fade:true,
    });
    $(window).on('load resize', function(){
        var windowWidth = $(window).width();
        if(windowWidth < 860){
            if(!$("#mainSlide").hasClass('slick-initialized')) {
                $("#mainSlide").slick({
                    arrows: true,
                    dots: false
                });
            }
        } else {
            if ($("#mainSlide").hasClass('slick-initialized')) {
                $("#mainSlide").slick('unslick');
            }
        }
    });
    $("#rentSlider").slick({
        arrows: false,
        dots: true,
		autoplay: true,
		autoplayspeed:400
		    });
			
    $("#rankingNewlyBuiltSlide").slick({
        slidesToShow: 5,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 1069,
                settings: {
                    slidesToShow: 3,
                    initialSlide: 1,
                    centerMode: true,
                    arrows: false
                }
            },
            {
                breakpoint: 790,
                settings: {
                    slidesToShow: 2,
                    initialSlide: 1,
                    centerMode: true,
                    arrows: false
                }
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 2,
                    arrows: false
                }
            }
        ]
    });
    $("#rankingNewlyBuiltSlidePrimary").slick({
        slidesToShow: 5,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 1069,
                settings: {
                    slidesToShow: 3,
                    initialSlide: 1,
                    centerMode: true,
                    arrows: false
                }
            },
            {
                breakpoint: 790,
                settings: {
                    slidesToShow: 2,
                    initialSlide: 1,
                    centerMode: true,
                    arrows: false
                }
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 2,
                    arrows: false
                }
            }
        ]
    });
    $("#rankingNewlyBuiltSlideSecondary").slick({
        slidesToShow: 5,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 1069,
                settings: {
                    slidesToShow: 3,
                    initialSlide: 1,
                    centerMode: true,
                    arrows: false
                }
            },
            {
                breakpoint: 790,
                settings: {
                    slidesToShow: 2,
                    initialSlide: 1,
                    centerMode: true,
                    arrows: false
                }
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 2,
                    arrows: false
                }
            }
        ]
    });
    $("#rankingNewlyBuiltSlideTertiary").slick({
        slidesToShow: 5,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 1069,
                settings: {
                    slidesToShow: 3,
                    initialSlide: 1,
                    centerMode: true,
                    arrows: false
                }
            },
            {
                breakpoint: 790,
                settings: {
                    slidesToShow: 2,
                    initialSlide: 1,
                    centerMode: true,
                    arrows: false
                }
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 2,
                    arrows: false
                }
            }
        ]
    });


    $("#rentTenantSlide").slick({
        arrows: false,
        dots: true
    });
    $("#searchDetailVisualPrimarySlide").slick({
        arrows: true,
        dots: false,
        asNavFor: '#searchDetailVisualPrimarySlideNav'
    });
    $('#searchDetailVisualPrimarySlideNav').slick({
        dots: false,
        slidesToShow: 9,
        slidesToScroll: 1,
        asNavFor: '#searchDetailVisualPrimarySlide',
        arrows:  true,
        focusOnSelect: true
    });

	$(document).on('click', '.footer-search__container',function(){
		if(navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)){
        $('.footer-search__list',this).slideToggle();
		}
    });

    new WOW().init();

    // Range Slider Customize
    $('#jqueryUiSliderRent').slider({
        range: true,
        values: [0, 100],
        min: 0,
        max: 100,
        slide: function (event, ui) {
            $('#top_search6').val(ui.values[0] * 10000);
            $('#jqueryUiSliderValuesPrimary').empty().append(ui.values[0] + "荳��");
            $('#top_search7').val(ui.values[1] * 10000);
            $('#jqueryUiSliderValuesSecondary').empty().append(ui.values[1] + "荳��");
        }
    });
    $('#top_search6').val($('#jqueryUiSliderRent').slider('values', 0) * 10000);
    $('#jqueryUiSliderValuesPrimary').empty().append($('#jqueryUiSliderRent').slider('values', 0) + "荳��");
    $('#top_search7').val($('#jqueryUiSliderRent').slider('values', 1) * 10000);
    $('#jqueryUiSliderValuesSecondary').empty().append($('#jqueryUiSliderRent').slider('values', 1) + "荳��");

    $('#jqueryUiSliderArea').slider({
        range: true,
        values: [0, 100],
        min: 0,
        max: 100,
        slide: function (event, ui) {
            $('#top_search9').val(ui.values[0]);
            $('#jqueryUiSliderValuesTertiary').empty().append(ui.values[0] + "m2");
            $('#top_search10').val(ui.values[1]);
            $('#jqueryUiSliderValuesQuaternary').empty().append(ui.values[1] + "m2");
        }
    });
    $('#top_search9').val($('#jqueryUiSliderArea').slider('values', 0));
    $('#jqueryUiSliderValuesTertiary').empty().append($('#jqueryUiSliderArea').slider('values', 0) + "m2");
    $('#top_search10').val($('#jqueryUiSliderArea').slider('values', 1));
    $('#jqueryUiSliderValuesQuaternary').empty().append($('#jqueryUiSliderArea').slider('values', 1) + "m2");


  //荳ｦ縺ｹ譖ｿ縺医う繝吶Φ繝�
      $('#area_link_box').on('click', function() {
        $('#area_link_box').fadeOut("slow");
      });
      $('select#sort_select').on('change', function() {
        if ($('select#sort_select').val() != 'none') {
          $('form#sort_select_form').submit();
          $('form#sort_select_form').empty();
          $('form#sort_select_form').append('<p><img class="img-responsive" src="../../common/img/rent-tenant-detail/now_loading.gif"></p>');
        }
      });
      $('select#sort_select_sub').on('change', function() {
        if ($('select#sort_select').val() != 'none' && $('select#sort_select_sub').val() != 'none') {
          $('form#sort_select_form').submit();
          $('form#sort_select_form').empty();
		  $('form#sort_select_form').append('<p><img class="img-responsive" src="../../common/img/rent-tenant-detail/now_loading.gif"></p>');
        }
      });

});