@extends('layout')

@section('title')
    Setting
@endsection

@php
    if($setting)
    {
        $support_email = $setting->support_email;
        $android_version = $setting->android_version;
        $ios_version = $setting->ios_version;
        $cover_image = $setting->cover_image;
        $image_url = $setting->image_url;
        $disclaimer = $setting->disclaimer;
    }
    else {
        $support_email = '';
        $android_version = '';
        $ios_version = '';
        $cover_image = '';
        $image_url = '';
        $disclaimer = '';
    }
@endphp

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-danger">{{$error}}</p>
                @endforeach
            @endif

            {{-- <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Forex</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div> --}}

            <div class="card-body">
                <form action="{{route('setting.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Support Email</label>
                            <input name="support_email" type="text" class="form-control" placeholder="Enter support email" value="{{ $support_email }}" required>
                        </div> 
                        <div class="form-group col-md-4">
                            <label>Android Version</label>
                            <input name="android_version" type="text" class="form-control" placeholder="Enter android version" value="{{ $android_version }}" required>
                        </div> 
                        <div class="form-group col-md-4">
                            <label>IOS Version</label>
                            <input name="ios_version" type="text" class="form-control" placeholder="Enter IOS version" value="{{ $ios_version }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cover Image</label>
                            <input name="cover_image" type="file" class="form-control">
                            @if ($cover_image)
                                <img src="{{ asset('uploads/'.$cover_image) }}" class="rounded mt-3" alt="profile Pic" height="200" width="200">
                            @endif
                        </div> 
                        <div class="form-group col-md-4">
                            <label>Image URL</label>
                            <input name="image_url" type="text" class="form-control" placeholder="Paste image URL" value="{{ $image_url }}">
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Disclaimer</label>
                            <input name="disclaimer" type="text" class="form-control" placeholder="Enter Disclaimer" value="{{ $disclaimer }}" required>
                        </div>
                        
                        
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

{{-- <div class="card">
    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Symbol</th>
                <th>Type</th>
                <th>TP</th>
                <th>SL</th>
                <th>LOT</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\Forex::all() as $key => $forex)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$forex->symbol}}</td>
                <td>{{$forex->type}}</td>
                <td>{{$forex->tp}}</td>
                <td>{{$forex->sl}}</td>
                <td>{{$forex->lot}}</td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" symbol="{{$forex->symbol}}"
                    id="{{$forex->id}}" type="{{$forex->type}}" tp="{{$forex->tp}}" sl="{{$forex->sl}}" lot="{{$forex->lot}}"
                     class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="{{route('forex.destroy',$forex->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button class="btn btn-outline-danger">Close</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}

{{-- <div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update Forex</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="symbol">Symbol</label>
                        <input class="form-control" type="text" id="symbol" name="symbol"  placeholder="Enter symbol" required>
                    </div> 
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input class="form-control" type="text" id="type" name="type" placeholder="Enter type" step="0.01" required>
                    </div>
                     <div class="form-group">
                        <label for="tp">TP</label>
                        <input class="form-control" type="number" id="tp" name="tp" placeholder="Enter tp" step="0.01" required>
                    </div> 
                    <div class="form-group">
                        <label for="tp">SL</label>
                        <input class="form-control" type="number" id="sl" name="sl" placeholder="Enter sl" step="0.01" required>
                    </div>  
                    <div class="form-group">
                        <label for="tp">LOT</label>
                        <input class="form-control" type="number" id="lot" name="lot" placeholder="Enter lot" step="0.01" required>
                    </div>
        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div> --}}
@endsection

@section('scripts')
{{-- <script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){

            let id = $(this).attr('id');
            let symbol = $(this).attr('symbol');
            let type = $(this).attr('type');
            let tp = $(this).attr('tp');
            let sl = $(this).attr('sl');
            let lot = $(this).attr('lot');
        
            $('#id').val(id);
            $('#symbol').val(symbol);
            $('#type').val(type);
            $('#tp').val(tp);
            $('#sl').val(sl);
            $('#lot').val(lot);

            $('#updateForm').attr('action','{{route('forex.update','')}}' +'/'+id);
        });
    });
</script> --}}
@endsection