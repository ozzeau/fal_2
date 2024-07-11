<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

<aside id="mainSidebar" class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="#" class="brand-link flex items-center justify-center">
        <img src="{{ asset('storage/icons/lost-found.png') }}" alt="logo" width="130" height="32" class="py-3">
    </a>



    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><b><i>Admin page</i></b></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Users -->
                <li class="nav-item">
                    <a href="users" class="nav-link active">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="users" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>

                        </li>
                    </ul>
                </li>

                <!-- Posts -->
                <li class="nav-item">
                    <a href="dashboard" class="nav-link active">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Posts<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="dashboard" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>

                        </li>
                    </ul>
                </li>

                <!-- FaQ -->
                <li class="nav-item">
                    <a href="admins" class="nav-link active">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Admin<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admins" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                            <a href="adminAdd" class="nav-link">
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to hide sidebar
        function hideSidebar() {
            if (document.body.classList.contains('sidebar-open')) {
                document.body.classList.remove('sidebar-open');
                document.body.classList.add('sidebar-collapse');
            }
        }

        // Listen for click events on the body
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('mainSidebar');
            const menuButton = document.querySelector('[data-widget="pushmenu"]');

            // If the click is outside the sidebar and not on the menu button
            if (!sidebar.contains(event.target) && !menuButton.contains(event.target)) {
                hideSidebar();
            }
        });
    });
</script>