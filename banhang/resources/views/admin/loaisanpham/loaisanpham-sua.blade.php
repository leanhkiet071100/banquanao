<!-- Main -->
<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" id="formsua"
                        data-url="{{ route('admin.post-loai-san-pham-sua', ['id' => $loaisp->id]) }}">
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
                            <div class="col-md-9 col-xl-8">
                                <input required name="ten" id="ten" placeholder="Tên loại sản phẩm"
                                    type="text" class="form-control" value="{{ $loaisp->ten_loai_san_pham }}">
                            </div>
                        </div>
                        <div style="color: red" class="error text-center" name="error-ten" id="error-ten">

                        </div>


                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a onclick="huy()" class="border-0 btn btn-outline-danger mr-1 nut-huy">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Cancel</span>
                                </a>

                                <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>
                                    <span>Save</span>
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

<script type="text/javascript">
    {
        $(document).ready(function() {
            $("#formsua").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('data-url');
                var ten = $('#ten').val();
                //var kiemtrahinhanh = hinhnhanhieu.type;

                var formData = new FormData();
                formData.append('ten', ten);
                // for (const value of formData.values()) {
                //     console.log(value);
                // }
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

                        if (data.status == 400) {

                            $('#error-ten').html("");
                            $('#error-ten').append(data.errors.ten[0]);

                            // $.each(data.errors, function(key, err_value){
                            //     $('#saveform_errList').append('<li style="color: red">'+err_value+'</li>');    
                            // });
                            //console.log(data.error.tennhanhieu);
                        } else {
                            alert(data.mess);
                            loadloaisanpham();
                            huy();
                        }

                    }
                });
            })
        });
    }
</script>
