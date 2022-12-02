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
                        Product deatil
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{route('admin.post-chi-tiet-san-pham-sua',['id'=>$sanphamchitiet->id])}}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label class="col-md-3 text-md-right col-form-label">Tên sản phẩm</label>
                                <div class="col-md-9 col-xl-8">
                                    <input disabled placeholder="Product Name" type="text" class="form-control"
                                        value="{{$sanphamchitiet->ten_san_pham}}">
                                    
                                </div>
                            </div>
                            
                            <div class="position-relative row form-group">
                                <label for="color" class="col-md-3 text-md-right col-form-label">màu</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="mau" id="mau" placeholder="Màu" type="text"
                                        class="form-control" value="{{ old('mau') ?? $sanphamchitiet->mau }}">
                                    <div class="text-center">
                                        @error('mau')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="size" class="col-md-3 text-md-right col-form-label">Size</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required name="size" id="size" placeholder="Size" type="text"
                                        class="form-control" value="{{ old('size') ?? $sanphamchitiet->kich_thuoc }}">
                                    <div class="text-center">
                                        @error('size')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div> 
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="qty" class="col-md-3 text-md-right col-form-label">Số lượng kho</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required  name="soluongkho" id="qty" placeholder="Số lượng kho" type="number"
                                        class="form-control" value="{{ old('soluongkho') ?? $sanphamchitiet->so_luong_kho }}">
                                    <div class="text-center">
                                        @error('soluongkho')
                                            <span style="color:red"> {{ $message }}</span>
                                        @enderror
                                    </div> 
                                </div>
                            </div>

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{route('admin.chi-tiet-san-pham-ds',['id'=>$sanphamchitiet->ma_san_pham])}}" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Hủy</span>
                                    </a>
                                    <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Lưu</span>
                                    </button>
                                </div>
                            </div>
                        </form>
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
    </script>
@endsection
