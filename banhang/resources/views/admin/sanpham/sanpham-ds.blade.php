@extends('layouts.layoutadmin')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    @if (session()->has('success'))
        <script>
            alert('{{ session()->get('success') }}')
        </script>
    @endif
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Product
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="{{ route('admin.get-san-pham-them') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Create
                    </a>
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
                                    <th class="text-center">Tên và nhãn hiệu</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">số lượng kho</th>
                                    <th class="text-center">Hiện</th>
                                    <th class="text-center">Nổi bật</th>
                                    <th class="text-center">Mới</th>
                                    {{-- <th class="text-center">Featured</th> --}}
                                    <th class="text-center">Chức năng</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($lssanpham as $key => $value)
                                    <tr>
                                        <td class="text-center text-muted">{{ $key + 1 }}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px; width:60px;" data-toggle="tooltip"
                                                                title="Image" data-placement="bottom"
                                                                src="{{ URL($value->hinh_anh) }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $value->ten_loai_san_pham }}</div>
                                                        <div class="widget-subheading opacity-7">
                                                            {{ $value->ten_san_pham }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ number_format($value->gia, 2, ',', '.') }}</td>
                                        <td class="text-center">{{ $value->so_luong_kho }}</td>
                                        {{-- <td class="text-center">
                                        <div class="badge badge-success mt-2">
                                            True
                                        </div>
                                    </td> --}}
                                        <td class="td-radio">
                                            <div class=" check-magana text-center td-radio">
                                                {{-- <input class="form-check-input" type="checkbox" value=""\
                                                    id="defaultCheck1"> --}}
                                                <input class="" type="checkbox" value=""
                                                    id="check-hien{{ $value->id }}"
                                                    @if ($value->hien == 1) checked @endif
                                                    onchange="san_pham_hien({{ $value->id }})">
                                            </div>
                                        </td>
                                        <td class="td-radio">
                                            <div class=" check-magana text-center td-radio">
                                                {{-- <input class="form-check-input" type="checkbox" value=""\
                                                    id="defaultCheck1"> --}}
                                                <input class="" type="checkbox" value=""
                                                    id="check-noi-bat{{ $value->id }}"
                                                    @if ($value->noi_bat == 1) checked @endif
                                                    onchange="san_pham_noi_bat({{ $value->id }})">
                                            </div>
                                        </td>
                                        <td class="td-radio">
                                            <div class=" check-magana text-center td-radio">
                                                {{-- <input class="form-check-input" type="checkbox" value=""\
                                                    id="defaultCheck1"> --}}
                                                <input class="" type="checkbox" value=""
                                                    id="check-moi{{ $value->id }}"
                                                    @if ($value->moi == 1) checked @endif
                                                    onchange="san_pham_moi({{ $value->id }})">
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('admin.chi-tiet-san-pham', ['id' => $value->id]) }}"
                                                class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                                Chi tiết
                                            </a>
                                            <a href="{{ route('admin.get-san-pham-sua', ['id' => $value->id]) }}"
                                                data-toggle="tooltip" title="Edit" data-placement="bottom"
                                                class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-edit fa-w-20"></i>
                                                </span>
                                            </a>
                                            <form class="d-inline"
                                                action="{{ route('admin.san-pham-xoa', ['id' => $value->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                    type="submit" data-toggle="tooltip" title="Delete"
                                                    data-placement="bottom"
                                                    onclick="return confirm('Bạn có chắc muốn xóa?')">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-trash fa-w-20"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>


                    <div class="d-block card-footer">
                        {{ $lssanpham->appends(request()->all())->links('phantrang.phantrang') }}
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
            $('#san-pham').addClass('mm-active');
            $('#li-san-pham').addClass('mm-active');
        });

        function format_curency(a) {
            // định dạng tiền
            a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }

        function format_money(n, currency) {
            return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        }


        function san_pham_hien($id) {
            var check = document.getElementById("check-hien" + $id).checked;
            var formData = new FormData();
            var url = "{{ route('admin.san-pham-hien', '') }}" + '/' + $id;
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

        function san_pham_moi($id) {
            var check = document.getElementById("check-moi" + $id).checked;
            var formData = new FormData();
            var url = "{{ route('admin.san-pham-moi', '') }}" + '/' + $id;
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

        function san_pham_noi_bat($id) {
            var check = document.getElementById("check-noi-bat" + $id).checked;
            var formData = new FormData();
            var url = "{{ route('admin.san-pham-noi-bat', '') }}" + '/' + $id;
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
