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
                       Đơn hàng bị trả
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">

                        <form action="">
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="Search everything"
                                    class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp;
                                        Tìm kiếm
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
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Khách hàng</th>
                                    <th class="text-center">Số lượng sản phẩm</th>
                                    <th class="text-center">Tiền đơn hàng</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($don_hang as $key => $value)
                                    <tr>
                                        <td class="text-center text-muted">{{ $key + 1 }}</td>
                                        {{-- <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px;" data-toggle="tooltip" title="Image"
                                                                data-placement="bottom"
                                                                src="assets/images/_default-product.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $value->ho_ten }}</div>
                                                        <div class="widget-subheading opacity-7">
                                                            Pure Pineapple
                                                            (and {{$so_luong[$key]}} other products)
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td> --}}
                                        <td class="text-center">{{ $value->ho_ten }} </td>
                                        <td class="text-center">
                                            {{ $so_luong[$key] }}
                                        </td>
                                        <td class="text-center">{{ $value->tien_hoa_don }}</td>
                                        <td class="text-center td-trang-thai{{ $value->id }}"
                                            id="td-trang-thai{{ $value->id }}">
                                            @switch($value->trang_thai)
                                                @case(1)
                                                    <span class="badge badge-warning">Chờ xác nhận</span>
                                                @break

                                                @case(2)
                                                    <span class="badge badge-secondary">Vận chuyển</span>
                                                @break

                                                @case(3)
                                                    <span class="badge badge-secondary">Đang giao</span>
                                                @break

                                                @case(4)
                                                    <span class="badge badge-success">Hoàn thành</span>
                                                @break

                                                @case(5)
                                                    <span class="badge badge-danger">Trả hàng</span>
                                                @break

                                                @case(0)
                                                    <span class="badge badge-danger">Hủy hàng</span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td class="text-center td-chuc-nang{{ $value->id }}"
                                            id="td-chuc-nang{{ $value->id }}">
                                            @switch($value->trang_thai)
                                                @case(1)
                                                    <button onclick="don_hang_chuc_nang({{ $value->id }})"
                                                        class="btn btn-hover-shine btn-outline-success border-0 btn-sm">
                                                        Xác nhận
                                                    </button>
                                                @break

                                                @case(2)
                                                    <button onclick="don_hang_chuc_nang({{ $value->id }})"
                                                        class="btn btn-hover-shine btn-outline-success border-0 btn-sm">
                                                        Đã vận chuyển
                                                    </button>
                                                @break

                                                @case(3)
                                                    <button onclick="don_hang_chuc_nang({{ $value->id }})"
                                                        class="btn btn-hover-shine btn-outline-success border-0 btn-sm">
                                                        Hoàn thành
                                                    </button>
                                                @break

                                                @default
                                            @endswitch
                                            <a
                                                href="{{ route('admin.don-hang-chi-tiet', ['id' => $value->id]) }}"class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">Chi
                                                tiết </a>
                                            @if ($value->trang_thai != 0 && $value->trang_thai != 4)
                                                <button onclick="don_hang_huy({{ $value->id }})"
                                                    class="btn btn-hover-shine btn-outline-danger border-0 btn-sm">Hủy</button>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

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
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#tra-hang').addClass('mm-active');
            $('#li-don-hang').addClass('mm-active');
        });

        function don_hang_huy(id) {
            var url = "{{ route('admin.don-hang-huy', '') }}" + '/' + id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                // data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //window.location.reload(); load lại trang
                    //load_binh_luan(1);
                    if (data.status == 200) {
                        // $('#td-trang-thai' +id).html("");
                        // $('#td-trang-thai' +id).append( '<span class="badge badge-danger">Hủy hàng</span>' );
                        let trang_thai = Number(data.don_hang.trang_thai);
                        trang_thai_update(trang_thai, id);
                        chuc_nang_update(trang_thai, id);
                    }
                }
            });
        }

        function don_hang_chuc_nang(id) {
            var url = "{{ route('admin.don-hang-chuc-nang', '') }}" + '/' + id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                // data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    //window.location.reload(); load lại trang
                    //load_binh_luan(1);
                    if (data.status == 200) {
                        // $('#td-trang-thai' +id).html("");
                        // $('#td-trang-thai' +id).append( '<span class="badge badge-danger">Hủy hàng</span>' );
                        let trang_thai = Number(data.don_hang.trang_thai);
                        trang_thai_update(trang_thai, id);
                        chuc_nang_update(trang_thai, id);
                    }
                }
            });
        }

        function trang_thai_update(trang_thai, id) {
            $('#td-trang-thai' + id).html("");
            switch (trang_thai) {
                case 1:
                    $('#td-trang-thai' + id).append('<span class="badge badge-warning">Chờ xác nhận</span>');

                    break;
                case 2:
                    $('#td-trang-thai' + id).append('<span class="badge badge-secondary">Vận chuyển</span>');
                    break;
                case 3:
                    $('#td-trang-thai' + id).append(' <span class="badge badge-secondary">Đang giao</span>');

                    break;
                case 4:
                    $('#td-trang-thai' + id).append('<span class="badge badge-success">Hoàn thành</span>');
                    break;
                case 5:
                    $('#td-trang-thai' + id).append('<span class="badge badge-danger">Trả hàng</span>');
                    break;
                case 0:
                    $('#td-trang-thai' + id).append('<span class="badge badge-danger">Hủy hàng</span>');
                    break;
            }
        }

        function chuc_nang_update(trang_thai, id) {
            console.log(trang_thai);
            $('#td-chuc-nang' + id).html("");
            switch (trang_thai) {
                case 1:
                    $('#td-chuc-nang' + id).append('<button onclick="don_hang_chuc_nang(' + id + ')" class="btn btn-hover-shine btn-outline-success border-0 btn-sm">Xác nhận</button>\
                                                            <a href="{{ route('admin.don-hang-chi-tiet', '') }}\/' + id + '"class="btn btn-hover-shine btn-outline-primary border-0 btn-sm"> Chi tiết </a>\
                                                            <button onclick="don_hang_huy(' + id + ')" class="btn btn-hover-shine btn-outline-danger border-0 btn-sm">Hủy</button>\
                                                            ');

                    break;
                case 2:
                    $('#td-chuc-nang' + id).append(
                        '<button onclick="don_hang_chuc_nang(' + id + ')" class="btn btn-hover-shine btn-outline-success border-0 btn-sm">Đã vận chuyển</button>\
                                                            <a href="{{ route('admin.don-hang-chi-tiet', '') }}\/' + id + '"class="btn btn-hover-shine btn-outline-primary border-0 btn-sm"> Chi tiết </a>\
                                                            <button onclick="don_hang_huy(' + id +
                        ')" class="btn btn-hover-shine btn-outline-danger border-0 btn-sm">Hủy</button>\ '
                    );
                    break;
                case 3:
                    $('#td-chuc-nang' + id).append('<button onclick="don_hang_chuc_nang(' + id + ')" class="btn btn-hover-shine btn-outline-success border-0 btn-sm">Hoàn thành</button>\
                                                            <a href="{{ route('admin.don-hang-chi-tiet', '') }}\/' + id + '"class="btn btn-hover-shine btn-outline-primary border-0 btn-sm"> Chi tiết </a>\
                                                            <button onclick="don_hang_huy(' + id + ')" class="btn btn-hover-shine btn-outline-danger border-0 btn-sm">Hủy</button>\
                                                            ');

                    break;
                case 4:
                    $('#td-chuc-nang' + id).append('<a href="{{ route('admin.don-hang-chi-tiet', '') }}\/' + id +
                        '" class="btn btn-hover-shine btn-outline-primary border-0 btn-sm"> Chi tiết </a>');
                    break;
                case 5:
                    $('#td-chuc-nang' + id).append('<a href="{{ route('admin.don-hang-chi-tiet', '') }}\/' + id +
                        '" class="btn btn-hover-shine btn-outline-primary border-0 btn-sm"> Chi tiết </a>');
                    break;
                case 0:
                    $('#td-chuc-nang' + id).append('<a href="{{ route('admin.don-hang-chi-tiet', '') }}\/' + id +
                        '" class="btn btn-hover-shine btn-outline-primary border-0 btn-sm"> Chi tiết </a>');
                    break;
            }
        }
    </script>
@endsection
