@extends('layouts.default')

@section('title', 'Report Details')

@section('breadcrumbs', '<a href="/admin"><i class="ion-android-options"></i> Dashboard</a> / <a href="/admin/report/'.$report->id.'">Report</a> / Report Details')

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <div class="row">

                        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                            <h1>Edit Details</h1>

                            <form method="post" action="/admin/report/{{ $report->id }}/details">

                            {{ csrf_field() }}

                            <h3>Client Details</h3>

                            <table class="table">

                                <tr><td>First Name</td><td><input type="text" name="fname" id="fname" value="{{$report->fname}}" class="form-control"></td></tr>
                                <tr><td>Last Name</td><td><input type="text" name="lname" id="lname" value="{{$report->lname}}" class="form-control"></td></tr>
                                <tr><td>Address</td><td><input type="text" name="caddress" id="caddress" value="{{$report->caddress}}" class="form-control"></td></tr>
                                <tr><td>City</td><td><input type="text" name="ccity" id="ccity" value="{{$report->ccity}}" class="form-control"></td></tr>
                                <tr><td>State</td><td><input type="text" name="cstate" id="cstate" value="{{$report->cstate}}" class="form-control"></td></tr>
                                <tr><td>Zip</td><td><input type="text" name="czip" id="czip" value="{{$report->czip}}" class="form-control"></td></tr>
                                <tr><td>Mobile Phone</td><td><input type="text" name="cmobile_phone" id="cmobile_phone" value="{{$report->cmobile_phone}}" class="form-control"></td></tr>
                                <tr><td>Home Phone</td><td><input type="text" name="chome_phone" id="chome_phone" value="{{$report->chome_phone}}" class="form-control"></td></tr>
                                <tr><td>Email</td><td><input type="text" name="email" id="email" value="{{$report->email}}" class="form-control"></td></tr>

                            </table>

                            <h3>Property Details</h3>

                            <button type="button" id="copy_prop_details" class="btn btn-info">Same As Client</button>

                            <script type="application/javascript">

                                $('#copy_prop_details').click(function(){

                                    $('#paddress').val($('#caddress').val());
                                    $('#pcity').val($('#ccity').val());
                                    $('#pstate').val($('#cstate').val());
                                    $('#pzip').val($('#czip').val());

                                });

                            </script>

                            <table class="table">

                                <tr><td>Address</td><td><input type="text" name="paddress" id="paddress" value="{{$report->paddress}}" class="form-control"></td></tr>
                                <tr><td>City</td><td><input type="text" name="pcity" id="pcity" value="{{$report->pcity}}" class="form-control"></td></tr>
                                <tr><td>State</td><td><input type="text" name="pstate" id="pstate" value="{{$report->pstate}}" class="form-control"></td></tr>
                                <tr><td>Zip</td><td><input type="text" name="pzip" id="pzip" value="{{$report->pzip}}" class="form-control"></td></tr>

                            </table>

                            <h3>Inspections Details</h3>

                            <table class="table">

                                <tr><td>Inspection Date</td><td><input type="date" name="date_inspection" id="date_inspection" value="{{$report->date_inspection}}" class="form-control"></td></tr>
                                <tr><td>Inspection Time</td><td><input type="time" name="time_inspection" id="time_inspection" value="{{$report->time_inspection}}" class="form-control"></td></tr>

                            </table>

                            <input type="submit" class="btn btn-primary" value="Save"> <a href="/admin/report/{{$report->id}}" class="btn btn-default">Cancel</a> *Note: Unsaved edits will be lost

                            </form>

                        </div>

                    </div>

                    <div class="row">
                </div>
            </section> <!-- /#about -->



@stop