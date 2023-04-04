$(document).ready(function() {
    //  SLIDER
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  ZOOM PRODUCT DETAIL
    $("#zoom").elevateZoom({ gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif' });

    //  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SCROLL TOP
    $(window).scroll(function() {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function() {
        $('body,html').stop().animate({ scrollTop: 0 }, 800);
    });

    // CHOOSE NUMBER ORDER
    var value = parseInt($('#num-order').attr('value'));
    $('#plus').click(function() {
        value++;
        $('#num-order').attr('value', value);
        update_href(value);
    });
    $('#minus').click(function() {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
        update_href(value);
    });

    //  MAIN MENU
    $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

    //  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function(event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function() {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });

    //  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function() {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {

            //            $('.sub-menu').slideUp();
            //            $('#main-menu-respon li').removeClass('open');
            $(this).parent('li').addClass('open');
            //            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });
});

function tab() {
    var tab_menu = $('#tab-menu li');
    tab_menu.stop().click(function() {
        $('#tab-menu li').removeClass('show');
        $(this).addClass('show');
        var id = $(this).find('a').attr('href');
        $('.tabItem').hide();
        $(id).show();
        return false;
    });
    $('#tab-menu li:first-child').addClass('show');
    $('.tabItem:first-child').show();
}
// $(document).ready(function() {
//     $('#lightSlider').lightSlider({
//         gallery: true,
//         item: 1,
//         loop: true,
//         slideMargin: 0,
//         thumbItem: 9
//     })
// })
// $(document).ready(function() {
//     $('#imageGallery').lightSlider({
//         gallery: true,
//         item: 1,
//         loop: true,
//         thumbItem: 5,
//         slideMargin: 0,
//         enableDrag: false,
//         currentPagerPosition: 'left',
//         onSliderLoad: function(el) {
//             el.lightGallery({
//                 selector: '#imageGallery .lslide'
//             });
//         }
//     });
// });
$(document).ready(function() {
    console.log('xin chào')
    $(".num-order").change(function() {
        console.log('Đã thay đổi')
        let rowId = $(this).attr('data-id');
        let qty = $(this).val();
        let price = $(".price-" + rowId).attr('data-price');
        let url = $("#form-add").attr('data-url');
        // console.log(num_order);
        let data = { qty: qty, price: price, "_token": $("meta[name='csrf-token']").attr("content"), rowId: rowId }
        console.log(data);
        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $("#qty").text(data.qty)
                $("#num").text(data.count)
                $("#count").text(data.count)
                $("#sub-total-" + rowId).text(data.total)
                $("#total-price span").text(data.sub_total)
                $("#total").text(data.sub_total)
                console.log(data.sub_total)
            },
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    });
})
$(document).ready(function() {
    $('#sort').on('change', function() {
        var url = $(this).val();
        console.log(url);
        if (url) {
            window.location = url
        }
        return false
    })

})
$(document).ready(function() {
    $('#myForm input').on('change', function() {
        var url = $('input[name=r-price]:checked', '#myForm').val();
        console.log(url);
        if (url) {
            window.location = url
        }
        return false
    })

})

$(document).ready(function() {
    $('#search').keyup(function() {
        var url = $("#search-wp").attr('data-url');
        var query = $(this).val();
        // console.log(url)
        // alert(query)
        if (query != '') {
            $.ajax({
                url: url,
                method: "POST",
                data: { query: query, "_token": $("meta[name='csrf-token']").attr("content") },
                success: function(data) {
                    console.log(data);
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            })
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
        } else {
            $('#search_ajax').fadeOut();
        }
    });
    $(document).on('click', 'li', function() {
        $('#s').val($(this).text());
        $('#search_ajax').fadeOut();
    })
})

$(document).ready(function() {
    $('#province').on('change', function() {
        // alert('Please enter')
        var province_id = $(this).val();
        // console.log(province_id);
        let url = $("#province").attr('data-url');
        // console.log(url);
        if (province_id) {
          // If a province is selected, fetch the districts for that province using AJAX
          $.ajax({
            url: url,
            method: 'GET',
            dataType: "json",
            data: {
              province_id: province_id
            },
            success: function(data) {
            //   // Clear the current options in the "district" select box
              $('#district').empty();
            console.log(data);

              // Add the new options for the districts for the selected province
              $.each(data, function(i, district) {
                // console.log(district);
                $('#district').append($('<option>', {
                  value: district.district_id,
                  text: district.name
                }));
              });
              // Clear the options in the "wards" select box
              $('#wards').empty();
            },
            error: function(xhr, textStatus, errorThrown) {
              console.log('Error: ' + errorThrown);
            }
          });
          $('#wards').empty();
        } else {
          // If no province is selected, clear the options in the "district" and "wards" select boxes
          $('#district').empty();
        }
      });

      $('#district').on('change', function() {
        var district_id = $(this).val();
        let url = $("#district").attr('data-url');
        // console.log(district_id);
        if (district_id) {
          // If a district is selected, fetch the awards for that district using AJAX
          $.ajax({
            url: url,
            method: 'GET',
            dataType: "json",
            data: {
              district_id: district_id
            },
            success: function(data) {
              console.log(data);
              // Clear the current options in the "wards" select box
              $('#wards').empty();
              // Add the new options for the awards for the selected district
              $.each(data, function(i, wards) {
                $('#wards').append($('<option>', {
                  value: wards.wards_id,
                  text: wards.name
                }));
              });
            },
            error: function(xhr, textStatus, errorThrown) {
              console.log('Error: ' + errorThrown);
            }
          });
        } else {
          // If no district is selected, clear the options in the "award" select box
          $('#wards').empty();
        }
      });
})
