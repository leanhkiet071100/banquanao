<section class='rating-widget'>
    <div class="central-meta item">
        <div class="user-post">
            <div class="form-danh-gia-san-pham">
                <div class="tt-danh-gia-san-pham">
                    <h3 class="tt">Đánh giá sản phẩm</h3>
                </div>
                <form action="" data-url="{{ route('tai-khoan.post-danh-gia-san-pham', ['id' => $san_pham->id]) }}"
                    id="post-form-danh-gia">
                    @csrf
                    <div class="list-product">
                        <div class="detail-product">
                            <div class="img-product">
                                <img src="{{ URL($san_pham->hinh_anh) }}" alt="Lỗi tải ảnh sản phẩm">
                            </div>
                            <div class="info-product">
                                <div class="name-product">
                                    <span>{{ $san_pham->ten_san_pham }}</span>

                                </div>
                                <div class="phan-loai-san-pham">
                                    <span> Phân loại: {{ $san_pham->ten_loai_san_pham }}</span>
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
                                <li class='star' title='Rất tệ' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Tệ' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Tốt' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Tuyệt vời' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" id="so-sao" class="so-sao">
                    </div>
                    <div class="description text-danh-gia" id="noidungbaiviet">
                        <textarea class="content-post" name="content_post" id="content_post" rows="3" placeholder="Đánh giá sản phẩm"></textarea>
                        <div class="attachments">
                            <ul>
                                <li>
                                    <i class="fa fa-image"></i>
                                    <label class="fileContainer">
                                        <input id="uploadanhpost" class="btn btn-primary" type="file"
                                            name="image_post[]" multiple="multiple" onchange="ImagesFileAsURL(event)">
                                        <br />
                                    </label>
                                </li>
                                <li>
                                    <i class="fa fa-video-camera"></i>
                                    <label class="fileContainer">
                                        <input type="file">
                                    </label>
                                </li>

                            </ul>
                        </div>
                        <div class="preview-upload" id="anh-binh-luan">
                        </div>
                        <div class="chuc-nang">
                            <div class="chi-tiet">
                                <button type="button" class="btn-chi-tiet" id="btn-tro-lai" onclick="tro_lai()">Trở lại</button>
                            </div>
                            <div class="danh-gia">
                                <button type="submit" class="btn-danh-gia">Hoàn thành</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <!-- Rating Stars Box -->

</section>
<!-- End Main -->



<script type="text/javascript">
    $(document).ready(function() {
        $('#li-don-hang').addClass('tk-active');
        $('#home').removeClass('active');
        $('#huy').addClass('active');
    });
    // điều chỉnh sao
    $(document).ready(function() {

        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function() {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            } else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);

        });


    });

    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }

    function ImagesFileAsURL() {
        var fileSelected = document.getElementById('uploadanhpost').files;
        document.getElementById('anh-binh-luan').innerHTML = "";
        if (fileSelected.length > 0) {
            for (var i = 0; i < fileSelected.length; i++) {
                var fileToLoad = fileSelected[i];
                var fileReader = new FileReader();
                fileReader.onload = function(fileLoaderEvent) {
                    var srcData = fileLoaderEvent.target.result;
                    var newImage = document.createElement('img');
                    newImage.src = srcData;
                    document.getElementById('anh-binh-luan').innerHTML += newImage.outerHTML;
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        }
    }

    function tro_lai() {
        var form_danh_gia = document.getElementById("form-danh-gia");
        form_danh_gia.style.display = "none";
        remove_them_layout();
        location.reload();
        $('#form-danh-gia').html("");
    }

    $("#post-form-danh-gia").submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        var noi_dung = $('#content_post').val();
        var hinh = document.getElementById('uploadanhpost').files;
        var so_sao = $('#so-sao').val();
            formData = new FormData();
            formData.append('noi_dung', noi_dung);
            formData.append('so_sao', so_sao);
            for (var i = 0; i < hinh.length; i++) {
                formData.append('hinhanh[]', hinh[i]);
            }
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
                    if (data.status == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Úi...!!!',
                            text: 'Hình như  bạn chưa đánh giá sản phẩm',

                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cảm ơn bạn yêu',
                            text: 'Đã hoàn thành bình luận',
                        }).then((result) => {
                            tro_lai();
                        });
                    }
                    console.log(data);
                }
            });
        
    });

    $('#stars').on('click', 'li', function() {
        var gia_tri_so_sao = $(this).attr('data-value')
        var so_sao = document.getElementById('so-sao');
        so_sao.value = gia_tri_so_sao;
    });
</script>
