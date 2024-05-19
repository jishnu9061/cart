
@extends('layouts.admin-dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title sub-title">Edit</h3>
                </div>
                <form action="{{route('admin.category.update', $category->id)}}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-row ">
                            <div class="col-md-6 form-group">
                                <label for="title">Title<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name', $category->name)}}" placeholder="Enter Title" >
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
