@extends('layouts.admin.header_new')

@section('title', 'Trial Analytics')

@section('content')
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="dashboard__content">
                    <div class="row">
                        <div class="col-12">
                            <div class="dashboard__content__title">
                                <h2>Trial Analytics Dashboard</h2>
                                <p>Monitor your 7-day trial users and conversions</p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $totalTrials }}</h3>
                                    <p>Total Trials</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $activeTrials }}</h3>
                                    <p>Active Trials</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $expiringThisWeek }}</h3>
                                    <p>Expiring This Week</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $expiredTrials }}</h3>
                                    <p>Expired Trials</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expiring Today Alert -->
                    @if($expiringToday > 0)
                    <div class="alert alert-warning">
                        <h4>🚨 {{ $expiringToday }} trial(s) expire TODAY!</h4>
                        <p>Check the expiring trials section below for details.</p>
                    </div>
                    @endif

                    <div class="row">
                        <!-- Expiring Trials -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Trials Expiring Soon</h4>
                                </div>
                                <div class="card-body">
                                    @if($expiringTrials->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Expires</th>
                                                        <th>Days Left</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($expiringTrials as $trial)
                                                    <tr class="{{ $trial->trial_ends_at->isToday() ? 'table-warning' : '' }}">
                                                        <td>{{ $trial->name }}</td>
                                                        <td>{{ $trial->email }}</td>
                                                        <td>{{ $trial->trial_ends_at->format('M d, Y') }}</td>
                                                        <td>
                                                            @if($trial->trial_ends_at->isToday())
                                                                <span class="badge bg-danger">TODAY</span>
                                                            @else
                                                                {{ now()->diffInDays($trial->trial_ends_at, false) }} days
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted">No trials expiring in the next 7 days.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Recent Trials -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Recent Trial Signups</h4>
                                </div>
                                <div class="card-body">
                                    @if($recentTrials->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Started</th>
                                                        <th>Expires</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($recentTrials as $trial)
                                                    <tr>
                                                        <td>{{ $trial->name }}</td>
                                                        <td>{{ $trial->email }}</td>
                                                        <td>{{ $trial->created_at->format('M d, Y') }}</td>
                                                        <td>{{ $trial->trial_ends_at->format('M d, Y') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted">No recent trial signups.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expired Trials -->
                    @if($expiredTrialsList->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Recently Expired Trials</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Expired</th>
                                                    <th>Days Since</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($expiredTrialsList as $trial)
                                                <tr>
                                                    <td>{{ $trial->name }}</td>
                                                    <td>{{ $trial->email }}</td>
                                                    <td>{{ $trial->trial_ends_at->format('M d, Y') }}</td>
                                                    <td>{{ now()->diffInDays($trial->trial_ends_at) }} days ago</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Actions</h4>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('admin.trials.export') }}" class="btn btn-primary">
                                        <i class="fas fa-download"></i> Export Trial Data
                                    </a>
                                    <button onclick="location.reload()" class="btn btn-secondary">
                                        <i class="fas fa-refresh"></i> Refresh Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh every 5 minutes
setTimeout(function() {
    location.reload();
}, 300000);
</script>
@endsection
