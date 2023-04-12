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
                        Chi tiết hóa đơn
                        
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">

                        <div class="table-responsive">
                            <h2 class="text-center">Danh sách sản phẩm</h2>
                            <hr>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>sản phẩm</th>
                                        <th class="text-center">số lượng</th>
                                        <th class="text-center">giá sản phẩm</th>
                                        <th class="text-center">tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donhang_chitiet as $key => $value)
                                        <tr>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img style="height: 60px;" data-toggle="tooltip"
                                                                    title="Image" data-placement="bottom"
                                                                    src="{{ URL($value->hinh_anh) }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $value->ten_san_pham }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ $value->so_luong }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($value->gia_san_pham, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($value->tong_tien, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>



                        <h2 class="text-center mt-5">Chi tiết hóa đơn</h2>
                        <hr>
                        @if ($don_hang->ho_ten != null)
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">
                                    Họ tên
                                </label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $don_hang->ho_ten }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($don_hang->email != null)
                            <div class="position-relative row form-group">
                                <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $don_hang->email }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($don_hang->so_dien_thoai != null)
                            <div class="position-relative row form-group">
                                <label for="phone" class="col-md-3 text-md-right col-form-label">số điện thoại</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $don_hang->so_dien_thoai }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($don_hang->dia_chi_cu_the != null)
                            <div class="position-relative row form-group">
                                <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                    Địa chỉ</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $don_hang->dia_chi_cu_the }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($don_hang->trang_thai != null)
                            <div class="position-relative row form-group">
                                <label for="status" class="col-md-3 text-md-right col-form-label">Trạng thái</label>
                                <div class="col-md-9 col-xl-8">
                                    @switch($don_hang->trang_thai)
                                        @case(1)
                                            <span class="badge badge-warning mt-2">Chờ xác nhận</span>
                                        @break

                                        @case(2)
                                            <span class="badge badge-secondary mt-2">Vận chuyển</span>
                                        @break

                                        @case(3)
                                            <span class="badge badge-secondary mt-2">Đang giao</span>
                                        @break

                                        @case(4)
                                            <span class="badge badge-success mt-2">Hoàn thành</span>
                                        @break

                                        @case(5)
                                            <span class="badge badge-danger mt-2">Trả hàng</span>
                                        @break

                                        @case(0)
                                            <span class="badge badge-danger">Hủy hàng</span>
                                        @break

                                        @default
                                    @endswitch
                                </div>
                            </div>
                        @endif
                        @if ($don_hang->ghi_chu != null)
                            <div class="position-relative row form-group">
                                <label for="description" class="col-md-3 text-md-right col-form-label">ghi chú</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $don_hang->ghi_chu }}</p>
                                </div>
                            </div>
                        @endif
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
            $('#don-hang').addClass('mm-active');
            $('#li-don-hang').addClass('mm-active');
        });
    </script>
@endsection
