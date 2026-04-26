@extends('partner.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h4 class="fw-bold mb-1">Gym Members CRM</h4>
                    <p class="text-muted mb-0">Manage your gym members, track fees, and generate invoices.</p>
                </div>
                <div>
                    <a href="{{ route('Partnerjym.members.create') }}" class="btn btn-primary fw-bold px-4 w-100">
                        <i class="ti ti-plus me-1"></i> Add New Member
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                <div class="card-body d-flex align-items-center bg-white">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3 shadow-sm"
                        style="width: 50px; height: 50px; background: #eff6ff; color: #3b82f6;">
                        <i class="ti ti-users fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 text-muted fw-semibold">Total Members</h6>
                        <h3 class="mb-0 fw-bold text-dark">{{ $members->count() }}</h3>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100"
                    style="height: 4px; background: linear-gradient(90deg, #3b82f6, #93c5fd);"></div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                <div class="card-body d-flex align-items-center bg-white">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3 shadow-sm"
                        style="width: 50px; height: 50px; background: #ecfdf5; color: #10b981;">
                        <i class="ti ti-wallet fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 text-muted fw-semibold">Collected Fees</h6>
                        <h3 class="mb-0 fw-bold text-dark">₹ {{ number_format($members->sum('amount_paid'), 2) }}</h3>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100"
                    style="height: 4px; background: linear-gradient(90deg, #10b981, #6ee7b7);"></div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                <div class="card-body d-flex align-items-center bg-white">
                    <div class="rounded-3 d-flex align-items-center justify-content-center me-3 shadow-sm"
                        style="width: 50px; height: 50px; background: #fef2f2; color: #ef4444;">
                        <i class="ti ti-report-money fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 text-muted fw-semibold">Pending Dues</h6>
                        <h3 class="mb-0 fw-bold text-dark">₹ {{ number_format($members->sum('pending_amount'), 2) }}</h3>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100"
                    style="height: 4px; background: linear-gradient(90deg, #ef4444, #fca5a5);"></div>
            </div>
        </div>

        <!-- Members Table -->
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom p-3 p-md-4">
                    <form action="{{ route('Partnerjym.members.index') }}" method="GET"
                        class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-between gap-3 search-filter-group">
                        <!-- Search Input (Left) -->
                        <div class="input-group search-input" style="max-width: 400px;">
                            <input type="text" name="search" class="form-control" placeholder="Search Name or Mobile..."
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit"><i class="ti ti-search px-1"></i></button>
                            @if (request('search') || request('gym_id'))
                                <a href="{{ route('Partnerjym.members.index') }}" class="btn btn-outline-danger"><i
                                        class="ti ti-x px-1"></i></a>
                            @endif
                        </div>

                        <!-- Gym Filter (Right) -->
                        <select name="gym_id" class="form-select filter-select" style="max-width: 300px;"
                            onchange="this.form.submit()">
                            <option value="">All Gyms Filter</option>
                            @foreach ($gyms as $gym)
                                <option value="{{ $gym->id }}" {{ request('gym_id') == $gym->id ? 'selected' : '' }}>
                                    {{ $gym->gym_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="card-body p-0 pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="min-width: 900px;">
                            <thead class="table-light text-nowrap">
                                <tr>
                                    <th class="ps-3">Member ID / Name</th>
                                    <th>Contact</th>
                                    <th>Plan & Validity</th>
                                    <th>Fees Status</th>
                                    <th class="pe-3 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light-primary text-primary rounded-circle d-flex align-items-center justify-content-center me-2 flex-shrink-0"
                                                    style="width: 38px; height: 38px; font-weight: bold; font-size:14px;">
                                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark text-truncate"
                                                        style="max-width: 150px;">{{ $member->name }}</h6>
                                                    <small class="text-muted d-block">{{ $member->member_id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="text-dark"><i class="ti ti-phone text-muted me-1"></i>
                                                {{ $member->mobile }}</div>
                                            @if ($member->gym)
                                                <small class="text-primary text-truncate d-block"
                                                    style="max-width: 150px;"><i
                                                        class="ti ti-building me-1"></i>{{ $member->gym->gym_name }}</small>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <span
                                                class="badge bg-light text-dark border">{{ $member->plan_duration }}</span>
                                            @if ($member->status == 'active')
                                                <span class="badge bg-success-subtle text-success ms-1">Active</span>
                                            @elseif($member->status == 'expired')
                                                <span class="badge bg-danger-subtle text-danger ms-1">Expired</span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning ms-1">Pending</span>
                                            @endif
                                            <br>
                                            <small
                                                class="text-muted d-block mt-1">{{ \Carbon\Carbon::parse($member->start_date)->format('d M y') }}
                                                - {{ \Carbon\Carbon::parse($member->end_date)->format('d M y') }}</small>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-flex flex-column">
                                                <span class="text-dark fw-bold">Total:
                                                    ₹{{ number_format($member->total_fees) }}</span>
                                                @if ($member->pending_amount > 0)
                                                    <span class="text-danger fw-semibold"><i
                                                            class="ti ti-alert-circle me-1"></i>Due:
                                                        ₹{{ number_format($member->pending_amount) }}</span>
                                                @else
                                                    <span class="text-success fw-semibold"><i
                                                            class="ti ti-circle-check me-1"></i>Paid</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="pe-3 text-end">
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown-toggle shadow-none border"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                    data-bs-boundary="window">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0"
                                                    style="z-index: 1050;">
                                                    <li><a class="dropdown-item py-2"
                                                            href="{{ route('Partnerjym.members.edit', $member->uuid) }}"><i
                                                                class="ti ti-edit text-primary me-2"></i> Edit Record</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item py-2" target="_blank"
                                                            href="{{ route('Partnerjym.members.invoice', $member->uuid) }}"><i
                                                                class="ti ti-file-invoice text-success me-2"></i> Print
                                                            Invoice</a></li>
                                                    <li><a class="dropdown-item py-2" target="_blank"
                                                            href="{{ route('Partnerjym.members.id-card', $member->uuid) }}"><i
                                                                class="ti ti-id text-info me-2"></i> Print ID Card</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('Partnerjym.members.destroy', $member->uuid) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this member?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="dropdown-item py-2 text-danger"><i
                                                                    class="ti ti-trash me-2"></i> Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="ti ti-users text-muted mb-3 d-block" style="font-size: 3rem;"></i>
                                            <h5 class="fw-bold">No members found</h5>
                                            <p class="text-muted">Start adding members to manage your gym CRM.</p>
                                            <a href="{{ route('Partnerjym.members.create') }}"
                                                class="btn btn-primary mt-2">Add First Member</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($members->hasPages())
                    <div class="card-footer bg-white border-top p-3 d-flex justify-content-center">
                        {{ $members->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 768px) {
            .search-filter-group .search-input {
                max-width: 100% !important;
            }

            .search-filter-group .filter-select {
                max-width: 100% !important;
            }
        }
    </style>
@endpush
