@include('layout/header')

@section('title', 'Dashboard')


<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                >
                    <strong>Welcome</strong> You're successfully logged in.
                    <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <h5><a href="customers.html" class="text-white">Total Users</a></h5>

                                <p class="mb-0">{{$totcustomers}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">
                                <h5>Total Revenue</h5>
                                <p class="mb-0">{{$totrevenue}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
@include('layout/footer')