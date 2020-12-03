@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            
            <div class="card">


                <div class="card-body">
                  @foreach ($contracts as $contract)
                  <form method="POST" action="{{ route('edit_contract', $contract->id) }}">
                    @csrf
                   <table class="table table-striped">
                      
                          <tr>
                              <td>Contract Id:</td> 
                                <td>
                                  {{ $contract->id }}
                                </td>
                          </tr>
                          <tr>
                              <td>Contract Name:</td> 
                                <td>
                                  <input id="contract" name="contract" type="text" maxlength="255" autocomplete="off" value='{{ $contract->name }}'/>
                                </td>
                          </tr>
                          <tr>
                              <td>Contract Details:</td> 
                                <td>
                                      <textarea id="details" name="details" type="textbox" maxlength="255" autocomplete="off" rows="3" cols="50">
{{ $contract->details }}
                                       </textarea>
                                </td>
                          </tr>
                          <tr>
                              <td>
                                <button type="submit" class="btn btn-primary">Edit Contract</button>
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
