@extends('layouts.admin')

@section('content') 
      <!-- must include header page info  -->
          
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Users <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
           
       <!-- header page info end  -->
            @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
            @endif

<div class="card">
    <div class="card-header bg-gradient-info text-center">
       <h3 class="text-white">Manage Users</h3> 
    </div>
        <div class="card-body">
        @can('create-user')
            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New User</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">S#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @forelse ($user->getRoleNames() as $role)
                            <span class="badge bg-gradient-primary">{{ $role }}</span>
                        @empty
                        @endforelse
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-gradient-info btn-sm"><i class="bi bi-eye"></i> Show</a>

                            @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []) )
                                @if (Auth::user()->hasRole('Super Admin'))
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-gradient-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                @endif
                            @else
                                @can('edit-user')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-gradient-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                @endcan

                                @can('delete-user')
                                    @if (Auth::user()->id!=$user->id)
                                        <button type="submit" class="btn btn-gradient-danger btn-sm" onclick="return confirm('Do you want to delete this user?');"><i class="bi bi-trash"></i> Delete</button>
                                    @endif
                                @endcan
                            @endif

                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="5">
                        <span class="text-danger">
                            <strong>No User Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $users->links() }}

    </div>
</div>
       
       
       
@endsection