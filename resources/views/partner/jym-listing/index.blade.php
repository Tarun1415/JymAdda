@extends('partner.layouts.app')
@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">

      {{-- HEADER --}}
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h5>Gym List</h5>
          <small>All gyms added by you (Status: Pending / Approved by Admin)</small>
        </div>

        <a href="{{ route('Partnerjym.create') }}" class="btn btn-primary btn-sm">
          + Add New Gym
        </a>
      </div>

      {{-- BODY --}}
      <div class="card-body">
        <div class="dt-responsive">
          <table id="dom-jqry" class="table table-striped table-bordered nowrap w-100">
            <thead>
              <tr>
                <th>#</th>
                <th>Gym Name</th>
                <th>City</th>
                <th>Opening Time</th>
                <th>Closing Time</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              @foreach($gyms as $key => $gym)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $gym->gym_name }}</td>
                  <td>{{ $gym->city ?? '-' }}</td>
                  <td>{{ $gym->opening_time ?? '-' }}</td>
                  <td>{{ $gym->closing_time ?? '-' }}</td>
                  <td>{{ $gym->mobile ?? '-' }}</td>

                  {{-- Status --}}
                  <td>
               @if($gym->status === 'pending')
                  <span class="badge bg-warning">Pending</span>

                @elseif($gym->status === 'active')
                  <span class="badge bg-success">Verified</span>

                @elseif($gym->status === 'rejected')
                  <span class="badge bg-danger">Rejected</span>
                @endif

                  </td>

                  {{-- Action --}}
                  <td>
                  <a href="{{ route('Partnerjym.edit', $gym->uuid) }}"
                    class="btn btn-sm btn-info">
                    Edit
                  </a>

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

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    $('#dom-jqry').DataTable({
      dom:
        "<'row mb-2'<'col-sm-12 d-flex justify-content-end'f>>" +
        "rt" +
        "<'row mt-2'<'col-sm-12 d-flex justify-content-end'p>>",
      pageLength: 10,
      ordering: true,
      language: {
        emptyTable: "No gym found"
      }
    });
  });
</script>

<style>
  /* Search right side */
  .dataTables_filter {
    display: flex !important;
    justify-content: flex-end !important;
  }

  .dataTables_filter input {
    width: 250px !important;
    margin-left: 8px;
  }

  /* Pagination right side */
  .dataTables_paginate {
    display: flex !important;
    justify-content: flex-end !important;
  }
</style>

@endsection
