@extends('layouts.admin.header_new')

@section('title', 'Subscription Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="ps-widget bgc-white bdrs12 mb30 overflow-hidden position-relative">
                <div class="ps-widget__header">
                    <h4 class="ps-widget__title">Subscription Management</h4>
                </div>
                <div class="ps-widget__content">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Current Subscription</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Plan:</strong> {{ ucfirst($user->plan) }}</p>
                                    <p><strong>Status:</strong> 
                                        @if($subscription->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($subscription->status === 'trialing')
                                            <span class="badge bg-info">Trial</span>
                                        @elseif($subscription->status === 'canceled')
                                            <span class="badge bg-danger">Canceled</span>
                                        @else
                                            <span class="badge bg-warning">{{ ucfirst($subscription->status) }}</span>
                                        @endif
                                    </p>
                                    <p><strong>Current Period End:</strong> {{ \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->format('M d, Y') }}</p>
                                    
                                    @if($subscription->cancel_at_period_end)
                                        <p><strong>Cancellation:</strong> <span class="text-warning">Will cancel at period end</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Actions</h5>
                                </div>
                                <div class="card-body">
                                    @if($subscription->status === 'active' && !$subscription->cancel_at_period_end)
                                        <form method="POST" action="{{ route('stripe.cancel-subscription') }}" onsubmit="return confirm('Are you sure you want to cancel your subscription? You will continue to have access until {{ \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->format('M d, Y') }}.')">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-block mb-2">
                                                <i class="fas fa-times"></i> Cancel Subscription
                                            </button>
                                        </form>
                                        <small class="text-muted">You will continue to have access until the end of your current billing period.</small>
                                    @elseif($subscription->cancel_at_period_end)
                                        <form method="POST" action="{{ route('stripe.reactivate-subscription') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-block mb-2">
                                                <i class="fas fa-play"></i> Reactivate Subscription
                                            </button>
                                        </form>
                                        <small class="text-muted">Your subscription will continue after the current period.</small>
                                    @else
                                        <a href="{{ route('pricing') }}" class="btn btn-primary btn-block">
                                            <i class="fas fa-plus"></i> Subscribe to Premium
                                        </a>
                                    @endif
                                    
                                    <hr>
                                    
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($subscription->status === 'trialing')
                        <div class="alert alert-info mt-3">
                            <h6><i class="fas fa-info-circle"></i> Trial Information</h6>
                            <p class="mb-0">
                                You are currently on a free trial. Your subscription will automatically begin billing on 
                                <strong>{{ \Carbon\Carbon::createFromTimestamp($subscription->trial_end)->format('M d, Y') }}</strong>.
                            </p>
                        </div>
                    @endif

                    <div class="mt-4">
                        <h6>Billing History</h6>
                        <p class="text-muted">For detailed billing history and invoices, please check your email or contact support.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
