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
                    <span></span>Leads <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                    <h3 class="text-white">Manage Leads</h3> 
                </div>
                <div class="card-body">
                    @can('create-leads')
                        <a href="{{ route('leads.manage') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Lead</a>
                    @endcan
                    @can('import-leads')
                        <button type="button" class="btn btn-success btn-sm my-2" data-bs-toggle="modal" data-bs-target="#importLeadsModal">
                            <i class="bi bi-plus-circle"></i> Import Leads
                        </button>
                    @endcan

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">S#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Lead Source</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Adults</th>
                            <th scope="col">Travel Date</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php

                            @endphp
                            @forelse ($leads as $key => $lead)
                            <tr>
                                <th scope="row">{{ $key +1 }}</th>
                                <td>{{ $lead->name ?? ''  }}</td>
                                <td>{{ $lead->leadStatus->name ?? ''  }}</td>
                                <td>{{ $lead->leadSource->name ?? ''  }}</td>
                                <td>{{ $lead->from  ?? '' }}</td>
                                <td>{{ $lead->to  ?? '' }}</td>
                                <td>{{ $lead->adult_count  ?? '' }}</td>
                                <td>{{  date("d-M-Y", strtotime($lead->travel_date)) ?? '' }}</td>
                                <td>
                                    @can('edit-leads')
                                        <a href="{{ route('leads.manage', $lead->id) }}" class="btn btn-gradient-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                    @endcan

                                    @can('delete-user')
                                    <a href="{{ route('leads.delete', $lead->id) }}" class="btn btn-gradient-danger btn-sm"><i class="bi bi-trash"></i> Delete</a>   
                                    @endcan
                                </td>
                            </tr>
                            @empty
                                <td colspan="8" class="text-center">
                                    <span class="text-danger ">
                                        <strong>No Leads Found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

                <div class="modal" id="importLeadsModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Heading</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{ route('leads.processImport') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="csv_file" class="form-label">Choose CSV File</label>
                                    <input type="file" class="form-control" id="csv_file" name="csv_file" required>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm my-2">Import</button>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                        </div>
                    </div>
                </div>
           
@endsection