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
                              <th>Name</th>
                              <th>Created At</th>
                              <th>Action</th>
                          </tr>
                       @foreach ($suppliers as $supplier)
                           <tr>
                                <td>{{ $supplier->id }} </td>
                                <td>{{ $supplier->name }} </td>
                                <td>{{ $supplier->created_at }} </td>
                                <td> x </td>
                           </tr>
                       @endforeach
                   </table>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
