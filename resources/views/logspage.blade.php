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
                              <th>LogID</th>
                              <th>Action</th>
                              <th>Type</th>
                              <th>Model ID</th>
                              <th>Date</th>
                          </tr>
                       @foreach ($logs as $log)
                           <tr>
                                <td>{{ $log->id }} </td>
                                <td>
                                  @if ($log->action == 'create')
                                    <b><font color=green>Create</font></b>
                                  @elseif ($log->action == 'update') 
                                    <b><font color=orange>Update</font></b>
                                  @elseif ($log->action == 'delete') 
                                    <b><font color=red>Delete</font></b>
                                  @endif
                                </td>
                                <td>{{ $log->type }} </td>
                                <td>{{ $log->modelid }} </td>
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
