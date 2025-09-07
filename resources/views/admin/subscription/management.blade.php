@section('title', 'Subscription Management')

@include('layouts.admin.header_new')

<style>
.preloader { display: none !important; }
body { opacity: 1 !important; }
.wrapper { opacity: 1 !important; }

/* Modern UI/UX Improvements with Brand Colors */
.subscription-management {
    background: linear-gradient(135deg, #355691 0%, #2c4a7a 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.main-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin: 0 auto;
    max-width: 1200px;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid #f8f9fa;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #355691;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
    font-weight: 400;
}

.subscription-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    overflow: hidden;
    margin-bottom: 2rem;
}

.subscription-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}

.card-header-modern {
    background: linear-gradient(135deg, #355691 0%, #2c4a7a 100%);
    color: white;
    padding: 1.5rem;
    border: none;
    position: relative;
    overflow: hidden;
}

.card-header-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);
    pointer-events: none;
}

.card-header-modern h5 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
    position: relative;
    z-index: 1;
}

.card-body-modern {
    padding: 2rem;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-trial {
    background: #355691;
    color: white;
}

.status-active {
    background: #28a745;
    color: white;
}

.status-canceled {
    background: #dc3545;
    color: white;
}

.status-warning {
    background: #ffc107;
    color: #212529;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #495057;
    font-size: 1rem;
}

.info-value {
    color: #212529;
    font-size: 1rem;
}

.btn-modern {
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
    text-transform: none;
    letter-spacing: 0.5px;
}

.btn-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-modern:hover::before {
    left: 100%;
}

.btn-primary-modern {
    background: #355691;
    color: white;
    box-shadow: 0 4px 15px rgba(53, 86, 145, 0.4);
}

.btn-primary-modern:hover {
    background: #2c4a7a;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(53, 86, 145, 0.6);
    color: white;
}

.btn-danger-modern {
    background: #dc3545;
    color: white;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
}

.btn-danger-modern:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.6);
    color: white;
}

.btn-success-modern {
    background: #28a745;
    color: white;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
}

.btn-success-modern:hover {
    background: #20c997;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.6);
    color: white;
}

.btn-outline-modern {
    background: transparent;
    border: 2px solid #355691;
    color: #355691;
    box-shadow: 0 4px 15px rgba(53, 86, 145, 0.2);
}

.btn-outline-modern:hover {
    background: #355691;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(53, 86, 145, 0.4);
}

.trial-banner {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 1px solid #c3e6cb;
    border-radius: 16px;
    padding: 1.5rem;
    margin: 2rem 0;
    position: relative;
    overflow: hidden;
}

.trial-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: #355691;
}

.trial-icon {
    color: #355691;
    font-size: 1.5rem;
    margin-right: 1rem;
}

.billing-section {
    background: #f8f9fa;
    border-radius: 16px;
    padding: 2rem;
    margin-top: 2rem;
    border: 1px solid #e9ecef;
}

.billing-title {
    color: #355691;
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.billing-text {
    color: #6c757d;
    font-size: 1rem;
    line-height: 1.6;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.action-description {
    font-size: 0.9rem;
    color: #6c757d;
    margin-top: 0.5rem;
    line-height: 1.4;
}

.back-button {
    margin-top: 2rem;
    text-align: center;
}

@media (max-width: 768px) {
    .subscription-management {
        padding: 1rem 0;
    }
    
    .main-container {
        margin: 0 1rem;
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .card-body-modern {
        padding: 1.5rem;
    }
    
    .action-buttons {
        gap: 0.75rem;
    }
}
</style>

<div class="subscription-management">
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Subscription Management</h1>
            <p class="page-subtitle">Manage your subscription and billing preferences</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-6">
                <div class="subscription-card">
                    <div class="card-header-modern">
                        <h5><i class="fas fa-credit-card me-2"></i>Current Subscription</h5>
                    </div>
                    <div class="card-body-modern">
                        <div class="info-item">
                            <span class="info-label">Plan</span>
                            <span class="info-value">{{ ucfirst($user->plan) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status</span>
                            <span class="status-badge 
                                @if($subscription->status === 'active') status-active
                                @elseif($subscription->status === 'trialing') status-trial
                                @elseif($subscription->status === 'canceled') status-canceled
                                @else status-warning @endif">
                                @if($subscription->status === 'active') Active
                                @elseif($subscription->status === 'trialing') Trial
                                @elseif($subscription->status === 'canceled') Canceled
                                @else {{ ucfirst($subscription->status) }} @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Current Period End</span>
                            <span class="info-value">{{ \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->format('M d, Y') }}</span>
                        </div>
                        
                        @if($subscription->cancel_at_period_end)
                            <div class="info-item">
                                <span class="info-label">Cancellation</span>
                                <span class="text-warning fw-bold">Will cancel at period end</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="subscription-card">
                    <div class="card-header-modern">
                        <h5><i class="fas fa-cogs me-2"></i>Actions</h5>
                    </div>
                    <div class="card-body-modern">
                        <div class="action-buttons">
                            @if($subscription->status === 'active' && !$subscription->cancel_at_period_end)
                                <form method="POST" action="{{ route('stripe.cancel-subscription') }}" onsubmit="return confirm('Are you sure you want to cancel your subscription? You will continue to have access until {{ \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->format('M d, Y') }}.')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger-modern btn-modern w-100">
                                        <i class="fas fa-times me-2"></i>Cancel Subscription
                                    </button>
                                </form>
                                <p class="action-description">You will continue to have access until the end of your current billing period.</p>
                            @elseif($subscription->cancel_at_period_end)
                                <form method="POST" action="{{ route('stripe.reactivate-subscription') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success-modern btn-modern w-100">
                                        <i class="fas fa-play me-2"></i>Reactivate Subscription
                                    </button>
                                </form>
                                <p class="action-description">Your subscription will continue after the current period.</p>
                            @else
                                <a href="{{ route('pricing') }}" class="btn btn-primary-modern btn-modern w-100">
                                    <i class="fas fa-plus me-2"></i>Subscribe to Premium
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($subscription->status === 'trialing')
            <div class="trial-banner">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle trial-icon"></i>
                    <div>
                        <h6 class="mb-1 fw-bold text-success">Trial Information</h6>
                        <p class="mb-0">
                            You are currently on a free trial. Your subscription will automatically begin billing on 
                            <strong>{{ \Carbon\Carbon::createFromTimestamp($subscription->trial_end)->format('M d, Y') }}</strong>.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="billing-section">
            <h6 class="billing-title">
                <i class="fas fa-file-invoice me-2"></i>Billing History
            </h6>
            <p class="billing-text">
                For detailed billing history and invoices, please check your email or contact support. 
                All invoices are automatically sent to your registered email address.
            </p>
        </div>

        <div class="back-button">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-modern btn-modern">
                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        preloader.style.display = 'none';
    }
    document.body.style.opacity = '1';
});

window.addEventListener('load', function() {
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        preloader.style.display = 'none';
    }
    document.body.style.opacity = '1';
});
</script>
