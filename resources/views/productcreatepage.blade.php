@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-new-task">
                <div class="card-header">New Product</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('product.store') }}">
                        @csrf
                        <div class="form-group">
                            Product Name: <input id="product" name="product" type="text" maxlength="255" class="" autocomplete="off" />
                        <div class="form-group">   
                        </div> 
                            Product Details: <textarea id="details" name="details" type="textbox" maxlength="255"  autocomplete="off" rows="1" cols="40"></textarea>
                        </div>
                        <div class="form-group">
                            With Contract: 
                                <select name="with" id="with">
                                    @foreach ($contracts as $contract)
                                    
                                        <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                                    
                                    @endforeach
                                </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection