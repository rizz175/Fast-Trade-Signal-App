@extends('layout')

@section('title')
    Historical Forex Signals
@endsection

@section('content')

<div class="card">
    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Symbol</th>
                <th>Type</th>
                <th>TP</th>
                <th>SL</th>
                <th>Profit</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\Forex::onlyTrashed()->get() as $key => $forex)
            <tr>
                <td>{{$key+1}}</td>
                <td><?php echo strtoupper($forex->symbol);?></td>
                <td>{{$forex->type}}</td>
                <td>{{$forex->tp}}</td>
                <td>{{$forex->sl}}</td>
                <td>
                    
                    <?php
                    
                    if($forex->profit!='')
                    {
                
                        echo $forex->profit.' pips';
                    }
                    else
                    {
                    
                        echo '-';
                    
                    }
                    
                    ?>
                
                </td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" symbol="{{$forex->symbol}}"
                    id="{{$forex->id}}" type="{{$forex->type}}" tp="{{$forex->tp}}" sl="{{$forex->sl}}" lot="{{$forex->lot}}" profit="{{$forex->profit}}"
                     class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="{{route("deleteHistoricalForex",$forex->id)}}" method="POST">
                        {{-- @method('DELETE') --}}
                        @csrf
                    <button type="submit"  class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
       {{-- modal for historical forex signals --}}
<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Forex</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control" type="text" id="symbol" name="symbol"  placeholder="Enter symbol"  onkeyup="this.value = this.value.toUpperCase();" required>
                    </div> 
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class='form-control select2 validate-hidden' id='type' required>
    
                                <option value="">Select...</option>
                                    
                                <option  value="Buy">Buy</option>
                                
                                <option value="Sell">Sell</option>
                                
                                <option value="BuyStop">BuyStop</option>
                                
                                <option value="SellStop">SellStop</option>
                                												
                                <option value="BuyLimit">BuyLimit</option>
                                
                                <option value="SellLimit">SellLimit</option>
                                												
                            </select>
                    </div>
                     <div class="form-group">
                        <label for="tp">TP</label>
                        <input class="form-control" type="text" id="tp" name="tp" placeholder="Enter tp" required>
                    </div> 
                    <div class="form-group">
                        <label for="tp">SL</label>
                        <input class="form-control" type="text" id="sl" name="sl" placeholder="Enter sl" required>
                    </div>  
                    
                    <div class="form-group">
                        <label for="profit">Profit</label>
                        <input class="form-control" type="text" id="profit" name="profit" placeholder="Enter profit"  required>
                    </div>
        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){

            let id = $(this).attr('id');
            let symbol = $(this).attr('symbol');
            let type = $(this).attr('type');
            let tp = $(this).attr('tp');
            let sl = $(this).attr('sl');
            let profit = $(this).attr('profit');
        
            $('#id').val(id);
            $('#symbol').val(symbol);
            $('#type').val(type);
            $('#tp').val(tp);
            $('#sl').val(sl);
            $('#profit').val(profit);

            $('#updateForm').attr('action','{{route('updatehistoricalforex','')}}' +'/'+id);
        });
    });
</script>
@endsection