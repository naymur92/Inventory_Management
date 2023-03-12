@extends('layouts.admin')

@section('title', 'Inventory List')


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
    <h1 class="h3 mb-2 text-gray-800">Raw Material Queue</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Raw Material Request Queue List</h5>
        @can('raw-req-create')
          <a href="{{ route('raw-materials.create') }}" class="btn btn-primary">Request Raw Material</a>
        @endcan
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Material Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Requested By</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Material Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Requested By</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($raw_mat_reqs as $item)
                <tr>
                  <td>{{ $item->material_name }}</td>
                  <td>{{ $item->material_type }}</td>
                  <td>{{ $item->material_quantity }} ({{ $item->quantity_unit }})</td>
                  <td>{{ $item->material_quantity }} ({{ $item->quantity_unit }})</td>
                  <td>{{ date('d M, Y - h:i a', strtotime($item->created_at)) }}</td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('raw-materials.show', $item->id) }}"><i
                            class="fa fa-eye text-primary"></i> View</a>
                        {{-- <a class="dropdown-item" href="{{ route('raw-materials.edit', $item->id) }}"><i
                            class="fa fa-pen text-warning"></i> Edit</a> --}}
                        @can('raw-req-edit')
                          <form action="{{ route('raw-material-requests.update', $item->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button class="dropdown-item"><i class="fa fa-check text-success"></i> Confirm</button>
                          </form>
                        @endcan
                        @can('raw-req-delete')
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
@endsection
