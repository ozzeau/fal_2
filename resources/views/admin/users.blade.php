@include('assets.headerAdmin')

<body class="hold-transition sidebar-mini layout-fixed">
    @include('assets.navbarAdmin')
    @include('assets.sidebarAdmin')

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
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" id="usernameSearchInput" class="form-control float-right" placeholder="Search by Username" onkeyup="searchByUsername()">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($data->isEmpty())
                                <p>No users found.</p>
                                @else
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Image</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Phone Number</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $usr)
                                            <tr>
                                                <td>{{ $usr->id }}</td>
                                                <td>{{ $usr->Fname }}</td>
                                                <td>{{ $usr->Lname }}</td>
                                                <td>
                                                    @if ($usr->image)
                                                    <img src="{{ asset('storage/users/'.$usr->image) }}" alt="User Image" style="max-width: 100px; max-height: 100px;">
                                                    @else
                                                    No Image
                                                    @endif
                                                </td>
                                                <td>{{ $usr->email }}</td>
                                                <td>{{ $usr->username }}</td>
                                                <td>{{ $usr->gsm }}</td>
                                                <td>{{ $usr->created_at }}</td>
                                                <td>{{ $usr->updated_at }}</td>
                                                <td>
                                                    <form action="/admin/deleteUser/{{$usr->id}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <!-- Add any table footer content if needed -->
                                        </tfoot>
                                    </table>
                                </div>
                                @endif
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
    <script>
        // Function to search table rows by username
        function searchByUsername() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("usernameSearchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("example1");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 1; i < tr.length; i++) { // Start from 1 to skip table header
                td = tr[i].getElementsByTagName("td")[5]; // 5 is the index of the Username column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>