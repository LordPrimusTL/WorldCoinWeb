@extends('master')
@section('body')
    <div class="container " style="margin-top:150px;margin-bottom:100px;">
        <div class="col-md-offset-2 col-md-7 ">
            <form action="#" method="post" style="margin-left:50px;" id="Regform" >
                <h4 style="margin-top:5px;margin-bottom:10px;font-size:29px;">Login Information</h4>
                {{csrf_field()}}
                <div class="input-group form-group col-md-12">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-envelope">
						</span>
					</span>
                    <input type="text" class="form-control input input-lg" placeholder="Email Address">
                </div>
                <div class="input-group form-group col-md-12">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-pencil">
						</span>
					</span>
                    <input type="password" class="form-control input input-lg" placeholder="Password">
                </div>
                <div class="form-group  col-md-12 input-group">
                    <input type="submit" class="btn btn-block btn-lg" value="Submit"/>
                </div>
            </form>
            <div class="col-md-offset-3 acct">
                <a href="{{route('register')}}"><h5 >Haven't registered yet?<b style="color:green">Click HERE</b></h5></a>
            </div>

        </div>
    </div>
@endsection