@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-new-task">
                <div class="card-header">New Contract</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('contract.store') }}">
                        @csrf
                        <div class="form-group">
                            Contract Name: <input id="contract" name="contract" type="text" maxlength="255" class="" autocomplete="off" />
                        <div class="form-group">   
                        </div> 
                            Contract Details: <textarea id="details" name="details" type="textbox" maxlength="255"  autocomplete="off" rows="1" cols="40"></textarea>
                        </div>
                        <div class="form-group">
                            With Supplier: 
                                <select name="with" id="with">
                                    @foreach ($suppliers as $supplier)
                                    
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    
                                    @endforeach
                                </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection