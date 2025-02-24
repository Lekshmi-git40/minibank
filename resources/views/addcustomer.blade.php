@include('layout/header')

@section('title', 'Customers')


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
            <li class="breadcrumb-item active">Add New Customer</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        Add New Customer
                        <a href="/customers" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Customers</a>
                    </div>
                    <div class="card-body">
                        <form action="/customers/store" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="firstName">First name</label>
                                        <input
                                                class="form-control"
                                                id="firstName" name="firstName"
                                                type="text"
                                                aria-describedby="nameHelp"
                                                placeholder="Enter first name" value="{{old('firstName')}}"
                                        />
                                        <span style="color:red">@error('firstName'){{$message}} @enderror</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName">Last name</label>
                                        <input
                                                class="form-control"
                                                id="lastName" name="lastName"
                                                type="text"
                                                aria-describedby="nameHelp"
                                                placeholder="Enter last name" value="{{old('lastName')}}"
                                        />
                                        <span style="color:red">@error('lastName'){{$message}} @enderror</span>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="email">Email address</label>
                                        <input
                                                class="form-control"
                                                id="email" name="email"
                                                type="email"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter email" value="{{old('email')}}"
                                        />
                                        <span style="color:red">@error('email'){{$message}} @enderror</span>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Password</label>
                                        <input
                                                class="form-control"
                                                id="password" name="password"
                                                type="password"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter password"
                                        />
                                        <span style="color:red">@error('password'){{$message}} @enderror</span>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone">Phone number</label>
                                        <input
                                                class="form-control"
                                                id="phone" name="phone"
                                                type="tel"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter phone" value="{{old('phone')}}"
                                        />
                                        <span style="color:red">@error('phone'){{$phone}} @enderror</span>

                                    </div>
{{--                                    <div class="col-md-6">--}}
{{--                                        <label for="amount">Amount</label>--}}
{{--                                        <input--}}
{{--                                                class="form-control"--}}
{{--                                                id="amount" name="amount"--}}
{{--                                                type="tel"--}}
{{--                                                aria-describedby="emailHelp"--}}
{{--                                                placeholder="Enter amount"--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label for="amount">Credited on</label>--}}
{{--                                        <input--}}
{{--                                                class="form-control"--}}
{{--                                                id="creditdate" name="creditdate"--}}
{{--                                                type="date"--}}
{{--                                                aria-describedby="emailHelp"--}}
{{--                                                placeholder="Enter Credited date"--}}
{{--                                        />--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Customer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@include('layout/footer')
