@extends('partner.layouts.app')
@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="card">

      {{-- HEADER --}}
      <div class="card-header border-bottom">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
          <div>
            <h5 class="mb-1">Gym List</h5>
            <small class="text-muted">All gyms added by you (Status: Pending / Approved by Admin)</small>
          </div>
          <a href="{{ route('Partnerjym.create') }}" class="btn btn-primary d-inline-flex align-items-center justify-content-center px-4">
            <i class="ti ti-plus me-1"></i> Add New Gym
          </a>
        </div>
      </div>

      {{-- BODY --}}
      <div class="card-body">
        <div class="table-responsive">
          <table id="dom-jqry" class="table table-striped table-bordered nowrap w-100 align-middle">
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
                  <td class="d-flex gap-2">
                    <a href="{{ route('Partnerjym.edit', $gym->uuid) }}"
                      class="btn btn-sm btn-info">
                      Edit
                    </a>

                    @if($gym->status === 'active')
                      <a href="{{ route('Jymlist.details', $gym->slug) }}" target="_blank" class="btn btn-sm btn-success">
                        View Page
                      </a>
                    @else
                      <span title="After verification, your page will be live">
                        <button class="btn btn-sm btn-secondary opacity-50" style="pointer-events: none;" disabled>
                          View Page
                        </button>
                      </span>
                    @endif
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
  /* Search & Navigation Layout */
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
  
  /* Bootstrap Table Responsive scrollbar styling */
  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  /* Mobile Responsive Fixes */
  @media (max-width: 768px) {
    .dataTables_filter {
      justify-content: flex-start !important;
      margin-top: 15px;
      margin-bottom: 15px;
    }
    .dataTables_filter label {
      display: flex;
      flex-direction: column;
      width: 100%;
    }
    .dataTables_filter input {
      width: 100% !important;
      margin-left: 0;
      margin-top: 8px;
    }
    .dataTables_paginate {
      justify-content: center !important;
      margin-top: 15px;
    }
    .dataTables_wrapper .row > div {
      width: 100% !important;
    }
  }
</style>

@endsection
