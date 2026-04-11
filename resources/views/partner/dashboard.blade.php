  
@extends('partner.layouts.app')
@section('content')
  




      <div class="row">
        
        <!-- Summary Cards -->
        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-2 f-w-400 text-muted">Listed Gyms</h6>
                  <h4 class="mb-0">{{ $totalGyms }}</h4>
                </div>
                <div class="avtar bg-light-primary text-primary">
                  <i class="ti ti-typography f-24"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-2 f-w-400 text-muted">Gym Members</h6>
                  <h4 class="mb-0">{{ $totalMembers }}</h4>
                </div>
                <div class="avtar bg-light-success text-success">
                  <i class="ti ti-users f-24"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-2 f-w-400 text-muted">Contact Enquiries</h6>
                  <h4 class="mb-0">{{ $totalEnquiries }}</h4>
                </div>
                <div class="avtar bg-light-warning text-warning">
                  <i class="ti ti-messages f-24"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-2 f-w-400 text-muted">Gallery Photos</h6>
                  <h4 class="mb-0">{{ $totalPhotos }}</h4>
                </div>
                <div class="avtar bg-light-info text-info">
                  <i class="ti ti-photo f-24"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Financial Summary -->
        <div class="col-md-6 col-xl-6">
          <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-2 f-w-500 text-white-50">Total Fees Collected (Paid)</h6>
                  <h3 class="mb-0 text-white">₹{{ number_format($totalFeesPaid) }}</h3>
                </div>
                <div class="avtar bg-white text-success">
                  <i class="ti ti-currency-rupee f-24"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xl-6">
          <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-2 f-w-500 text-white-50">Total Fees Pending (Due)</h6>
                  <h3 class="mb-0 text-white">₹{{ number_format($totalFeesDue) }}</h3>
                </div>
                <div class="avtar bg-white text-danger">
                  <i class="ti ti-report-money f-24"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Gym Members -->
        <div class="col-md-12 col-xl-7 mt-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Recent Gym Members</h5>
            <a href="{{ route('Partnerjym.members.index') }}" class="btn btn-sm btn-light-primary">View All</a>
          </div>
          <div class="card tbl-card shadow-sm">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                  <thead class="bg-light">
                    <tr>
                      <th>MEM ID</th>
                      <th>MEMBER NAME</th>
                      <th>GYM</th>
                      <th>FEES PAID</th>
                      <th>DUE</th>
                      <th>STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($recentMembers as $member)
                    <tr>
                      <td><a href="#" class="text-muted fw-bold">{{ $member->member_id }}</a></td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ $member->name }}</h6>
                            <p class="text-muted mb-0 small">{{ $member->mobile }}</p>
                          </div>
                        </div>
                      </td>
                      <td>{{ $member->gym ? $member->gym->jym_name : 'N/A' }}</td>
                      <td class="text-success fw-bold">₹{{ $member->amount_paid }}</td>
                      <td class="text-danger fw-bold">₹{{ $member->pending_amount }}</td>
                      <td>
                        @if($member->status == 'active')
                          <span class="badge bg-light-success border border-success text-success">Active</span>
                        @else
                          <span class="badge bg-light-danger border border-danger text-danger">Inactive</span>
                        @endif
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="6" class="text-center text-muted py-4">No recent members found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Enquiries -->
        <div class="col-md-12 col-xl-5 mt-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Recent Enquiries</h5>
            <a href="{{ route('Partnerjym.enquiries.index') }}" class="btn btn-sm btn-light-warning">View All</a>
          </div>
          <div class="card shadow-sm">
            <div class="list-group list-group-flush">
              @forelse($recentEnquiries as $enquiry)
              <div class="list-group-item list-group-item-action">
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <div class="avtar avtar-s rounded-circle text-warning bg-light-warning">
                      <i class="ti ti-message-circle f-18"></i>
                    </div>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h6 class="mb-1">{{ $enquiry->name }} <span class="text-muted fw-normal">| {{ $enquiry->phone }}</span></h6>
                    <p class="mb-1 text-muted small">{{ Str::limit($enquiry->message, 50) }}</p>
                    <p class="mb-0 text-primary small"><i class="ti ti-map-pin"></i> {{ $enquiry->gym ? $enquiry->gym->jym_name : 'N/A' }}</p>
                  </div>
                  <div class="flex-shrink-0 text-end">
                    <p class="mb-0 text-muted small">{{ $enquiry->created_at->diffForHumans() }}</P>
                  </div>
                </div>
              </div>
              @empty
              <div class="list-group-item text-center py-4 text-muted">
                No recent enquiries found.
              </div>
              @endforelse
            </div>
          </div>
        </div>

      </div>
   

  @endsection