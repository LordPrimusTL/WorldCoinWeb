@extends('master')
@section('body')
    <div class="container-fluid jumbotron" style="background-color: white;">
        <p class="well-sm lead">
        <h3 class="text-center" style="color:green;">Before you proceed,hear this;</h3>
        <p class="well-sm container">
            <b style="color:green;">NOTE:</b>
            Trading Amount starts from WCM10,000.
            Please note that you wont be able to withdraw your profit until the end of the Duration.Although you will be able to withdraw
            your referral bonuses.
        </p>
    </div>
    <!--// brief information about us ends here-->
    <h4 class="container-fluid text-center" style="margin-top:5px;margin-bottom:10px;font-size:29px;color:greenyellow">TRADING PAGE</h4>
    <div class="container-fluid" style="margin-top:60px;">
        <form action="{{route('user_invest_post')}}" method="post" id="Regfrom">
            {{csrf_field()}}
            <div class="col-md-offset-2 col-md-8">
                @include('Partials._message')
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group form-group col-md-12">
                            <input type="number"  name="duration" id="duration" required class="form-control input input-lg"  placeholder="Duration Of Investment(Month)"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group form-group col-md-12">
                            <input type="number" min="10000" name="amount" id="amount" required class="form-control input input-lg"  placeholder="Amount"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p><i>By Clicking The Trade Button, You Agree to Our Terms And Condition</i></p>
                        <br/>
                        <div class="form-group  col-md-12 input-group">
                            <input type="submit" class="btn btn-block btn-lg" style="background-color: green; color: white;" value="Trade"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    @if($inv != null)

        <div class="row" style="margin-bottom: 300px;">
            <div class="container">
                <h4 class="container-fluid text-center" style="margin-top:5px;margin-bottom:10px;font-size:29px;color:greenyellow">INVESTMENT HISTORY</h4>
                <br/>
                <table class="table table-responsive table-bordered">
                    <thead>
                    <th>S/N</th>
                    <th>DATE</th>
                    <th>AMOUNT</th>
                    <th>DURATION(MONTH)</th>
                    <th>INTEREST RATE(%)</th>
                    <th>STATUS</th>
                    </thead>
                    <tbody>
                    <?php $i = 1?>
                    @foreach($inv as $in)
                        <tr class="@if($in->ts_id == 1) alert-success @elseif($in->ts_id == 3) alert-warning @endif">
                            <td>{{$i++}}</td>
                            <td>{{\Carbon\Carbon::parse($in->created_at)}}</td>
                            <td>{{$in->amount}}</td>
                            <td>{{$in->duration}}</td>
                            <td>{{$in->irate}}</td>
                            <td>{{$in->status->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="jumbotron text-center">
            <p>No Investment Yet</p>
        </div>
    @endif
@endsection