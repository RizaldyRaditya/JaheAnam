@extends('admin.admin')
@section('title', 'User')

@section('content')
    <div class="container">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Email</th>
                        <th>role</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $user)
                        <tr>
                            <td class="text-center">{{$user->id}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td class="td-actions text-right d-flex">
                                <button type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$user->id}}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop-{{$user->id}}"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('user.edit', ['user' => $user->id]) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{ old('email') ?? $user->email}}">
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-danger btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#delete-{{$user->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="delete-{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>You want to delete this user?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('user.destroy', ['user'=>$user->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
