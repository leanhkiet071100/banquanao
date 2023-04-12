<section class='rating-widget'>
    <div class="central-meta item">
        <div class="user-post">
            <div class="form-danh-gia-san-pham">
                <div class="tt-danh-gia-san-pham">
                    <h3 class="tt">TRẢ LỜI SẢN PHẨM</h3>
                </div>
                <form action=""
                    data-url="{{ route('admin.post-form-tra-loi-binh-luan', ['id' => $binh_luan_san_pham->id]) }}" id="post-form-tra-loi-binh-luan">
                    @csrf
                    <div class="list-product">
                        <div class="detail-product">
                            <div class="img-product">
                                <img src="{{ URL($binh_luan_san_pham->hinh_anh) }}" alt="Lỗi tải ảnh sản phẩm">
                            </div>
                            <div class="info-product">
                                <div class="name-product">
                                    <span>{{ $binh_luan_san_pham->ten_san_pham }}</span>

                                </div>
                                <div class="phan-loai-san-pham">
                                    <span> Phân loại: {{ $binh_luan_san_pham->ten_loai_san_pham }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-luong-san-pham">
                        <div class="name">
                            Chất lượng
                        </div>
                        <div class='rating-stars text-center'>
                            <ul id='stars'>
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $binh_luan_san_pham->danh_gia)
                                        <i class='fa fa-star fa-fw sao-active sao'></i>
                                    @else
                                        <i class='fa fa-star fa-fw sao'></i>
                                    @endif
                                @endfor
                            </ul>
                        </div>

                    </div>
                    <div class="chat-luong-san-pham">
                        <div class="name">
                            Tên người đánh giá:
                        </div>
                        <div class='name text-center'>
                            {{ $binh_luan_san_pham->ten }}
                        </div>

                    </div>
                    <div class="description text-danh-gia" id="noidungbaiviet">
                        @if ($binh_luan_san_pham->noi_dung != null)
                            <textarea class="content-post" rows="5" readonly placeholder="Đánh giá sản phẩm">{{ $binh_luan_san_pham->noi_dung }}</textarea>
                        @else
                            <textarea class="content-post" rows="5" readonly placeholder="Đánh giá sản phẩm">không có nội dung đánh giá</textarea>
                        @endif

                    </div>

                    <div class="noi-dung-tra-loi">
                        Nội dung trả lời:
                    </div>
                    <div class="description text-danh-gia" id="noidungbaiviet">

                        <textarea class="content-post" id="content-post" name="content-post" rows="5" placeholder="Trả lời đánh giá"></textarea>

                    </div>
                    <div class="position-relative row form-group mb-1 text-center">
                        <div class="col-md-9 col-xl-8 offset-md-2">
                            <button class="border-0 btn btn-outline-danger mr-1" onclick="tro_lai()">
                                <span class="btn-icon-wrapper pr-1 opacity-8">
                                    <i class="fa fa-times fa-w-20"></i>
                                </span>
                                <span>Trở lại</span>
                            </button>
                            <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                    <i class="fa fa-reply fa-w-20"></i>
                                </span>
                                <span>Trả lời</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</section>
<!-- End Main -->



<script type="text/javascript">
    // điều chỉnh sao

    function tro_lai() {
        $('#form-danh-gia').html("");
        var form_danh_gia = document.getElementById("form-danh-gia");
        form_danh_gia.style.display = "none";
        remove_them_layout();
        // location.reload();
        
    }

    $("#post-form-tra-loi-binh-luan").submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        var noi_dung = $('#content-post').val();
        formData = new FormData();
        formData.append('noi_dung', noi_dung);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                    console.log(data);
                if (data.status == 400) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Úi...!!!',
                        text: data.errors.noi_dung[0],

                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cảm ơn bạn yêu',
                        text: data.mess,
                    }).then((result) => {
                        tro_lai();
                    });
                   
                }
            
            }
        });

    });
</script>
