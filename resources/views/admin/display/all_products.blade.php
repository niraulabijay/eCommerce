@extends('admin.layout.master')

@section('styles')

    {{--page specific styles--}}



@endsection

{{--@section('headers')--}}

{{--<div class="col-sm-6">--}}
{{--<h1 class="m-0 text-dark"><strong>Package</strong></h1>--}}
{{--</div>--}}
{{--<div class="col-sm-6">--}}
{{--<ol class="breadcrumb float-sm-right">--}}
{{--<li class="breadcrumb-item"><a href="/admin">Home</a></li>--}}
{{--<li class="breadcrumb-item"><a href="/admin/all_packages">Packages</a></li>--}}
{{--<li class="breadcrumb-item"><a href="/admin/package_add">Add</a></li>--}}
{{--</ol>--}}
{{--</div>--}}
{{--<div class="col-sm-6">--}}
{{--<a class="btn btn-lg btn-primary" href="{{ route('product_add') }}">Create New Package</a>--}}
{{--</div>--}}

{{--@endsection--}}

@section('content')

    {{--main content--}}
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Our Products</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="package_table" class="table table-bordered">
                <thead>
                <tr class="table table-primary">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->category->title }}</td>
                        <td>
                            @foreach($product->images as $image)
                                <img src="{{ asset($image->image) }}" alt="image"
                                     style="max-height: 120px; max-width: auto">
                                @break
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-sm-group btn-primary" href="{{ route('edit_product',$product->id)  }}">Edit
                            </a>

                            <button class="btn btn-sm-group btn-danger" data-toggle="modal"
                                    data-target="#delete_product{{ $product->id }}">Delete
                            </button>

                            <div class="modal fade" id="delete_product{{ $product->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Product !!</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Are you sure want to delete this product and its associated
                                                data?</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('delete_product',$product->id) }}"
                                               class="btn btn-success">
                                                Yes
                                            </a>
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{--<a href="{{ route('package_reviews',$package->id) }}" class="btn btn-outline-primary">Reviews</a>--}}

                            {{--<button class="btn btn-sm-group btn-success" data-toggle="modal"--}}
                            {{--data-target="#quick_edit_package{{ $package->id }}">Quick Edit--}}
                            {{--</button>--}}

                            {{--<div class="modal fade bd-example-modal-lg" id="quick_edit_package{{ $package->id }}"--}}
                            {{--tabindex="-1" role="dialog"--}}
                            {{--aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
                            {{--<div class="modal-dialog modal-lg" role="document">--}}
                            {{--<div class="modal-content">--}}
                            {{--<div class="modal-header">--}}
                            {{--<h5 class="modal-title" id="exampleModalLongTitle">Update Package Info--}}
                            {{--!!</h5>--}}
                            {{--<button type="button" class="close" data-dismiss="modal"--}}
                            {{--aria-label="Close">--}}
                            {{--<span aria-hidden="true">&times;</span>--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            {{--<div class="modal-body">--}}
                            {{--<div class="quick_edit_form">--}}
                            {{--<div class="container-fluid">--}}
                            {{--<h6>Upcoming Departures:</h6>--}}
                            {{--<div class="table-responsive">--}}
                            {{--<table>--}}

                            {{--</table>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="container-fluid">--}}
                            {{--<h6>Manage Prices:</h6>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="price"></label>--}}
                            {{--<input type="number">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="modal-footer">--}}
                            {{--<button type="submit" class="btn btn-success">--}}
                            {{--Update--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-secondary"--}}
                            {{--data-dismiss="modal">Close--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection


@section('script')

    {{--page specific scripts--}}
    <script src="{{ asset('admin/js/tables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/js/tables/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#package_table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
    </script>

@endsection