@extends('layouts.layoutadmin')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Loại sản phẩm
                        <div class="page-title-subheading">
                           Xem, tạo, cập nhật, xóa loại sản phẩm
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a class="btn-shadow btn-hover-shine mr-3 btn btn-primary" style="color: white" onclick="hienformthem()">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Thêm
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">

                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="tên loại sản phẩm"
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        TÌM KIẾM
                                    </button>
                                </span>
                            </div>
                        </form>

                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">ID</th>
                                    <th class="text-center" width="50%">Tên</th>
                                    <th class="text-center">nổi bật</th>
                                    <th class="text-center">mới</th>
                                    <th class="text-center">Hiện</th>
                                    <th class="text-center">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody id="table-ds">

                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                            <div class="flex justify-between flex-1 sm:hidden">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                    « Previous
                                </span>

                                <a href="#page=2"
                                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                    Next »
                                </a>
                            </div>

                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700 leading-5">
                                        Showing
                                        <span class="font-medium">1</span>
                                        to
                                        <span class="font-medium">5</span>
                                        of
                                        <span class="font-medium">9</span>
                                        results
                                    </p>
                                </div>

                                <div>
                                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                        <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                            <span
                                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                                                aria-hidden="true">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </span>

                                        <span aria-current="page">
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">1</span>
                                        </span>
                                        <a href="#page=2"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 2">
                                            2
                                        </a>

                                        <a href="#page=2" rel="next"
                                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                                            aria-label="Next &amp;raquo;">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@section('create')
    <div class="create" id="create">

    </div>
@endsection
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#loai-san-pham').addClass('mm-active');
        $('#li-san-pham').addClass('mm-active');
        loadloaisanpham();
    });

    $(document).on('click', '.edit_loaisanpham', function(e) {
        e.preventDefault();
        //var url = "{{ route('admin.xoa-nhan-hieu', '1') }}";
        var url = $(this).attr('data-url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'GET',
            //data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                //console.log(data);
                var create_nhan_hieu = document.getElementById('create');
                create_nhan_hieu.style.display = "block";
                $('#create').html('');
                $('#create').append(data);
                add_them_layout()
            }
        });
    });

    $(document).on('click', '.delete_loaisanpham', function(e) {
        e.preventDefault();
        var r = confirm("Bạn có chắc chắn muốn xóa?");
        if (r == true) {
            var idnhanhieu = $(this).val();
            //var url = "{{ route('admin.xoa-nhan-hieu', '1') }}";
            var url = $(this).attr('data-url');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: "DELETE",
                success: function(data) {
                    alert(data.mess);
                    loadloaisanpham();
                }
            });
        }
    });

    function loadloaisanpham() {
        $.ajax({
            url: "{{ route('admin.load-loai-san-pham') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#table-ds').html("");
                $.each(data.lsloaisanpham, function(key, item) {
                    $('#table-ds').append('<tr>\
                                    <td class="text-center text-muted">' + (key + 1) + '</td>\
                                    <td>\
                                        <div class="widget-content p-0">\
                                            <div class="widget-content-wrapper">\
                                                <div class="widget-content-left flex2">\
                                                    <div class="widget-heading">' + item.ten_loai_san_pham + '</div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </td>\
                                    <td class="td-radio">\
                                            <div class=" check-magana text-center td-radio">\
                                                {{-- <input class="form-check-input" type="checkbox" value=""\
                                                    id="defaultCheck1"> --}}\
                                                <input class="" type="checkbox" value="" id="check-noi-bat' + item.id +
                        '" onchange="loai_san_pham_noi_bat(' + item.id + ')"  ' + (item
                            .noi_bat == 1 ? "checked" : "") + '>\
                                            </div>\
                                    </td>\
                                    <td class="td-radio">\
                                            <div class=" check-magana text-center td-radio">\
                                                {{-- <input class="form-check-input" type="checkbox" value=""\
                                                    id="defaultCheck1"> --}}\
                                                <input class="" type="checkbox" value="" id="check-moi' + item.id +
                        '" onchange="loai_san_pham_moi(' + item.id + ')"  ' + (item.moi == 1 ?
                            "checked" : "") + '>\
                                            </div>\
                                    </td>\
                                    <td class="td-radio">\
                                            <div class=" check-magana text-center td-radio">\
                                                {{-- <input class="form-check-input" type="checkbox" value=""\
                                                    id="defaultCheck1"> --}}\
                                                <input class="" type="checkbox" value="" id="check-hien' + item.id +
                        '" onchange="loai_san_pham_hien(' + item.id + ')"  ' + (item.hien == 1 ?
                            "checked" : "") + '>\
                                            </div>\
                                    </td>\
                                    <td class="text-center">\
                                        <a data-url="{{ route('admin.get-loai-san-pham-sua', '') }}\/' + item.id +
                        '" data-toggle="tooltip" title="Edit"\
                                            data-placement="bottom" class="edit_loaisanpham btn btn-outline-warning border-0 btn-sm">\
                                            <span class="btn-icon-wrapper opacity-8">\
                                                <i class="fa fa-edit fa-w-20"></i>\
                                            </span>\
                                        </a>\
                                        <form class="d-inline " action="" method="post">\
                                            <button class="delete_loaisanpham btn btn-hover-shine btn-outline-danger border-0 btn-sm"\
                                                type="button" data-toggle="tooltip" title="Delete" data-placement="bottom" data-url="{{ route('admin.xoa-loai-san-pham', '') }}\/' +
                        item
                        .id + '">\
                                                <span class="btn-icon-wrapper opacity-8">\
                                                    <i class="fa fa-trash fa-w-20"></i>\
                                                </span>\
                                            </button>\
                                        </form>\
                                    </td>\
                                </tr>');
                });
            }
        })
    }

    function hienformthem() {
        //  var formData = new FormData();
        //  formData.append('idpost', idpost);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('admin.get-loai-san-pham-them') }}",
            type: 'GET',
            //data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                //console.log(data);
                var create_nhan_hieu = document.getElementById('create');
                create_nhan_hieu.style.display = "block";
                $('#create').html('');
                $('#create').append(data);
                add_them_layout();
            }
        });
    }

    function thoai(e) {
        if (event.which == 13 || event.keyCode == 13) {
            //code to execute here
            return false;
            alert('kiệt');
        }
        return true;
    }

    function huy() {
        var create_nhan_hieu = document.getElementById('create');
        create_nhan_hieu.style.display = "none";
        remove_them_layout();
    }

    function loai_san_pham_hien($id) {
        var check = document.getElementById("check-hien" + $id).checked;
        var formData = new FormData();
        var url = "{{ route('admin.loai-san-pham-hien', '') }}" + '/' + $id;
        formData.append('check', check);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                //window.location.reload(); load lại trang
                console.log(data)
            }
        });
    }

    function loai_san_pham_moi($id) {
        var check = document.getElementById("check-moi" + $id).checked;
        var formData = new FormData();
        var url = "{{ route('admin.loai-san-pham-moi', '') }}" + '/' + $id;
        formData.append('check', check);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                //window.location.reload(); load lại trang
                console.log(data)
            }
        });
    }

    function loai_san_pham_noi_bat($id) {
        var check = document.getElementById("check-noi-bat" + $id).checked;
        var formData = new FormData();
        var url = "{{ route('admin.loai-san-pham-noi-bat', '') }}" + '/' + $id;
        formData.append('check', check);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                //window.location.reload(); load lại trang
                console.log(data)
            }
        });
    }
</script>
@endsection
