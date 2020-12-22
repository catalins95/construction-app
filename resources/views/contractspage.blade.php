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
                       @foreach ($contracts as $contract)
                          @if($contract->id == 1)  
                          @else
                            <tr>
                                <td>{{ $contract->id }} </td>
                                <td><a href="/view_contract/{{ $contract->id }}">{{ $contract->name }}</a></td>
                                <td>{{ $contract->created_at }} </td>
                                <td> 
                                      <form method="POST" >
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-delete-action" formaction="{{ route('deletecontract', $contract->id) }}"> <font color='red'>X</font> </button>
                                           
                                       </form>
                                 </td>
                            </tr>
                          @endif
                       @endforeach
                   </table>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
