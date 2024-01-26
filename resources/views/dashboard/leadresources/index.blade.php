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
                    <span></span>Leads Sources<i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                    <h3 class="text-white">Manage Lead Sources</h3> 
                </div>
                <div class="card-body">
                    @can('create-lead-sources')
                        <a href="{{ route('leadresources.manage') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Lead Source</a>
                    @endcan

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                              <th scope="col">S#</th>
                              <th scope="col">#ID</th>
                              <th scope="col">Lead Resource</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @forelse ($leadresources as $leadresource)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $leadresource->id ?? ''  }}</td>
                                <td>{{ $leadresource->name ?? ''  }}</td>
                                @if($leadresource->source_status == 1)
                                <td><span class="badge bg-gradient-success">Active</span></td>
                                @else
                                <td><span class="badge bg-gradient-danger">In-active</span></td>
                                @endif
                                <td>
                                    @can('edit-lead-sources')
                                        <a href="{{ route('leadresources.manage', $leadresource->id) }}" class="btn btn-gradient-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                    @endcan

                                    @can('delete-lead-sources')
                                      <a href="{{ route('leadresources.delete', $leadresource->id) }}" class="btn btn-gradient-danger btn-sm"><i class="bi bi-trash"></i> Delete</a>   
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