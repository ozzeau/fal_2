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
                            <input type="text" id="categorySearchInput" class="form-control float-right" placeholder="Search by Category" onkeyup="searchByCategory()">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Posts Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($data->isEmpty())
                                <p>No posts found.</p>
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
                                                <th>Caption</th>
                                                <th>User</th>
                                                <th>Image</th>
                                                <th>Location</th>
                                                <th>Category</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->caption }}</td>
                                                <td>{{ $post->user_id }}</td>
                                                <td>
                                                    @if ($post->image)
                                                    <img src="{{ asset('storage/posts/'.$post->image) }}" alt="Post Image" style="max-width: 100px; max-height: 100px;">
                                                    @else
                                                    No Image
                                                    @endif
                                                </td>
                                                <td>{{ $post->location }}</td>
                                                <td>{{ $post->categorie }}</td>
                                                <td>{{ $post->created_at }}</td>
                                                <td>{{ $post->updated_at }}</td>
                                                <td>
                                                    <form action="{{route('admin.deletePost',$post->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                                <td><a href="infoPost/{{$post->id}}/{{$post->user_id}}" class="btn btn-info btn-sm">Infos</a></td>
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
        // Function to search table rows by category
        function searchByCategory() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("categorySearchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("example1");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 1; i < tr.length; i++) { // Start from 1 to skip table header
                td = tr[i].getElementsByTagName("td")[5]; // 5 is the index of the Category column
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