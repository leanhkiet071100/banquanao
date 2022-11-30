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
                        Product Detail
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="{{ route('admin.get-chi-tiet-san-pham-them', ['id' => $idsp]) }}"
                        class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        TẠO
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success success text-center" id="success">
                        {{ session()->get('success') }}
                    </div>
                @endif
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
                                        tìm kiếm
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
                                    <th class="pl-4">Product Name</th>
                                    <th class="text-center">Màu</th>
                                    <th class="text-center">size</th>
                                    <th class="text-center">Số lượng kho</th>
                                    <th class="text-center">Hiện</th>
                                    <th class="text-center">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chitietsp as $key => $value)
                                    <tr>
                                        <td class="pl-4 text-muted">{{ $value->ten_san_pham }}</td>
                                        <td class="text-center">{{ $value->mau }}</td>
                                        <td class="text-center">{{ $value->kich_thuoc }}</td>
                                        <td class="text-center">{{ $value->so_luong_kho }}</td>
                                        <td class="td-radio">
                                            <div class=" check-magana text-center td-radio">
                                                <input class="" type="checkbox" value=""
                                                    id="checkhien{{ $value->id }}"
                                                    onchange="chitietsanphamhien({{ $value->id }})"
                                                    @if ($value->hien == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.get-chi-tiet-san-pham-sua', ['id' => $value->id]) }}"
                                                data-toggle="tooltip" title="Edit" data-placement="bottom"
                                                class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-edit fa-w-20"></i>
                                                </span>
                                            </a>
                                            <form class="d-inline"
                                                action="{{ route('admin.chi-tiet-san-pham-xoa', ['id' => $value->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#san-pham').addClass('mm-active');
        });

        function chitietsanphamhien($id) {
            var check = document.getElementById("checkhien" + $id).checked;
            var formData = new FormData();
            var url = "{{ route('admin.chi-tiet-san-pham-hien', '') }}" + '/' + $id;
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
