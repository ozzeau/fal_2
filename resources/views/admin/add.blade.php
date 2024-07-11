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
                            <li class="breadcrumb-item"><a href="">Home</a></li>
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

                        <form id="quickForm" action="{{ route('admin.add') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="card-body">
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="Fname">First name</label>
                                    <input type="text" name="Fname" class="form-control" id="Fname" placeholder="Enter first name" value="{{ old('Fname') }}">
                                    <input type="hidden" name="type" class="form-control" id="Fname" value="1">

                                </div>
                                <div class="form-group">
                                    <label for="Lname">Last name</label>
                                    <input type="text" name="Lname" class="form-control" id="Lname" placeholder="Enter last name" value="{{ old('Lname') }}">

                                </div>
                                <div class="form-group">
                                    <label for="gsm">Phone number</label>
                                    <input type="tel" name="gsm" class="form-control" id="gsm" placeholder="Enter phone number" value="{{ old('gsm') }}">

                                    <input type="hidden" name="type" value="1">
                                </div>
                                <div class="form-group">
                                    <label for="username">User name</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" value="{{ old('username') }}">
                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

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