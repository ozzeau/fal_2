@include('assets.headerAdmin')


<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/logout" role="button">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="shad-button_ghost">
                                <img src="{{ asset('storage/images/logout.png') }}" alt="logout" style="max-width: 15px; max-height: 15px;">
                            </button>

                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{asset('storage/images/logo.png')}}" alt="DriveHub Logo" class="brand-image" style="height: 50px; width : 50px">
                <span class="brand-text font-weight-light">Found it</span>
            </a>

            <!-- Sidebar -->
            <div class="../../sidebar">
                <!-- User Panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block" style="color: #ccccccc9;"><b><i>Admin page</i></b></a>

                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Users -->
                        <li class="nav-item">
                            <a href="../../users" class="nav-link active">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../../users" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lister</p>
                                    </a>

                                </li>
                            </ul>
                        </li>

                        <!-- Posts -->
                        <li class="nav-item">
                            <a href="../../dashboard" class="nav-link active">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Posts<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../../dashboard" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lister</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- FaQ -->
                        <li class="nav-item">
                            <a href="../../admins" class="nav-link active">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Admin<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../../admins" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lister</p>
                                    </a>
                                    <a href="../../adminAdd" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Post Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-center">
                                            @if ($data['post']->image)
                                            <img src="{{ asset('storage/posts/' . $data['post']->image) }}" alt="Post Image" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                                            @else
                                            <p>No Image</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-8 offset-md-2">
                                            <div class="p-3 bg-light rounded shadow-sm">
                                                <p class="mb-2"><strong>Caption:</strong> {{ $data['post']->caption }}</p>
                                                <p class="mb-2"><strong>User name:</strong> {{ $data['user']->username }}</p> <!-- Assuming user relation -->
                                                <p class="mb-2"><strong>Location:</strong> {{ $data['post']->location }}</p>
                                                <p class="mb-2"><strong>Category:</strong> {{ $data['post']->category }}</p>
                                                <p class="mb-2"><strong>Created At:</strong> {{ $data['post']->created_at }}</p>
                                                <p class="mb-0"><strong>Updated At:</strong> {{ $data['post']->updated_at }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To be customized if needed -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>

</html>