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
            data-color="large"
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
                    <h5 class="card-header text-center mb-5 fw-bolder">ALL COLOR PRODUCT</h5>
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
                    <div class="table-responsive text-nowrap" style="min-height: 300px">
                        <table class="table table-hover" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Color Name</th>                                    
                                    <th>Show</th>                                    
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($all_color_pro as $key => $color_pro)
                            <tr>
                                <td><strong>{{$color_pro->color_id}}</strong></td>
                                <td>{{$color_pro->color_name}}</td>                                
                                <td>
                                    <?php if($color_pro->color_status == 1) { ?>                                                                                        
                                        <a href="{{URL::to('/unactive-color-product/'.$color_pro->color_id)}}" class="badge bg-label-success"><i class="bx bx-show-alt"></i></a>                                        
                                    <?php } else { ?>
                                        <a href="{{URL::to('/active-color-product/'.$color_pro->color_id)}}" class="badge bg-label-danger"><i class="bx bx-hide"></i></a>
                                    <?php } ?>                                    
                                </td>                                
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">                    
                    <h5 class="card-header text-center fw-bolder">ADD COLOR PRODUCT</h5>
                    
                    <div class="table-responsive text-nowrap p-5">
                    <form action="{{URL::to('/save-color-product')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group mb-3">
                                <label for="defaultFormControlInput" class="form-label">Color Name</label>
                                <input type="text" class="form-control" name="color_product_name" id="defaultFormControlInput" aria-describedby="defaultFormControlHelp" required/>
                                <div id="defaultFormControlHelp" class="form-text"></div> <!-- message -->
                            </div>
                            <div class="form-group form-check form-switch mb-3">
                                <input class="form-check-input" name="color_product_status" type="checkbox" id="flexSwitchCheckChecked" checked/>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                            </div>
                            <button type="submit" name="add-color-product" class="btn btn-outline-primary mt-5">Add Color</button>
                        </form>
                    </div>
                </div>
            </div>
        
        </div>
        

@endsection