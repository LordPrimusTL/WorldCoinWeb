@extends('adminMaster')
@section('body')
    <div class="content-inner">
        <!-- Page Header-->
        <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom"></h2>
            </div>


            <div class="row">
                <div class="col-lg-12" style="margin-left: 10px;">
                    <p>Search Here...</p>
                    <!--<form class="form-" method="POST" action="">
                        {{csrf_field()}}
                        <div class="col-lg-3">
                            <div class="form-group-sm ">
                                <select class="form-control input-group-sm" name="filt" id="filt">
                                    <option value="0">ID</option>
                                    <option value="1">Name</option>
                                    <option value="2">Email</option>
                                    <option value="3">Country</option>
                                    <option value="4">State</option>
                                    <option value="5">City</option>
                                    <option value="6">Level ID(Numbers)</option>
                                    <option value="7">Active(1 or 0)</option>
                                </select>

                                <input type="search" class="form-control input-sm small" name="key" id="key" placeholder="Search Key"/>
                                <a href="" style="margin-top: 5px;" class="btn btn-outline-primary btn-sm">All User</a>
                                <button style="margin-top: 5px;" class="btn btn-outline-primary btn-sm pull-right"  type="submit"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>-->
                    <br/>
                    <br/>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-4">
                @include('Partials._message')
                <div class=" table table-responsive">
                    <table id="table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->fullname}}</td>
                                <td>{{$user->email}}</td><td>
                                    <a href="{{route('admin_user_view',['id' => $user->id * 8009 * 8009])}}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> View</a>
                                    <a href="" onclick="return confirm('Are you sure you want to delete this User?');" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </header>
    </div>
@endsection