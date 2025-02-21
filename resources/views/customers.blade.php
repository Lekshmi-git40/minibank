@include('layout/header')
@section('title', 'Customers')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Customers</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="text-danger validation-summary-errors">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        Listing Customers
                        <a href="addcustomer" class="btn btn-primary"><i class="fa fa-plus"></i> Add Customer</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Customer Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Amount</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $customer)
                            <tr>
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->customername}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->amount}}</td>
                                <td>{{$customer->credited_on}}</td>
                                <td><a href="transactions/{{$customer->id}}" class="btn btn-sm btn-primary">Transactions ( 12 )</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@include('layout/footer')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <script>
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    </script>