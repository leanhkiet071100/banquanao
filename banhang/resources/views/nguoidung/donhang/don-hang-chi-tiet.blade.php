@extends('layouts.layoutuser')

@section('title', 'mạng xã hội')
@section('sidebar')
    @parent
    <!-- Main -->
    <section class="time-line-user">
        <div class="container">
            <div class="row">
                @include('layouts.menu-tai-khoan')
                <div class="col-lg-9 col-md-7 order-md-1 order-1">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="main-card mb-3 card">
                                        <div class="tt-chi-tiet-don-hang">
                                            <div class="tro-lai">
                                                <a href="{{ url()->previous() }}">Trở lại</a>
                                            </div>
                                            <div class="trang-thai-chi-tiet">
                                                <span>Mã đơn hàng: {{ $don_hang->id }}</span>
                                                <span class="tt-chia">|</span>
                                                @switch($don_hang->trang_thai)
                                                    @case(1)
                                                        <span class="trang-thai">Chờ xác nhận</span>
                                                    @break

                                                    @case(2)
                                                        <span class="trang-thai">Vận chuyển</span>
                                                    @break

                                                    @case(3)
                                                        <span class="trang-thai">Đang giao</span>
                                                    @break

                                                    @case(4)
                                                        <span class="trang-thai">Hoàn thành</span>
                                                    @break

                                                    @case(5)
                                                        <span class="trang-thai">Trả hàng</span>
                                                    @break

                                                    @case(0)
                                                        <span class="trang-thai">Hủy hàng</span>
                                                    @break

                                                    @default
                                                @endswitch
                                            </div>
                                        </div>
                                        <div class="card-body display_data">
                                            <h2 class="text-center">Chi tiết hóa đơn</h2>
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
                                                    <label for="email"
                                                        class="col-md-3 text-md-right col-form-label">Email</label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <p>{{ $don_hang->email }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($don_hang->so_dien_thoai != null)
                                                <div class="position-relative row form-group">
                                                    <label for="phone" class="col-md-3 text-md-right col-form-label">số
                                                        điện thoại</label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <p>{{ $don_hang->so_dien_thoai }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($don_hang->dia_chi_cu_the != null)
                                                <div class="position-relative row form-group">
                                                    <label for="street_address"
                                                        class="col-md-3 text-md-right col-form-label">
                                                        Địa chỉ</label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <p>{{ $don_hang->dia_chi_cu_the }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($don_hang->trang_thai != null)
                                                <div class="position-relative row form-group">
                                                    <label for="status"
                                                        class="col-md-3 text-md-right col-form-label">Trạng thái</label>
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
                                                    <label for="description"
                                                        class="col-md-3 text-md-right col-form-label">ghi chú</label>
                                                    <div class="col-md-9 col-xl-8">
                                                        <p>{{ $don_hang->ghi_chu }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="table-responsive">
                                            <h2 class="text-center">Danh sách sản phẩm</h2>
                                            <hr>
                                            <table
                                                class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th class="text-center">Số lượng</th>
                                                        <th class="text-center">Giá sản phẩm</th>
                                                        <th class="text-center">Tổng</th>
                                                        @if ($don_hang->trang_thai == 4)
                                                            <th class="text-center">Chức năng</th>
                                                        @endif

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
                                                                                <img style="height: 60px;"
                                                                                    data-toggle="tooltip" title="Image"
                                                                                    data-placement="bottom"
                                                                                    src="{{ URL($value->hinh_anh) }}"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="widget-content-left flex2">
                                                                            <div class="widget-heading">
                                                                                {{ $value->ten_san_pham }}</div>
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
                                                            @if ($don_hang->trang_thai == 4)
                                                                <td class="text-center td-danh-gia">
                                                                    <button
                                                                        onclick="hien_form_danh_gia_san_pham({{ $value->ma_san_pham }})"
                                                                        class="btn btn-hover-shine btn-outline-success border-0 btn-sm">
                                                                        Đánh giá
                                                                    </button>
                                                                </td>
                                                            @endif


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="chi-tiet-tien-don-hang">
                                            <div class="chi-tiet-tien">
                                                <div class="ten-tien">
                                                    <span>Tổng tiền hàng</span>
                                                </div>
                                                <div class="gia-tien">
                                                    <div>{{ number_format($tong_tien_sp, 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                            <div class="chi-tiet-tien">
                                                <div class="ten-tien">
                                                    <span>Thành tiền</span>
                                                </div>
                                                <div class="gia-tien">
                                                    <div>{{ number_format($don_hang->tien_hoa_don, 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="form-danh-gia" style="" class="form-danh-gia" style="display: none">

        </div>
    </section>

    <!-- End Main -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#don-hang').addClass('mm-active');
            $('#li-don-hang').addClass('mm-active');
        });

        function hien_form_danh_gia_san_pham(id) {
           
            var form_danh_gia = document.getElementById("form-danh-gia");
            var url = "{{ route('tai-khoan.danh-gia-san-pham', '') }}" + '/' + id;;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'GET',
                // data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                     add_them_layout();
                    form_danh_gia.style.display = "block";
                    $('#form-danh-gia').html("");
                    $('#form-danh-gia').append(data);

                }
            });
        }
    </script>
@endsection
