<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MINI BANK | Admin</title>
    <!-- Bootstrap core CSS-->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom fonts for this template-->
    <link
        href="/vendor/font-awesome/css/font-awesome.min.css"
        rel="stylesheet"
        type="text/css"
    />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin.css" rel="stylesheet" />
</head>
@php
$url = $_SERVER['REQUEST_URI'];
$ex = explode('/', trim($url, '/'));
$custid=end($ex);
@endphp
<body class="fixed-nav sticky-footer bg-dark" id="page-top" >
<!-- Navigation-->
<nav
    class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top"
    id="mainNav"
>
    <a class="navbar-brand" href="/">MINI BANK</a>

    <button
        class="navbar-toggler navbar-toggler-right"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
        aria-controls="navbarResponsive"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li
                class="nav-item"
                data-toggle="tooltip"
                data-placement="right"
                title="Dashboard"
            >
                <a class="nav-link" href="/">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li
                class="nav-item active"
                data-toggle="tooltip"
                data-placement="right"
                title="Dashboard"
            >
                <a class="nav-link" href="#">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Transactions</span>
                </a>
            </li>
            <li
                    class="nav-item active"
                    data-toggle="tooltip"
                    data-placement="right"
                    title="Dashboard"
            >
                <a class="nav-link" href="{{route('logout')}}" >
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Logout</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>

    </div>
</nav>


<div class="content-wrapper">

    <div class="container-fluid">
        <!-- Breadcrumbs-->


{{--        <ol class="breadcrumb">--}}

{{--            <li class="breadcrumb-item active">Transactions</li>--}}
{{--        </ol>--}}

        <div class="row">

            <div class="col-12">
                <div class="text-danger validation-summary-errors">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                </div>
{{--                <div class="col-12" style="float:right;">--}}
{{--                    <a href="/customers" class="btn btn-primary " ><i class="fa fa-arrow-left"></i> Customers</a></div>--}}
{{--                <br>--}}
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            @foreach($customer as $cs)
                            <h5>Listing Transactions of <b>{{$cs->customername}}</b></h5>
                            @if($cs->amount<0)
                            @php
                            $bal="Insufficient Balance";
                            @endphp
                            @else
                            @php
                            $bal= $cs->amount;
                            @endphp
                            @endif
                            <p>Balance : {{$bal}}</p>
                            @endforeach
                        </div>

                        <div>
                            <a href="/addtransaction/{{$custid}}" class="btn btn-primary"><i class="fa fa-arrow-plus"></i> Add Transac</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>ip</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $tran)
                            <tr>
                                <td>{{$tran->type}}</td>
                                <td>{{$tran->date}}</td>
                                <td>{{$tran->amount}}</td>
                                <td>{{$tran->ip}}</td>
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
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Your Website 2017</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin.min.js"></script>
    <script>
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    </script>
</div>
</body>
</html>

