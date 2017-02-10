@extends('layouts.default')

@section('title', 'Edit Form Section')

@section('breadcrumbs', '<a href="/admin"><i class="ion-android-options"></i> Dashboard</a> / <a href="/admin/form/">Report Form</a> / '.$fsection->label)

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <h1>{{$fsection->label}}</h1>

                    <div class="row">

                        <div class="col-sm-4 col-sm-push-8">
                            <h2>Add Description Area</h2>
                            <form action="/admin/form/{{ $id }}/description_area" method="post">
                                {{ csrf_field() }}
                                <input type="text" name="label" class="form-control">
                                <input type="submit" id="new" class="btn btn-primary" value="Submit">
                            </form>
                        </div>

                        <div class="col-sm-8 col-sm-pull-4">
                            <h2>Available Description Areas</h2>
                            <table class="table table-striped">
                                <tr><th style="width:99%;">Label</th><th>Edit</th><th>Delete?</th></tr>

                                @foreach ($fsection->description_areas()->where('active',1)->get() as $fdescriptionarea)
                                <tr>
                                    <td>{{ $fdescriptionarea->label }}</td>
                                    <td><a href="/admin/form/{{$fsection->id}}/description_area/{{$fdescriptionarea->id}}"><button class="btn btn-primary ion-edit"></button></a></td>
                                    <td><a href="/admin/form/{{$fsection->id}}/description_area/delete/{{$fdescriptionarea->id}}" class="check"><button class="btn btn-primary ion-trash-b"></button></a></td>
                                </tr>
                                @endforeach
                            </table>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-sm-4 col-sm-push-8">
                            <h2>Add Concern Area</h2>
                            <form action="/admin/form/{{ $id }}/concern_area" method="post">
                                {{ csrf_field() }}
                                <input type="text" name="label" class="form-control">
                                <input type="submit" id="new" class="btn btn-primary" value="Submit">
                            </form>
                        </div>

                        <div class="col-sm-8 col-sm-pull-4">
                            <h2>Available Concern Areas</h2>
                            <table class="table table-striped">
                                <tr><th style="width:99%;">Label</th><th>Edit</th><th>Delete?</th></tr>

                                @foreach ($fsection->concern_areas()->where('active',1)->get() as $fconcernarea)
                                <tr>
                                    <td>{{ $fconcernarea->label }}</td>
                                    <td><a href="/admin/form/{{$fsection->id}}/concern_area/{{$fconcernarea->id}}"><button class="btn btn-primary ion-edit"></button></a></td>
                                    <td><a href="/admin/form/{{$fsection->id}}/concern_area/delete/{{$fconcernarea->id}}" class="check"><button class="btn btn-primary ion-trash-b"></button></a></td>
                                </tr>
                                @endforeach
                            </table>

                        </div>

                    </div>

                    
            </section> <!-- /#about -->



@stop