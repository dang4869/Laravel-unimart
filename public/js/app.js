$(document).ready(function() {
    // $("#sidebar-menu").on('click', '.nav-link', function() {
    //     $("#sidebar-menu .nav-link.active").removeClass("active");
    //     $(this).addClass("active");
    // });
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });
});

$(document).ready(function() {
    load_gallery()

    function load_gallery() {
        let pro_id = $('.pro_id').val();
        let _token = $('input[name="_token"]').val();
        let url = $("#gallery-load").attr('data-url');
        // alert(pro_id);
        $.ajax({
            url: url,
            method: 'POST',
            data: { pro_id: pro_id, _token: _token },
            // dataType: 'json',
            success: function(data) {
                // console.log(data)
                $('#gallery-load').html(data)
                    // console.log(data)
            },
        });
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        // });
    }
    $('#file').change(function() {
        console.log('Đã thay đổi')
        let error = ''
        let files = $('#file')[0].files;
        if (files.length > 5) {
            error += '<p>Bạn chọn tối đa được 5 ảnh</p>'
        } else if (files.length == '') {
            error += '<p>Bạn không được bỏ trống ảnh</p>'
        } else if (files.size > 2000000) {
            error += '<p>File ảnh không được lớn hơn 2MB</p>'
        }
        if (error == '') {

        } else {
            $('#file').val('')
            $('#error_gallery').html('<span class="text-danger">' + error + '</span>')
            return false
        }

    })
    $(document).on('blur', '.edit_gal_name', function() {
        let gal_id = $(this).attr('data-gal_id')
        let gal_text = $(this).text();
        // let _token = $('input[name="_token"]').val();
        let url = $('#table').attr('data-url')
        console.log(gal_id)
        $.ajax({
            url: url,
            method: 'POST',
            data: { gal_id: gal_id, "_token": $("meta[name='csrf-token']").attr("content"), gal_text: gal_text },
            // dataType: 'json',
            success: function(data) {
                // console.log(data)
                load_gallery()
                    // $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>')
                    // console.log(data)
                toastr.success("Cập nhật tên hình ảnh thành công", "Thông báo")
            },
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    })
    $(document).on('click', '.delete-gallery', function() {
        let gal_id = $(this).attr('data-gal_id')
            // let _token = $('input[name="_token"]').val();
        let url = $('#delete').attr('data-url')
            // console.log(gal_id)
        if (confirm('Bạn có muốn xóa hình ảnh này không?')) {
            $.ajax({
                url: url,
                method: 'POST',
                data: { gal_id: gal_id, "_token": $("meta[name='csrf-token']").attr("content") },
                // dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    load_gallery()
                        // $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>')
                        // console.log(data)
                    toastr.success("Xóa hình ảnh thành công", "Thông báo")
                },
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
        }

    });
    $(document).on('change', '.file_image', function() {
        let gal_id = $(this).attr('data-gal_id')
        let image = document.getElementById('file-' + gal_id).files[0];
        let url = $('#update').attr('data-url')
        let form_data = new FormData();
        form_data.append("file", document.getElementById('file-' + gal_id).files[0])
        form_data.append("gal_id", gal_id)
            // console.log(gal_id)
        if (confirm('Bạn có muốn thay đổi hình ảnh này không?')) {
            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                // dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(data)
                    load_gallery()
                        // $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>')
                        // console.log(data)
                    toastr.success("Cập nhật hình ảnh thành công", "Thông báo")
                },
            });
        }

    })
})

function ChangeToSlug() {
    var slug;

    //Lấy text từ thẻ input title
    slug = document.getElementById("slug").value;
    slug = slug.toLowerCase();
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('convert_slug').value = slug;
}
$(document).ready(function() {
    load_slider()

    function load_slider() {
        let url = $("#slider-load").attr('data-url');
        // alert(pro_id);
        $.ajax({
            url: url,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},
            // dataType: 'json',
            success: function(data) {
                // console.log(data)
                $('#slider-load').html(data)
                    // console.log(data)
            },
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    }
    $(document).on('click', '.delete-slider', function() {
        let slider_id = $(this).attr('data-slider_id')
            // let _token = $('input[name="_token"]').val();
        let url = $('#delete_slider').attr('data-url')
            // console.log(gal_id)
        if (confirm('Bạn có muốn xóa hình ảnh này không?')) {
            $.ajax({
                url: url,
                method: 'POST',
                data: { slider_id: slider_id, "_token": $("meta[name='csrf-token']").attr("content") },
                // dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    load_slider()
                        // $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>')
                        // console.log(data)
                    toastr.success("Xóa slider thành công", "Thông báo")
                },
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
        }

    });
    $(document).on('change', '.file_image_slider', function() {
        // console.log('oke')
        let slider_id = $(this).attr('data-slider_id')
        let image = document.getElementById('file-' + slider_id).files[0];
        let url = $('#update_slider').attr('data-url')
        let form_data = new FormData();
        form_data.append("file", document.getElementById('file-' + slider_id).files[0])
        form_data.append("slider_id", slider_id)
        console.log(slider_id)
        if (confirm('Bạn có muốn thay đổi hình ảnh này không?')) {
            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                // dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // console.log(data)
                    load_slider()
                        // $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>')
                        // console.log(data)
                    toastr.success("Cập nhật hình ảnh thành công", "Thông báo")
                },
            });
        }

    })
})