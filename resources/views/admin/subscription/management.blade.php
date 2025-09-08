@section('title', 'Subscription Management')

@include('layouts.admin.header_new')

<style>
.preloader { display: none !important; }
body { opacity: 1 !important; }
.wrapper { opacity: 1 !important; }

/* Ensure mobile navigation works properly */
.dashboard_navigationbar {
    z-index: 1000;
    position: relative;
}

.dashboard_navigationbar .dropdown-content {
    z-index: 1001;
}

/* Match Dashboard Design */
.subscription-management {
    background: transparent;
    min-height: 100vh;
    padding: 0;
}

.main-container {
    background: transparent;
    padding: 0;
    margin: 0;
    max-width: none;
}

.page-header {
    text-align: left;
    margin-bottom: 2rem;
    padding-bottom: 0;
    border-bottom: none;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #355691;
    margin-bottom: 0.5rem;
    line-height: 1.2;
}

.page-subtitle {
    color: #6c757d;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.4;
}

.subscription-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    overflow: hidden;
    margin-bottom: 2rem;
    height: 100%;
}

.subscription-card:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

.card-header-modern {
    background: #355691;
    color: white;
    padding: 1.25rem 1.75rem;
    border: none;
    position: relative;
    overflow: hidden;
}

.card-header-modern h5 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.75rem;
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
    padding: 1.25rem 0;
    border-bottom: 1px solid #f8f9fa;
    transition: background-color 0.2s ease;
}

.info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.info-item:hover {
    background-color: #f8f9fa;
    margin: 0 -2rem;
    padding-left: 2rem;
    padding-right: 2rem;
    border-radius: 8px;
}

.info-label {
    font-weight: 600;
    color: #495057;
    font-size: 1rem;
    flex: 1;
}

.info-value {
    color: #212529;
    font-size: 1rem;
    font-weight: 500;
    text-align: right;
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
    padding: 2rem;
    margin: 2.5rem 0;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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
    font-size: 1.75rem;
    margin-right: 1.25rem;
}

.billing-section {
    background: #f8f9fa;
    border-radius: 16px;
    padding: 2.5rem;
    margin-top: 2.5rem;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.billing-title {
    color: #355691;
    font-weight: 600;
    font-size: 1.3rem;
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.billing-text {
    color: #6c757d;
    font-size: 1rem;
    line-height: 1.7;
    margin: 0;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    padding: 0.5rem 0;
}

.action-description {
    font-size: 0.95rem;
    color: #6c757d;
    margin-top: 0.75rem;
    line-height: 1.5;
    padding: 0.75rem;
    background-color: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #355691;
}

.back-button {
    margin-top: 3rem;
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid #e9ecef;
}

/* Row spacing improvements */
.row {
    margin-bottom: 1rem;
}

.row:last-child {
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .subscription-management {
        padding: 0;
        background: transparent;
    }
    
    .main-container {
        margin: 0;
        padding: 0 1rem;
    }
    
    .page-title {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    .page-subtitle {
        font-size: 0.95rem;
        margin-bottom: 0;
    }
    
    .page-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
    }
    
    .subscription-card {
        margin-bottom: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }
    
    .card-header-modern {
        padding: 0.875rem 1.25rem;
    }
    
    .card-header-modern h5 {
        font-size: 1rem;
        gap: 0.5rem;
    }
    
    .card-body-modern {
        padding: 1.25rem;
    }
    
    .info-item {
        padding: 0.875rem 0;
        margin-bottom: 0.5rem;
    }
    
    .info-item:last-child {
        margin-bottom: 0;
    }
    
    .info-label {
        font-size: 0.9rem;
    }
    
    .info-value {
        font-size: 0.9rem;
    }
    
    .action-buttons {
        gap: 1rem;
        padding: 0.25rem 0;
    }
    
    .action-description {
        font-size: 0.85rem;
        padding: 0.625rem;
        margin-top: 0.5rem;
    }
    
    .trial-banner {
        padding: 1.25rem;
        margin: 1.5rem 0;
        border-radius: 12px;
    }
    
    .trial-icon {
        font-size: 1.5rem;
        margin-right: 1rem;
    }
    
    .billing-section {
        padding: 1.5rem;
        margin-top: 1.5rem;
        border-radius: 12px;
    }
    
    .billing-title {
        font-size: 1.1rem;
        margin-bottom: 1rem;
        gap: 0.5rem;
    }
    
    .billing-text {
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    .back-button {
        margin-top: 2rem;
        padding-top: 1.5rem;
    }
    
    .info-item:hover {
        margin: 0 -1.25rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }
    
    /* Remove hover effects on mobile for better touch experience */
    .subscription-card:hover {
        transform: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }
    
    /* Improve touch targets for mobile */
    .btn-modern {
        padding: 0.875rem 1.25rem;
        font-size: 0.95rem;
        min-height: 44px; /* iOS recommended touch target size */
    }
    
    /* Better mobile spacing for alerts */
    .alert {
        margin-bottom: 1rem;
        padding: 0.875rem 1rem;
        border-radius: 8px;
    }
    
    /* Optimize mobile dashboard navigation spacing */
    .dashboard_navigationbar {
        margin-bottom: 1rem;
    }
    
    /* Better mobile row spacing */
    .row {
        margin-bottom: 0.5rem;
    }
    
    /* Ensure proper mobile container spacing */
    .dashboard__content {
        padding: 0 1rem;
    }
    
    /* Mobile button layout improvements */
    .d-flex.flex-column.flex-md-row {
        gap: 0.75rem !important;
    }
    
    .d-flex.flex-column.flex-md-row .btn {
        width: 100% !important;
        margin-bottom: 0.5rem;
    }
    
    .d-flex.flex-column.flex-md-row .btn:last-child {
        margin-bottom: 0;
    }
    
    /* Ensure form elements take full width on mobile */
    .d-flex.flex-column.flex-md-row form {
        width: 100% !important;
        flex: none !important;
    }
}
</style>

<div class="subscription-management">
    <div class="row align-items-center">
        <div class="col-xxl-12">
            <div class="dashboard_title_area">
                <h2 style="color:#355691">Subscription Management</h2>
                <p class="text">Manage your subscription and billing preferences</p>
            </div>
        </div>
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
                            @elseif($subscription->status === 'trialing')
                                <div class="d-flex gap-2 flex-column flex-md-row">
                                    <a href="{{ route('pricing') }}" class="btn btn-primary-modern btn-modern flex-fill">
                                        <i class="fas fa-plus me-2"></i>Subscribe to Premium
                                    </a>
                                    <form method="POST" action="{{ route('stripe.cancel-subscription') }}" style="flex: 1;" onsubmit="return confirm('Are you sure you want to cancel your trial? You will lose access immediately.')">
                                        @csrf
                                        <button type="submit" class="btn btn-danger-modern btn-modern w-100">
                                            <i class="fas fa-times me-2"></i>Cancel Trial
                                        </button>
                                    </form>
                                </div>
                                <p class="action-description">Upgrade to Premium for full access, or cancel your trial to stop automatic billing.</p>
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
