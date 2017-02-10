@extends('layouts.default')

@section('title', 'Edit Report Form')

@section('breadcrumbs', '<a href="/admin"><i class="ion-android-options"></i> Dashboard</a> / Report Form')

@section('content')


            <!--
            ==================================================
            Slider Section Start
            ================================================== -->
            <section id="about">
                <div class="container">

                    <div class="row">

                        <div class="col-sm-4 col-sm-push-8">
                            <h2>Add Section</h2>
                            <form action="/admin/form" method="post">
                                {{ csrf_field() }}
                                <input type="text" name="label" class="form-control">
                                <input type="submit" id="newSection" class="btn btn-primary" value="Submit">
                            </form>
                        </div>

                        <div class="col-sm-8 col-sm-pull-4">
                            <h2>Available Report Sections</h2>
                            <table class="table table-striped">
                                <tr><th style="width:99%;">Label</th><th>Edit</th><th>Delete?</th></tr>

                                @foreach ($fsections as $fsection)
                                <tr>
                                    <td>{{ $fsection->label }}</td>
                                    <td><a href="/admin/form/{{$fsection->id}}"><button class="btn btn-primary ion-edit"></button></a></td>
                                    <td><a href="/admin/form/delete/{{$fsection->id}}" class="check"><button class="btn btn-primary ion-trash-b"></button></a></td>
                                </tr>
                                @endforeach
                            </table>

                        </div>

                    </div>

                    <div class="row">
                </div>
            </section> <!-- /#about -->



@stop