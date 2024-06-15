@extends('adminLayout')
@section('content_dashboard') 
<div class="layout-page">
    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Place this tag where you want the button to render. -->
        <li class="nav-item lh-1 me-3">
            <a
            class="github-button"
            href=""
            data-icon="octicon-star"
            data-size="large"
            data-show-count="true"
            aria-label="Star themeselection/CozaStore-html-admin-template-free on GitHub"
            >Star</a
            >
        </li>

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
                <img src="../public/dashboard/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
            </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="#">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                        <img src="public/dashboard/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                    </div>
                    <div class="flex-grow-1">
                    <span class="fw-semibold d-block">
                    <?php
                        $adminName = Session::get('admin_name');
                        if ($adminName) {
                        echo $adminName;                          
                        }
                    ?>
                    </span>
                    <small class="text-muted">Admin</small>
                    </div>
                </div>
                </a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
            <li>
                <a class="dropdown-item" href="#">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">My Profile</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#">
                <i class="bx bx-cog me-2"></i>
                <span class="align-middle">Settings</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#">
                <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                    <span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                </span>
                </a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
            <li>
                <a class="dropdown-item" href="{{URL::to('/admin-logout')}}">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
                </a>
            </li>
            </ul>
        </li>
        <!--/ User -->
        </ul>
    </div>
    </nav>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header text-center fw-bolder">UPDATE PRODUCT</h5>
                    <div class="card-body pt-5">
                        <?php
                            $message = Session::get('message');
                            if ($message) {                            
                                echo '
                                <script type="text/javascript">
                                    window.onload = function () { 
                                        alert("' . $message . '")
                                    };
                                </script>';                            
                                Session::put('message', null);
                            }
                        ?>
                        @foreach($pro_edit as $key => $edit)
                        <form action="{{URL::to('/update-product/'.$edit->pro_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Category Name</label>
                                <select class="form-select" name="category_product_id" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                @foreach($categories as $key => $cate)
                                    @if($cate->cate_id == $edit->cate_id)
                                        <option value="{{$cate->cate_id}}" selected>{{$cate->cate_name}}</option>
                                    @else
                                        <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                    @endif
                                @endforeach
                                </select>
                                <div id="defaultFormControlHelp" class="form-text"></div> <!-- message -->
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name" aria-describedby="defaultFormControlHelp" value="{{$edit->pro_name}}" required/>
                                <div id="defaultFormControlHelp" class="form-text"></div> <!-- message -->
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Product Price</label>
                                <input type="text" class="form-control" name="product_price" aria-describedby="defaultFormControlHelp" value="{{$edit->pro_price}}" required/>                                
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label me-5 d-block">Product Size</label>
                                @foreach($sizes as $key => $size)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="product_size[]" value="{{$size->size_id}}" 
                                    @foreach($sizePro as $key => $vlu)
                                    {{ $size->size_id == $vlu->size_id ? 'checked' : ''}}
                                    @endforeach
                                    />
                                    <label class="form-check-label">{{$size->size_name}}</label>
                                </div>
                                @endforeach
                            </div> 
                            
                            <div class="form-group mb-3">
                                <label class="form-label me-5 d-block">Product Color</label>
                                @foreach($colors as $key => $color)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="product_color[]" value="{{$color->color_id}}" 
                                    @foreach($colorPro as $key => $vlue)
                                    {{ $color->color_id == $vlue->color_id ? 'checked' : ''}}
                                    @endforeach
                                    />
                                    <label class="form-check-label">{{$color->color_name}}</label>
                                </div>
                                @endforeach                      
                            </div>

                            <div class="form-group mb-3">
                                <label for="formFileMultiple" class="form-label">Product Images</label>
                                <input class="form-control" type="file" id="formFileMultiple" name="product_img" value="{{$edit->pro_img}}" multiple/>
                                <img class="pt-2" src="{{URL::to('public/upload/products/'.$edit->pro_img)}}" width="100px" height="100px">
                            </div>
                                                     
                            <div class="form-group mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" name="product_desc" id="exampleFormControlTextarea1" rows="10" style="resize: none" required>{{$edit->pro_desc}}</textarea>
                            </div>
                                                            
                            <button type="submit" name="add-product" class="btn btn-outline-primary mt-5">Update Product</button>
                        </form>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>

        
@endsection