@extends('layout.main') @section('content')
@if(session()->has('create_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div> 
@endif
@if(session()->has('edit_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div> 
@endif
@if(session()->has('import_message'))
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div> 
@endif
@if(session()->has('not_permitted'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
@if(session()->has('message'))
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif

<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4>Tambah Jenis Tag</h4>    
            </div>
            <div class="card-body">
                <span style="background-color: #e69a1e; height:70%px; width: 100%;"></span>
                <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                @php
                    $action = @$productType ? route('producttype.update', @$productType->id) : route('producttype.store');
                @endphp
                <form action="{{ $action }}" class="row" method="POST">
                    @csrf
                    @if (@$productType)
                        @method('put')
                    @endif
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Kode Jenis Tag *</strong> </label>
                            <input type="text" name="code" class="form-control" id="code" aria-describedby="code" required value="{{ old('code', @$productType->code ) }}">
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Deskripsi *</strong> </label>
                            <textarea  name="description" class="form-control" id="description" aria-describedby="description" required>{{ old('description', @$productType->description ) }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>

</script>
@endsection