@section('title', 'Select Your Plan')

@include('layouts.admin.header_new')

<head>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.3.2/dist/html2canvas.min.js"></script>
</head>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Hero Section -->
            <div class="text-center mb-5">
                <div class="hero-icon mb-3">
                    <i class="fas fa-crown"></i>
                </div>
                <h1 class="hero-title">Choose Your Perfect Plan</h1>
                <p class="hero-subtitle">Start your 7-day free trial today. No charges until after your trial period.</p>
                <div class="trial-badge">
                    <i class="fas fa-gift me-2"></i>
                    <span>7-Day Free Trial</span>
                </div>
            </div>

            <!-- Plan Cards -->
            <div class="row g-4 mb-5">
                <div class="col-lg-6">
                    <div class="plan-card basic-plan" data-plan="basic">
                        <div class="plan-header">
                            <div class="plan-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                            <h3 class="plan-title">Basic Plan</h3>
                            <div class="plan-price">
                                <span class="currency">$</span>
                                <span class="amount">5.99</span>
                                <span class="period">/month</span>
                            </div>
                            <p class="plan-description">Perfect for getting started</p>
                        </div>
                        
                        <div class="plan-features">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Up to 10 Albums</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Basic Features</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Email Support</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Standard Storage</span>
                            </div>
                        </div>
                        
                        <div class="plan-footer">
                            <form method="POST" action="{{ route('subscribe.plan') }}" class="plan-form">
                                @csrf
                                <input type="hidden" name="plan" value="basic">
                                <button type="submit" class="btn-plan-select">
                                    <span class="btn-text">Start Free Trial</span>
                                    <i class="fas fa-arrow-right btn-icon"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="plan-card premium-plan recommended" data-plan="premium">
                        <div class="recommended-badge">
                            <i class="fas fa-star"></i>
                            <span>Most Popular</span>
                        </div>
                        
                        <div class="plan-header">
                            <div class="plan-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <h3 class="plan-title">Premium Plan</h3>
                            <div class="plan-price">
                                <span class="currency">$</span>
                                <span class="amount">9.99</span>
                                <span class="period">/month</span>
                            </div>
                            <p class="plan-description">Unlimited everything</p>
                        </div>
                        
                        <div class="plan-features">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Unlimited Albums</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>All Premium Features</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Priority Support</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Advanced Analytics</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Custom Branding</span>
                            </div>
                        </div>
                        
                        <div class="plan-footer">
                            <form method="POST" action="{{ route('subscribe.plan') }}" class="plan-form">
                                @csrf
                                <input type="hidden" name="plan" value="premium">
                                <button type="submit" class="btn-plan-select premium-btn">
                                    <span class="btn-text">Start Free Trial</span>
                                    <i class="fas fa-arrow-right btn-icon"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust Section -->
            <div class="trust-section">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="trust-item">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <h6>Secure Payment</h6>
                                <p>Powered by Stripe</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="trust-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h6>Cancel Anytime</h6>
                                <p>No hidden fees</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section">
                <h4 class="faq-title">Frequently Asked Questions</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="faq-item">
                            <h6><i class="fas fa-question-circle me-2"></i>When will I be charged?</h6>
                            <p>You'll be charged after your 7-day free trial ends. You can cancel anytime during the trial period.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="faq-item">
                            <h6><i class="fas fa-question-circle me-2"></i>Can I change plans later?</h6>
                            <p>Yes! You can upgrade or downgrade your plan at any time from your dashboard.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Hide preloader immediately */
.preloader {
    display: none !important;
}

/* Ensure page loads immediately */
body {
    opacity: 1 !important;
}

.wrapper {
    opacity: 1 !important;
}

/* Hero Section */
.hero-icon {
    font-size: 3rem;
    color: #007bff;
    margin-bottom: 1rem;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
}

.trial-badge {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

/* Plan Cards */
.plan-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    position: relative;
    height: 100%;
    border: 2px solid transparent;
}

.plan-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.plan-card.selected {
    border-color: #007bff;
    transform: translateY(-10px);
}

.basic-plan:hover {
    border-color: #6c757d;
}

