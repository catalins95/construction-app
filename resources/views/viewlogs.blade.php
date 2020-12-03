@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            
            <div class="card">
              <center>


                <div class="card-body">
                   <table class="table table-striped">
                          <tr>
                              <th>ID</th>
                              <th>Action</th>
                              <th>Type</th>
                              <th>Date</th>
                          </tr>
                       @foreach ($logs as $log)
                           <tr>
                                <td>{{ $log->id }} </td>
                                <td>{{ $log->action }} </td>
                                <td>{{ $log->type }} </td>
                                <td>{{ $log->created_at }} </td>
                           </tr>
                       @endforeach
                   </table>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
