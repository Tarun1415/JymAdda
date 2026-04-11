@extends('partner.layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('Partnerjym.members.index') }}" class="btn btn-light me-3"><i class="ti ti-arrow-left"></i> Back</a>
            <h4 class="fw-bold mb-0">Edit Gym Member: <span class="text-primary">{{ $member->name }}</span></h4>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('Partnerjym.members.update', $member->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">Personal Details</h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Select Gym <span class="text-danger">*</span></label>
                            <select name="gym_id" class="form-select ui-input" required>
                                @foreach($gyms as $gym)
                                    <option value="{{ $gym->id }}" {{ (old('gym_id', $member->gym_id) == $gym->id) ? 'selected' : '' }}>{{ $gym->gym_name }}</option>
                                @endforeach
                            </select>
                            @error('gym_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6"></div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control ui-input" value="{{ old('name', $member->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control ui-input" value="{{ old('mobile', $member->mobile) }}" required pattern="[0-9]{10}">
                            @error('mobile') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Aadhar Card Number</label>
                            <input type="text" name="adhar_no" class="form-control ui-input" value="{{ old('adhar_no', $member->adhar_no) }}">
                            @error('adhar_no') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-bold">Full Address</label>
                            <textarea name="address" class="form-control ui-textarea" rows="2">{{ old('address', $member->address) }}</textarea>
                            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-4 border-bottom pb-2">Membership & Fees Details</h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Plan Type <span class="text-danger">*</span></label>
                            <select name="plan_duration" class="form-select ui-input" required>
                                <option value="1 Month" {{ old('plan_duration', $member->plan_duration) == '1 Month' ? 'selected' : '' }}>1 Month</option>
                                <option value="3 Months" {{ old('plan_duration', $member->plan_duration) == '3 Months' ? 'selected' : '' }}>3 Months</option>
                                <option value="6 Months" {{ old('plan_duration', $member->plan_duration) == '6 Months' ? 'selected' : '' }}>6 Months</option>
                                <option value="1 Year" {{ old('plan_duration', $member->plan_duration) == '1 Year' ? 'selected' : '' }}>1 Year</option>
                            </select>
                            @error('plan_duration') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Joining Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control ui-input" value="{{ old('start_date', $member->start_date) }}" required>
                            @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Total Fees (₹) <span class="text-danger">*</span></label>
                            <input type="number" id="total_fees" name="total_fees" class="form-control ui-input" value="{{ old('total_fees', $member->total_fees) }}" min="0" required onkeyup="calculatePending()">
                            @error('total_fees') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Paid So Far (₹) <span class="text-danger">*</span></label>
                            <input type="number" id="amount_paid" name="amount_paid" class="form-control ui-input text-success fw-bold" value="{{ old('amount_paid', $member->amount_paid) }}" min="0" required onkeyup="calculatePending()">
                            <small class="text-muted" style="font-size:0.75rem;">Modify to fix mistakes</small>
                            @error('amount_paid') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold text-primary">➕ Add Payment (₹)</label>
                            <input type="number" id="new_payment" name="new_payment" class="form-control ui-input border-primary" value="0" min="0" onkeyup="calculatePending()">
                            <small class="text-muted" style="font-size:0.75rem;">Enter today's received amount</small>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold text-danger">Pending Dues (₹)</label>
                            <input type="text" id="pending_amount" class="form-control bg-light fw-bold text-danger" value="0" readonly>
                        </div>
                        
                        <div class="col-md-6 mt-4">
                            <label class="form-label fw-bold">Account Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select ui-input" required>
                                <option value="active" {{ old('status', $member->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ old('status', $member->status) == 'pending' ? 'selected' : '' }}>Pending/Hold</option>
                                <option value="expired" {{ old('status', $member->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="text-end border-top pt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold" style="border-radius: 12px;">Update Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function calculatePending() {
        let total = parseFloat(document.getElementById('total_fees').value) || 0;
        let pastPaid = parseFloat(document.getElementById('amount_paid').value) || 0;
        let newPaid = parseFloat(document.getElementById('new_payment').value) || 0;
        
        let totalPaid = pastPaid + newPaid;
        let pending = total - totalPaid;
        
        if(pending < 0) pending = 0;
        document.getElementById('pending_amount').value = pending;
    }
    // init on load
    document.addEventListener("DOMContentLoaded", calculatePending);
</script>

<style>
    .ui-input, .ui-textarea {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #d1d5db;
        background-color: #f9fafb;
    }
    .ui-input:focus, .ui-textarea:focus {
        border-color: #4f46e5;
        background-color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.1);
    }
</style>
@endsection
