@extends('layouts.admin')

@section('title', 'Role Management')


@push('styles')
  <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('scripts')
  <!-- Page level plugins -->
  <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/assets/js/demo/datatables-demo.js"></script>
@endpush


@section('content')
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Role Management</h1>

    <!-- DataTales Example -->
    <div class="row justify-content-center">
      <div class="col-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Roles List</h5>
            @can('role-create')
              <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create New Role</button>
            @endcan
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>SL No</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $i = 1;
                  ?>
                  @foreach ($roles as $item)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $item->name }}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @can('role-list')
                              <a class="dropdown-item" href="{{ route('raw-materials.show', $item->id) }}"><i
                                  class="fa fa-eye text-primary"></i> View</a>
                            @endcan
                            @can('role-edit')
                              <a class="dropdown-item" href="{{ route('raw-materials.edit', $item->id) }}"><i
                                  class="fa fa-pen text-warning"></i> Edit</a>
                            @endcan
                            @can('role-delete')
                              <form action="{{ route('raw-materials.destroy', $item->id) }}"
                                onsubmit="return confirm('Are you want to sure to delete?')" method="post">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item"><i class="fa fa-trash text-danger"></i> Delete</button>
                              </form>
                            @endcan
                          </div>
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
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40vw">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Role Add Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="raw_insert_form" action="{{ route('roles.store') }}" method="post">
          <div class="modal-body">
            @csrf

            <div class="form-group">
              <label for="_name"><strong>Role Name:</strong></label>
              <input type="text" name="name" id="_name" class="form-control"
                placeholder="Admin, User Entry Manager, etc.">
            </div>

            <div class="form-group">
              <label for="_permission" class="mb-3"><strong>Select Permissions:</strong></label>
              <br>

              @foreach ($permissions as $item)
                <label>
                  <input type="checkbox" name="permission[]" value="{{ $item->id }}">
                  {{ $item->name }}
                </label>
                <br>
              @endforeach
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="reset" class="btn btn-danger mr-3" value="Reset Form">
            <input id="submit-btn" type="submit" class="btn btn-success" value="Add Role">
          </div>
        </form>
      </div>
    </div>
  </div>


@endsection
