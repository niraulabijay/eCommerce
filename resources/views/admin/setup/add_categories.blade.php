@extends('admin.layout.master')


@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="main-wrapper ">
                <form action="{{ route('post_add_category') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="add_brand">Add Categories</label>
                        <input type="text" name="category" class="form-control" placeholder="Enter Category" required>
                    </div>
                    <div class="form-group">
                        <label for="add_brand">Select Parent Categories</label>
                        <select name="parent_id" class="form-control">
                            <option value=""></option>
                            @foreach($values as $value)
                                <option value="{{$value->id}}" class="form-control"> {{ $value->title }}</option>
                            @endforeach
                        </select>
                    </div>


                    <input type="submit" class="btn btn-success pull-right" value="  Submit  ">
                </form>

            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-5 card" style="margin-left: 10px">
            <div class="card-header with-border">
                <h3 class="box-title">Categories</h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach($categories as $category)

                        @if($category->children->count()>0)
                            <li>{{$category->title}}</li>
                            <ul>
                                @foreach($category->children as $sub_category)
                                    @if($sub_category->children->count()>0)

                                        <li>{{$sub_category->title}}</li>
                                        <ul>
                                            @foreach($sub_category->children as $grand_category)
                                                <li>{{ $grand_category->title }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <li>{{$sub_category->title}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <li>{{ $category->title }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-5 card offset-md-1">
            <div class="card-header with-border">
                <h3 class="box-title">All Categories</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    @foreach($values as $category)
                        <tr>
                            <td> {{ $category->id }} </td>
                            <td> {{  $category->title}} </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#edit{{$category->id}}" style="display: inline-block">
                                    Edit
                                </button>
                                <div class="modal fade" id="edit{{$category->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{ route('edit_category',$category->id) }}">
                                                @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="add_brand">Title</label>
                                                    <input type="text" name="category_edit" value="{{ $category->title }}" class="form-control" placeholder="Enter Category" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                   class="btn btn-primary">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{$category->id}}" style="display: inline-block">
                                    Delete
                                </button>
                                <div class="modal fade" id="delete{{$category->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you Sure you want to delete the category ?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <a href="{{route('delete_category',$category->id)}}"
                                                   class="btn btn-primary">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>

        </div>
    </div>
@endsection