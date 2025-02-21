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
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
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
            <li
                    class="nav-item active"
                    data-toggle="tooltip"
                    data-placement="right"
                    title="Dashboard"
            >
                <a class="nav-link" href="/customers">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Customers</span>
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
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/customers">Customers</a>
            </li>
            <li class="breadcrumb-item active">Add New Transaction</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        Add New Customer
                        <a href="/customers" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Customers</a>
                    </div>
                    <div class="card-body">
                        <form action="/transaction/store" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <div class="form-row">
                                    @foreach($customer as $cs)
                                        <input type="hidden" name="custid" id="custid" value="{{$cs->id}}">
                                        <input type="hidden" name="balance" id="balance" value="{{$cs->amount}}">
                                    <div class="col-md-6">
                                        <label for="firstName">Name</label>
                                        <input
                                                class="form-control"
                                                id="firstName" name="firstName"
                                                type="text"
                                                aria-describedby="nameHelp"
                                                placeholder="Enter first name" disabled value="{{$cs->customername}}"
                                        />
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="email">Type</label>
                                        <select name="transtype">
                                            <option value="Credit">Credit</option>
                                            <option value="Debt">Debt</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="amount">Amount</label>
                                        <input
                                                class="form-control"
                                                id="amount" name="amount"
                                                type="tel"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter amount"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amount">Date</label>
                                        <input
                                                class="form-control"
                                                id="creditdate" name="creditdate"
                                                type="date"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter Credited date"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amount">IP</label>
                                        <input
                                                class="form-control"
                                                id="ip" name="ip"
                                                type="text"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter IP"
                                        />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Transaction</button>
                        </form>
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

