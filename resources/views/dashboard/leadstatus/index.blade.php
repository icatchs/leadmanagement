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
                    <span></span>Leads Start<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
            @if(session()->has('error'))
              <div class="alert alert-error">
                  {{ session()->get('error') }}
              </div>
            @endif

            <div class="card">
                <div class="card-header bg-gradient-info text-center">
                    <h3 class="text-white">Manage Lead Status</h3> 
                </div>
                <div class="card-body">
                    @can('create-lead-status')
                        <a href="{{ route('leadstatus.manage') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Lead Status</a>
                    @endcan

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                              <th scope="col">S#</th>
                              <th scope="col">ID</th>
                              <th scope="col">Lead Status</th>
                              <th scope="col">Created By</th>
                              <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @forelse ($leadstatus as $row)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $row->id ?? ''  }}</td>
                                <td>{{ $row->name ?? ''  }}</td>
                               <td>{{ $row->user->name }}</td>
                                <td>
                                    @can('edit-lead-status')
                                        <a href="{{ route('leadstatus.manage', $row->id) }}" class="btn btn-gradient-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                    @endcan

                                    @can('delete-lead-status')
                                      <a href="{{ route('leadstatus.delete', $row->id) }}" class="btn btn-gradient-danger btn-sm"><i class="bi bi-trash"></i> Delete</a>   
                                    @endcan
                                </td>
                            </tr>
                            @empty
                                <td colspan="4" class="text-center">
                                    <span class="text-danger ">
                                        <strong>No Lead Resource Found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>



@endsection