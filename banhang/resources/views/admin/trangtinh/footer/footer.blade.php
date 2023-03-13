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
                        FOOTER
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- sửa thông tin --}}
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        @if ($footer != null)
                            <form action="{{ route('admin.footer-sua', ['id' => $footer->id]) }}" method="post"
                                enctype="multipart/form-data">
                            @else
                                <form action="{{ route('admin.footer-them') }}" method="post"
                                    enctype="multipart/form-data">
                        @endif
          
                        @csrf
                        <div class="position-relative row form-group">
                            <label for="tieu-de" class="col-md-3 text-md-right col-form-label">Tiêu đề</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="tieu-de" id="tieu-de" placeholder="Tiêu đề" type="text"
                                    class="form-control" value="@if($footer == null){{old('tieu-de')}}@else{{old('tieu-de')??$footer->tieu_de}} @endif">
                                <div class="text-center">
                                
                                    @error('tieu-de')
                                        <span style="color:red"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="noi-dung" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea required class="form-control" name="noi-dung" id="noi-dung" placeholder="Nội dung" value=""> @if($footer == null)  {{old('noi-dung')}} @else {{old('noi-dung') ?? $footer->noi_dung }} @endif</textarea>
                                <div class="text-center">
                                    @error('noi-dung')
                                        <span style="color:red"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                 @if($footer != null)
                                <a  onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{ route('admin.footer-xoa',['id'=>$footer->id]) }}" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Xóa</span>
                                </a>
                                @endif
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
        {{-- Kết thúc sửa thông tin --}}
    </div>

    <!-- End Main -->
@endsection



@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#footer').addClass('mm-active');
            $('#li-trang-tinh').addClass('mm-active');
        });
        CKEDITOR.replace('noi-dung');
    </script>

@endsection
