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
                                <td><a href="/view_supplier/{{ $supplier->id }}">{{ $supplier->name }}</a> </td>
                                <td>{{ $supplier->created_at }} </td>
                                <td> 
                                      <form method="POST" >
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-delete-action" formaction="{{ route('deletesupplier', $supplier->id) }}"> <font color='red'><b>X</b></font> </button>
                                           
                                       </form>
                                 </td>
                           </tr>
                       @endforeach
                   </table>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
