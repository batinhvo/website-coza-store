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
                <img src="public/dashboard/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
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
                    <h5 class="card-header text-center fw-bolder">ADD PRODUCT</h5>
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
                        <form action="{{URL::to('/save-product')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group mb-3">
                                <label for="defaultFormControlInput" class="form-label">Category Name</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" required>
                                <option selected>select category name</option>
                                @foreach($categories as $key => $cate)
                                <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                @endforeach
                                </select>
                                <div id="defaultFormControlHelp" class="form-text"></div> <!-- message -->
                            </div>

                            <div class="form-group mb-3">
                                <label for="defaultFormControlInput" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="category_product_name" id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" required/>
                                <div id="defaultFormControlHelp" class="form-text"></div> <!-- message -->
                            </div>

                            <div class="form-group mb-3">
                                <label for="defaultFormControlInput" class="form-label">Product Price</label>
                                <input type="text" class="form-control" name="product_price" id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" required/>                                
                            </div>

                            <div class="form-group mb-3">
                                <label for="defaultFormControlInput" class="form-label me-5">Product Size</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="filterCheckboxfs" value="1" />
                                    <label class="form-check-label me-5" for="inlineCheckbox1">Full Size</label>
                                </div>
                                @foreach($sizes as $key => $size)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="filterCheckboxfs" name="size" value="{{$size->size_id}}" />
                                    <label class="form-check-label" for="inlineCheckbox1">{{$size->size_name}}</label>
                                </div>
                                @endforeach
                                
                                <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="size" value="s" />
                                    <label class="form-check-label" for="inlineCheckbox1">S</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="size" value="m" />
                                    <label class="form-check-label" for="inlineCheckbox2">M</label>
                                </div>  
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="size" value="l" />
                                    <label class="form-check-label" for="inlineCheckbox3">L</label>
                                </div>  
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="size" value="xl"/>
                                    <label class="form-check-label" for="inlineCheckbox4">XL</label>
                                </div>                               -->
                            </div> 
                            
                            <div class="form-group mb-3">
                                <label for="defaultFormControlInput" class="form-label me-5">Product Color</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input full" type="checkbox" id="filterCheckboxfc" value="fc" />
                                    <label class="form-check-label me-5" for="inlineCheckbox5">Full Color</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="color" value="r" />
                                    <label class="form-check-label" for="inlineCheckbox6">Red</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="color" value="b" />
                                    <label class="form-check-label" for="inlineCheckbox7">Blue</label>
                                </div>  
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="color" value="w" />
                                    <label class="form-check-label" for="inlineCheckbox8">White</label>
                                </div>  
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="color" value="g"/>
                                    <label class="form-check-label" for="inlineCheckbox">Gray</label>
                                </div>      
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="color" value="bk"/>
                                    <label class="form-check-label" for="inlineCheckbox4">Black</label>
                                </div>                        
                            </div>
                                                     
                            <div class="form-group mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" name="product_desc" id="exampleFormControlTextarea1" rows="5" style="resize: none" required></textarea>
                            </div>
                            <div class="form-group form-check form-switch mb-3">
                                <input class="form-check-input" name="category_product_status" type="checkbox" id="flexSwitchCheckChecked" checked/>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                            </div>
                            <button type="submit" name="add-category-product" class="btn btn-outline-primary mt-5">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>           
            document.addEventListener('DOMContentLoaded', function() {
                const checkbox = document.querySelector('#filterCheckboxfs');
                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        document.querySelectorAll('input[name="size"]').forEach(function(input) {
                            input.disabled = true;
                            input.checked = false;
                        });
                    } else {
                        document.querySelectorAll('input[name="size"]').forEach(function(input) {
                            input.disabled = false;
                        });
                    }
                });

                const checkboxc = document.querySelector('#filterCheckboxfc');
                checkboxc.addEventListener('change', function() {
                    if (checkboxc.checked) {
                        document.querySelectorAll('input[name="color"]').forEach(function(input) {
                            input.disabled = true;
                            input.checked = false;
                        });
                    } else {
                        document.querySelectorAll('input[name="color"]').forEach(function(input) {
                            input.disabled = false;
                        });
                    }
                });
            });
        </script>
@endsection