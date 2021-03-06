@extends('adminMaster')
@section('body')
    <div class="content-inner">
        <!-- Page Header-->
        <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom"></h2>
            </div>

            <div class="container row">

                <div class="col-lg-4">

                    <h2 class="header">User Profile</h2>
                    <br/>
                    <form action="{{route('admin_user_edit',['id' => $user->id * 8009 * 8009])}}" method="POST">
                        @include('Partials._message')
                        {{csrf_field()}}
                        <label for="fullname">Full Name: </label>
                        <div class="form-group">
                            <input type="text" name="fullname" disabled id="fullname" class="form-control" value="{{$user->fullname}}"/>
                        </div>
                        <label for="email">Email Address: </label>
                        <div class="form-group">
                            <input type="text" name="email" id="email" disabled class="form-control" value="{{$user->email}}"/>
                        </div>
                        <label for="reg_type">Registration Type: </label>
                        <div class="form-group">
                            <input type="text" disabled class="form-control" value="{{$user->Reg->name}}"/>
                        </div>
                        <label for="email">Referral Link:  </label>
                        <div class="form-group">
                            <input type="text" disabled class="form-control" value="{{$user->r_link}}"/>
                        </div>
                        <label for="reg_type">Referrer: </label>
                        <div class="form-group">
                            @if($user->referrer_id == null)
                                <p>No Referrer</p>
                            @else
                                <a href="{{route('admin_user_view',['id' => $user->referrer_id * 8009 * 8009])}}" class="btn btn-outline-info"> <i class="fa fa-eye"></i> {{\App\User::find($user->referrer_id)->email}} </a>
                            @endif
                        </div>
                        <label for="pay_type"> Payment Type: </label>
                        <div class="form-group">
                            <?php $cl = \App\PaymentType::all()?>
                            <select disabled class="form-control" id="class_id" name="class_id">
                                @foreach($cl as $c)
                                    @if($c->id  == $user->class_id)
                                        <option selected value="{{$c->id}}">{{$c->name}}</option>
                                    @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <label for="class_id">Class: </label>
                        <div class="form-group">
                            <?php $cl = \App\TClass::all()?>
                            <select class="form-control" id="class_id" name="class_id">
                                <option value="">No Class Yet</option>
                                @foreach($cl as $c)
                                    @if($c->id  == $user->class_id)
                                        <option selected value="{{$c->id}}">{{$c->name}}</option>
                                    @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <label for="class_id">Activated: </label>
                        <div class="form-group">
                            <select class="form-control" id="activated" name="activated">
                                @if($user->activated)
                                    <option value="0">False</option>
                                    <option selected value="1">True</option>
                                @else
                                    <option selected value="0">False</option>
                                    <option value="1">True</option>
                                @endif
                            </select>
                        </div>
                        <label for="is_active">Active: </label>
                        <div class="form-group">
                            <select class="form-control" id="is_active" name="is_active">
                                @if($user->activated)
                                    <option value="0">False</option>
                                    <option selected value="1">True</option>
                                @else
                                    <option selected value="0">False</option>
                                    <option value="1">True</option>
                                @endif
                            </select>
                        </div>
                        <label for="password">Enter Your Admin Password To Effect Change:  </label>
                        <div class="form-group">
                            <input type="password" name="password" required id="password" class="form-control" placeholder="Password"/>
                        </div>

                        <button class="btn btn-primary btn-block" type="submit"> <i class="fa fa-save"></i> Update </button>
                    </form>
                </div>
            </div>
        </header>
    </div>
@endsection