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
                        NHÃN HIỆU
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a class="btn-shadow btn-hover-shine mr-3 btn btn-primary" onclick="hienformthemnhanhieu()">
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
                                <input type="search" name="search" id="search" placeholder="Search everything"
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                        {{-- <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div> --}}
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">ID</th>

                                    <th class="text-center" width="20%">Hình</th>
                                    <th class="text-center" width="50%">Tên nhãn hiệu</th>

                                    <th class="text-center">Hiện</th>
                                    <th class="text-center">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody id="table-dsnhanhieu">
                                <?php /* @foreach ($lsnhanhieu as $key => $value)
                                    <tr>
                                        <td class="text-center text-muted">{{ $key + 1 }}</td>
                                        <td class="td-hinh">
                                            <div class="widget-content-center ">
                                                <img style="height: 60px; width: 60px" data-toggle="tooltip" title="Image"
                                                    data-placement="bottom" src="{{URL('')}}/{{$value->hinh_nhan_hieu}}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $value->ten_nhan_hieu }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>



                                        <td class="td-radio">
                                            <div class=" check-magana text-center td-radio">
                                                {{-- <input class="form-check-input" type="checkbox" value=""
                                                    id="defaultCheck1"> --}}
                                                <input class="" type="checkbox" value="" id="defaultCheck1">
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <a href="./brand-edit.html" data-toggle="tooltip" title="Edit"
                                                data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-edit fa-w-20"></i>
                                                </span>
                                            </a>
                                            <form class="d-inline" action="" method="post">
                                                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                    type="submit" data-toggle="tooltip" title="Delete"
                                                    data-placement="bottom"
                                                    onclick="return confirm('Do you really want to delete this item?')">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-trash fa-w-20"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach */
                                ?>

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
                                {{-- <div>
                                    <p class="text-sm text-gray-700 leading-5">
                                        Showing
                                        <span class="font-medium">1</span>
                                        to
                                        <span class="font-medium">5</span>
                                        of
                                        <span class="font-medium">9</span>
                                        results
                                    </p>
                                </div> --}}

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
        @section('create')
        <div class="create-nhan-hieu" id="create-nhan-hieu">

        </div>
        @endsection
    </div>
    <!-- End Main -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#nhan-hieu').addClass('mm-active');
            loadnhanhieu()
        });

        $(document).on('click', '.delete_nhanhieu', function(e) {
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
                        loadnhanhieu();
                    }
                });
            }
        });

        $(document).on('click', '.edit_nhanhieu', function(e) {
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
                    var create_nhan_hieu = document.getElementById('create-nhan-hieu');
                    create_nhan_hieu.style.display = "block";
                    $('#create-nhan-hieu').html('');
                    $('#create-nhan-hieu').append(data);
                    add_them_layout();
                }
            });
        });
 


    function hienformthemnhanhieu() {
        //  var formData = new FormData();
        //  formData.append('idpost', idpost);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('admin.get-nhan-hieu-them') }}",
            type: 'GET',
            //data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                //console.log(data);
                var create_nhan_hieu = document.getElementById('create-nhan-hieu');
                create_nhan_hieu.style.display = "block";
                $('#create-nhan-hieu').html('');
                $('#create-nhan-hieu').append(data);
                add_them_layout();
            }
        });
    }

    function huy() {
        var create_nhan_hieu = document.getElementById('create-nhan-hieu');
        create_nhan_hieu.style.display = "none";
        remove_them_layout();
    }

    function loadnhanhieu() {
        $.ajax({
            url: "{{ route('admin.load-nhan-hieu') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#table-dsnhanhieu').html("");
                $.each(data.lsnhanhieu, function(key, item) {
                    $('#table-dsnhanhieu').append('<tr>\
                                        <td class="text-center text-muted">' + (key + 1) + '</td>\
                                        <td class="td-hinh">\
                                            <div class="widget-content-center ">\
                                                <img style="height: 60px; width: 60px" data-toggle="tooltip" title="Image"\
                                                    data-placement="bottom" src="{{ URL('') }}/' + item
                        .hinh_nhan_hieu + '"\
                                                    alt="">\
                                            </div>\
                                        </td>\
                                        <td>\
                                            <div class="widget-content p-0">\
                                                <div class="widget-content-wrapper">\
                                                    <div class="widget-content-left flex2">\
                                                        <div class="widget-heading">' + item.ten_nhan_hieu + '</div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </td>\
                                        <td class="td-radio">\
                                            <div class=" check-magana text-center td-radio">\
                                                {{-- <input class="form-check-input" type="checkbox" value=""\
                                                    id="defaultCheck1"> --}}\
                                                <input class="" type="checkbox" value="" id="checkhien' + item.id +  '" onchange="nhan_hieu_hien(' + item.id + ')"  ' + (item.hien == 1 ? "checked" : "") +'>\
                                            </div>\
                                        </td>\
                                        <td class="text-center">\
                                            <a data-url="{{ route('admin.get-nhan-hieu-sua', '') }}\/' + item.id + '" data-toggle="tooltip" title="Edit"\
                                                data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm edit_nhanhieu" id="edit_nhanhieu">\
                                                <span class="btn-icon-wrapper opacity-8">\
                                                    <i class="fa fa-edit fa-w-20"></i>\
                                                </span>\
                                            </a>\
                                            <form class="d-inline" action="" method="post">\
                                                <button class="delete_nhanhieu btn btn-hover-shine btn-outline-danger border-0 btn-sm "\
                                                    type="button" data-toggle="tooltip" title="Delete"\
                                                    data-placement="bottom" value="' + item.id +'" id="delete_nhanhieu" data-url="{{ route('admin.xoa-nhan-hieu', '') }}\/' + item.id + '">\
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

    function nhan_hieu_hien($id) {
        var check = document.getElementById("checkhien" + $id).checked;
        var formData = new FormData();
        var url = "{{ route('admin.nhan-hieu-hien', '') }}" + '/' + $id;
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
