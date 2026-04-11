@extends('partner.layouts.app')

@push('styles')
<style>
    .enquiry-card {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .enquiry-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.05);
    }
    .bg-light-primary { background: #eef2ff !important; }
    .text-primary { color: #4f46e5 !important; }
</style>
@endpush

@section('content')
<div class="row">
    <!-- Header Section -->
    <div class="col-12 mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="fw-bold mb-1">User Contact Us</h4>
                <p class="text-muted mb-0">View all latest enquiries from customers for your gyms.</p>
            </div>
            <div>
                <span class="badge bg-light-primary text-primary px-3 py-2 fs-6 rounded-pill">
                    <i class="ti ti-messages me-1"></i> Total {{ $enquiries->count() }} Enquiries
                </span>
            </div>
        </div>
    </div>

    <!-- Enquiries List -->
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0 pt-3">
                @if($enquiries->isEmpty())
                    <div class="text-center p-5">
                        <i class="ti ti-message-off text-muted mb-3" style="font-size: 3rem;"></i>
                        <h5>No Enquiries Yet</h5>
                        <p class="text-muted mb-0">When users contact you from the gym details page, they will appear here.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-nowrap">
                                <tr>
                                    <th class="ps-3 border-0">Date</th>
                                    <th class="border-0">Customer Name</th>
                                    <th class="border-0">Mobile Number</th>
                                    <th class="border-0">Gym Name</th>
                                    <th class="pe-3 border-0 text-end">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enquiries as $enq)
                                <tr>
                                    <td class="ps-3">
                                        <span class="fw-semibold">{{ $enq->created_at->format('d M, Y') }}</span><br>
                                        <small class="text-muted">{{ $enq->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark">{{ $enq->name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark fw-bold px-2 py-1 border">
                                            <i class="ti ti-phone me-1 text-primary"></i> {{ $enq->mobile }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($enq->gym)
                                            <span class="text-primary fw-semibold">{{ $enq->gym->gym_name }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="pe-3 text-end">
                                        @if($enq->message)
                                            <p class="mb-0 text-muted d-inline-block" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $enq->message }}">
                                                {{ $enq->message }}
                                            </p>
                                        @else
                                            <span class="text-muted fst-italic">No message</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
