@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                            <form method="POST" action="{{ route('edit_supplier', $supplier->id) }}">
                              @csrf
                             <table class="table table-striped">
                                
                                    <tr>
                                        <td>Supplier Id:</td> 
                                          <td>
                                            {{ $supplier->id }}
                                          </td>
                                    </tr>
                                    <tr>
                                        <td>Supplier Name:</td> 
                                          <td>
                                            <input id="supplier" name="supplier" type="text" maxlength="255" autocomplete="off" value='{{ $supplier->name }}'/>
                                          </td>
                                    </tr>
                                    <tr>
                                        <td>Supplier Details:</td> 
                                          <td>
                                                <textarea id="details" name="details" type="textbox" maxlength="255" autocomplete="off" rows="3" cols="50">{{ $supplier->details }}</textarea>
                                          </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <button type="submit" class="btn btn-primary">Edit Supplier</button>
                                        </td>
                                     </tr>
                             </table>
                          </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
