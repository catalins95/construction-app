@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                   <table class="table table-striped">
                          <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Created At</th>
                              <th>Action</th>
                          </tr>
                       @foreach ($products as $product)
                           <tr>
                                <td>{{ $product->id }} </td>
                                <td><a href="/view_product/{{ $product->id }}">{{ $product->name }}</a></td>
                                <td>{{ $product->created_at }} </td>
                                <td> 
                                      <form method="POST" >
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-delete-action" formaction="{{ route('deleteproduct', $product->id) }}"> <font color='red'>X</font> </button>
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
