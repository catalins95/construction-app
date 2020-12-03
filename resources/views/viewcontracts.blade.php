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
                              <th>With Supplier</th>
                              <th>Created At</th>
                              <th>Action</th>
                          </tr>
                       @foreach ($contracts as $contract)
                           <tr>
                                <td>{{ $contract->id }} </td>
                                <td>{{ $contract->name }} </td>
                                <td>{{ $contract->with }} </td>
                                <td>{{ $contract->created_at }} </td>
                                <td> 
                                      <form method="POST" >
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-delete-action" formaction="{{ route('deletecontract', $contract->id) }}">X</button>
                                           
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
