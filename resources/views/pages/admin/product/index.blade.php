@extends('layouts.admin-dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products</h3>
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary" style="float: right">Create</a>

                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="d-none"></th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="d-none">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $product->name }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">

                                            &nbsp;<a href="{{ route('admin.product.edit', $product->id) }}"
                                                class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                            &nbsp;<a data-href="{{ route('admin.product.delete', $product->id) }}"
                                                class="btn btn-danger delete" title="Delete"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function() {
            var App = {
                initialize: function() {
                    var datatable = $('#dataTable1').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "order": [
                            [0, "asc"]
                        ]
                    });
                    $('#dataTable1').on('click', '.delete', function(e) {
                        e.preventDefault();
                        var row = datatable.rows($(this).parents('tr'));
                        var url = $(this).data('href');
                        App.deleteItem(row, url);
                    })
                },
                deleteItem: function(row, url) {
                    if (confirm('Are you sure you want to remove this categories?')) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            success: function() {
                                location.reload();
                                row.remove().draw();
                                toastr.success(data.success);
                            }
                        });
                    }
                }

            };
            App.initialize();
        })
    </script>
@endpush
