@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-new-task">
                <div class="card-header">New Supplier</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('supplier.store') }}">
                        @csrf
                        <div class="form-group">
                            Supplier Name: <input id="supplier" name="supplier" type="text" maxlength="255" class="" autocomplete="off" />
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
