<!-- form địa chỉ -->
<div class="vizew-login-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12">
                <div class="login-content">
                    <!-- Section Title -->
                    <div class="section-heading">
                        <h4>Địa chỉ mới</h4>
                        <div class="line"></div>
                    </div>
                    <form id="post-dia-chi" class="post-dia-chi" method="post" enctype="multipart/form-data"
                        data-url="{{ route('tai-khoan.post-dia-chi-sua',['id'=>$dia_chi->id]) }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="ho-ten" name="ho_ten"
                                value="{{ old('ho-ten') ?? $dia_chi->ho_ten }}" placeholder="Họ tên">
                            <div class="text-center " id="error-ho-ten" style="color:red">

                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="so-dien-thoai" name="so_dien_thoai"
                                value="{{ old('so-dien-thoai') ?? $dia_chi->so_dien_thoai }}" placeholder="Số điện thoại">
                            <div class="text-center" id="error-so-dien-thoai" style="color:red">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row tinh-huyen-xa">
                                <div class="">
                                    <select class="form-select js-location" aria-label="Default select example"
                                        data-type="tinh" id="js-location-tinh">
                                        <option selected value="{{$id_tinh}}">{{$dia_chi->tinh}}</option>
                                        @foreach ($tinh as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->ten }}</option>
                                        @endforeach

                                    </select>
                                    <div class="text-center" id="error-tinh" style="color:red">

                                    </div>
                                </div>
                                <div class="huyen">
                                    <select disabled id="js-location-huyen" class="form-select js-location"
                                        aria-label="Default select example" data-type="huyen">
                                        <option selected value="{{$id_huyen}}">{{$dia_chi->huyen}}</option>
                                    </select>
                                    <div class="text-center" id="error-huyen" style="color:red">

                                    </div>
                                </div>
                                <div class="xa">
                                    <select disabled class="form-select js-location-xa"
                                        aria-label="Default select example" data-type="xa" id="js-location-xa">
                                        <option selected value="{{$id_xa}}">{{$dia_chi->xa}}</option>
                                    </select>
                                    <div class="text-center" id="error-xa" style="color:red">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="dia-chi-cu-the" name="dia-chi-cu-the"
                                value="{{ old('dia-chi-cu-the') ?? $dia_chi->dia_chi_cu_the }}" placeholder="Địa chỉ cụ thể">
                            @error('dia_chi_cu_the')
                                <span style="color:red"> {{ $message }}</span>
                            @enderror
                            <div class="text-center" id="error-dia-chi-cu-the" style="color:red">

                            </div>
                        </div>
                        
                        <div class="form-check mac-dinh">
                            <input class="form-check-input" type="checkbox" value="" id="mac-dinh"  @if ($dia_chi->mac_dinh == 1) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Cài làm mặc định
                            </label>
                        </div>
                      
                        <div class="btn-luu-dia-chi row">
                            <button class="btn-huy-dia-chi vizew-btn w-40 mt-30 ">Hủy</button>
                            <button type="submit" class="btn vizew-btn w-40 mt-30">Lưu</button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-huy-dia-chi").click(function(e) {
            e.preventDefault();
            var form_dia_chi = document.getElementById('form-dia-chi');
            form_dia_chi.style.display = "none";
            var prelod = document.getElementById('prelod');
            prelod.style.display = "none";
        });

        $("#post-dia-chi").submit(function(e) {
            e.preventDefault();
            var ho_ten = $('#ho-ten').val();
            var so_dien_thoai = $('#so-dien-thoai').val();
            var tinh = $('#js-location-tinh').val();
            var huyen = $('#js-location-huyen').val();
            var xa = $('#js-location-xa').val();
            var dia_chi_cu_the = $('#dia-chi-cu-the').val();
            var mac_dinh = $('#mac-dinh').is(':checked');

            var formData = new FormData();
            formData.append('ho_ten', ho_ten);
            formData.append('so_dien_thoai', so_dien_thoai);
            formData.append('tinh', tinh);
            formData.append('huyen', huyen);
            formData.append('xa', xa);
            formData.append('dia_chi_cu_the', dia_chi_cu_the);
            formData.append('mac_dinh', mac_dinh);
          
            // formData.append('hinhnhanhieu', hinhnhanhieu);
            // for (const value of formData.values()) {
            //     console.log(value);
            // }
            var url = $(this).attr('data-url');
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
                    //console.log(data.errors.hinhnhanhieu);
                    //console.log(data);
                    if (data.status == 400) {
                        $('#error-ho-ten').html("");
                        $('#error-ho-ten').append(data.errors.ho_ten[0]);
                        $('#error-so-dien-thoai').html("");
                        $('#error-so-dien-thoai').append(data.errors.so_dien_thoai[0]);
                        $('#error-tinh').html("");
                        $('#error-tinh').append(data.errors.tinh[0]);
                        $('#error-huyen').html("");
                        $('#error-huyen').append(data.errors.huyen[0]);
                        $('#error-xa').html("");
                        $('#error-xa').append(data.errors.xa);
                        $('#error-dia-chi-cu-the').html("");
                        $('#error-dia-chi-cu-the').append(data.errors.dia_chi_cu_the[0]);
                    
                    } else {
                        console.log(data);

                        // alert(data.mess);
                        huy();
                        window.location.reload();
                    }

                }
            });
        });


        $('.js-location').change(function(e) {
            e.preventDefault();
            let $this = $(this);
            var parent_id = $this.val();
            var type = $this.attr('data-type');
            var formData = new FormData();
            formData.append('parent_id', parent_id);
            formData.append('type', type);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (type == "tinh") {
                $.ajax({
                    url: "{{ route('tai-khoan.get-load-huyen') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        //console.log(data);
                        $('#js-location-huyen').html('');
                        $.each(data.data, function(key, item) {
                            $('#js-location-huyen').append(
                                '<option value="' + (item.id) + '" >' + item
                                .ten + '</option>'
                            );
                        });
                        $('#js-location-xa').html('');
                        $('#js-location-xa').append('<option selected>Xã</option>')
                        var huyen = document.getElementById('js-location-huyen');
                        huyen.disabled = false;
                        var xa = document.getElementById('js-location-xa');
                        xa.disabled = true;

                    }
                });
            } else if (type == "huyen") {
                $.ajax({
                    url: "{{ route('tai-khoan.get-load-xa') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#js-location-xa').html('');
                        $.each(data.data, function(key, item) {
                            $('#js-location-xa').append(
                                '<option value="' + (item.id) + '" >' + item
                                .ten + '</option>'
                            );
                        });
                        var xa = document.getElementById('js-location-xa');
                        xa.disabled = false;
                    }
                });
            }

        })

        function huy() {
            var form_dia_chi = document.getElementById('form-dia-chi');
            form_dia_chi.style.display = "none";
            var prelod = document.getElementById('prelod');
            prelod.style.display = "none";
        }
    });
</script>
