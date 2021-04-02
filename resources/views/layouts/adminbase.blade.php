
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Pannel || Kumar Studio</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminStyle.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    @include('sweetalert::alert')
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="{{ asset('kslogo.png') }}" alt="" class="img-fluid"></h3>
            </div>
            <ul class="list-unstyled components p-0">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-3" aria-hidden="true"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('category.view') }}"><i class="fa fa-th-large me-3"></i> Category</a>
                </li>   

                <li class="">
                    <a href="#product" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-square me-3"></i> Product</a>
                    <ul class="collapse list-unstyled" id="product">
                        <li>
                            <a href="{{ route('products.view') }}"><i class="fa fa-square me-1"></i> Manage Product</a>
                        </li>
                        <li>
                            <a href="{{ route('insert.product.view') }}"><i class="fa fa-plus-square me-1"></i> Add Product</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="#order" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-gift me-3"></i> Orders</a>
                    <ul class="collapse list-unstyled" id="order">
                        <li>
                            <a href="{{ route('orders.view') }}">New Orders</a>
                        </li>
                        <li>
                            <a href="{{ route('orders.placed') }}">Placed Orders</a>
                        </li>
                        <li>
                            <a href="#">Cancled Orders</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('coupon.view') }}"><i class="fa fa-trash me-3"></i> Coupon</a>
                </li>
                
                
                <li>
                    <a href="#"><i class="fa fa-user me-3"></i> Users</a>
                </li>
                <li>
                    <a href="{{ route('admin.settings') }}"><i class="fa fa-cogs me-3"></i> Settings</a>
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <a onclick="this.closest('form').submit();return false;" href="#"><i class="fa fa-power-off text-danger me-3"></i> Logout</a>
                    </form> 
                    
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-theme-2" >
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn text-white shadow-none">
                        <i class="fas fa-align-left"></i>
                    </button>
                </div>
            </nav>
            @section('content')
                <div class="container-fluid bg-theme-2 p-5 border-top border-secondary" style="margin-top:-40px;">
                    <div class=" text-light">
                        <div class="card border-0 bg-theme-2">
                            <div class="card-body">
                                <h5 class="h3 fw-light">Welcome To Kumar Studio Admin Pannel.</h5>
                                <p class="text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum atque laboriosam numquam, accusantium dolor cumque ipsum saepe esse facere, iste illum eveniet quidem voluptates possimus debitis. Labore earum corrupti animi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @show
            {{-- <div class="container">
                @yield('content')
            </div> --}}
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>