.premium-plan {
    border-color: #ffc107;
    background: linear-gradient(135deg, #fff9e6, #ffffff);
}

.premium-plan:hover {
    border-color: #ffc107;
    box-shadow: 0 20px 40px rgba(255, 193, 7, 0.2);
}

/* Recommended Badge */
.recommended-badge {
    position: absolute;
    top: -10px;
    right: 20px;
    background: linear-gradient(135deg, #ffc107, #ff8c00);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
}

.recommended-badge i {
    margin-right: 0.25rem;
}

/* Plan Header */
.plan-header {
    text-align: center;
    margin-bottom: 2rem;
}

.plan-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 2rem;
}

.basic-plan .plan-icon {
    background: linear-gradient(135deg, #6c757d, #495057);
    color: white;
}

.premium-plan .plan-icon {
    background: linear-gradient(135deg, #ffc107, #ff8c00);
    color: white;
}

.plan-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.plan-price {
    margin-bottom: 0.5rem;
}

.currency {
    font-size: 1.5rem;
    color: #007bff;
    font-weight: 600;
}

.amount {
    font-size: 3rem;
    color: #007bff;
    font-weight: 700;
}

.period {
    font-size: 1rem;
    color: #6c757d;
}

.plan-description {
    color: #6c757d;
    font-size: 1rem;
}

/* Plan Features */
.plan-features {
    margin-bottom: 2rem;
}

.feature-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.feature-item:last-child {
    border-bottom: none;
}

.feature-item i {
    color: #28a745;
    margin-right: 1rem;
    font-size: 1.1rem;
}

.feature-item span {
    color: #495057;
    font-weight: 500;
}

/* Plan Footer */
.plan-footer {
    margin-top: auto;
}

.btn-plan-select {
    width: 100%;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-plan-select:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.premium-btn {
    background: linear-gradient(135deg, #ffc107, #ff8c00);
}

.premium-btn:hover {
    background: linear-gradient(135deg, #ff8c00, #e67e22);
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
}

.btn-icon {
    transition: transform 0.3s ease;
}

.btn-plan-select:hover .btn-icon {
    transform: translateX(5px);
}

/* Trust Section */
.trust-section {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 2rem;
    margin: 3rem 0;
}

.trust-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.trust-item i {
    font-size: 2rem;
    color: #28a745;
}

.trust-item h6 {
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
}

.trust-item p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

/* FAQ Section */
.faq-section {
    margin-top: 3rem;
}

.faq-title {
    text-align: center;
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 2rem;
}

.faq-item {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.faq-item h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.faq-item p {
    color: #6c757d;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .plan-card {
        padding: 1.5rem;
    }
    
    .amount {
        font-size: 2.5rem;
    }
    
    .trust-section {
        padding: 1.5rem;
    }
    
    .trust-item {
        flex-direction: column;
        text-align: center;
        margin-bottom: 1rem;
    }
}

/* Loading States */
.btn-plan-select.loading {
    pointer-events: none;
}

.btn-plan-select.loading .btn-text {
    opacity: 0.7;
}

.btn-plan-select.loading .btn-icon {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

<script>
// Hide preloader immediately when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('Enhanced plan selection page loaded successfully');
    
    // Hide preloader
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        preloader.style.display = 'none';
    }
    
    // Ensure body is visible
    document.body.style.opacity = '1';
    
    // Add click handler to plan cards
    document.querySelectorAll('.plan-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Don't trigger if clicking the button
            if (e.target.closest('.btn-plan-select')) {
                return;
            }
            
            // Remove selected class from all cards
            document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('selected'));
            
            // Add selected class to clicked card
            this.classList.add('selected');
            
            // Focus the button
            const button = this.querySelector('.btn-plan-select');
            if (button) {
                button.focus();
            }
        });
    });
    
    // Add loading state to form submission
    document.querySelectorAll('.plan-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('.btn-plan-select');
            const btnText = button.querySelector('.btn-text');
            const btnIcon = button.querySelector('.btn-icon');
            
            // Add loading state
            button.classList.add('loading');
            btnText.textContent = 'Processing...';
            btnIcon.className = 'fas fa-spinner btn-icon';
            button.disabled = true;
        });
    });
    
    // Add smooth scroll for better UX
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe plan cards for animation
    document.querySelectorAll('.plan-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});

// Also hide preloader on window load as backup
window.addEventListener('load', function() {
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        preloader.style.display = 'none';
    }
    document.body.style.opacity = '1';
});
</script>