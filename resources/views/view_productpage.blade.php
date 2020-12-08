@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            
            <div class="card">


                <div class="card-body">
                  @foreach ($products as $product)
                  <form method="POST" action="{{ route('edit_product', $product->id) }}">
                    @csrf
                   <table class="table table-striped">
                      
                          <tr>
                              <td>Product Id:</td> 
                                <td>
                                  {{ $product->id }}
                                </td>
                          </tr>
                          <tr>
                              <td>Product Name:</td> 
                                <td>
                                  <input id="product" name="product" type="text" maxlength="255" autocomplete="off" value='{{ $product->name }}'/>
                                </td>
                          </tr>
                          <tr>
                              <td>Product Details:</td> 
                                <td>
                                      <textarea id="details" name="details" type="textbox" maxlength="255" autocomplete="off" rows="3" cols="50">
{{ $product->details }}
                                       </textarea>
                                </td>
                          </tr>
                          <tr>
                              <td>
                                <button type="submit" class="btn btn-primary">Edit Product</button>
                              </td>
                           </tr>
                    
                   </table>
                </form>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection