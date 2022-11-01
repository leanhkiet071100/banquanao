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
                        Product Images
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

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Product Name</label>
                            <div class="col-md-9 col-xl-8">
                                <input disabled placeholder="Product Name" type="text" class="form-control"
                                    value="Calvin Klein">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="" class="col-md-3 text-md-right col-form-label">Images</label>
                            <div class="col-md-9 col-xl-8">
                                <ul class="text-nowrap" id="images">
                                    <li class="float-left d-inline-block mr-2 mb-2" style="position: relative; width: 32%;">
                                        <form action="" method="post">
                                            <button type="submit"
                                                onclick="return confirm('Do you really want to delete this item?')"
                                                class="btn btn-sm btn-outline-danger border-0 position-absolute">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        <div style="width: 100%; height: 220px; overflow: hidden;">
                                            <img src="assets/images/_default-product.jpg" alt="Image">
                                        </div>
                                    </li>

                                    <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                        <form method="post" enctype="multipart/form-data">
                                            <div style="width: 100%; max-height: 220px; overflow: hidden;">
                                                <img style="width: 100%; cursor: pointer;" class="thumbnail"
                                                    data-toggle="tooltip" title="Click to add image" data-placement="bottom"
                                                    src="assets/images/add-image-icon.jpg" alt="Add Image">

                                                <input name="image" type="file" onchange="changeImg(this);"
                                                    accept="image/x-png,image/gif,image/jpeg"
                                                    class="image form-control-file" style="display: none;">

                                                <input type="hidden" name="product_id" value="">
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-3">
                                <a href="#" class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-check fa-w-20"></i>
                                    </span>
                                    <span>OK</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection