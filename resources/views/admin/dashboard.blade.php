@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Welcome to the admin dashboard</p>
</div>

<!-- Revenue Summary -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title">Today's Revenue</h6>
                <h3 class="mb-0">${{ number_format($todayRevenue, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6 class="card-title">This Month Revenue</h6>
                <h3 class="mb-0">${{ number_format($thisMonthRevenue, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6 class="card-title">Transaction Rate</h6>
                <h3 class="mb-0">{{ $totalTransactions > 0 ? round(($completedTransactions / $totalTransactions) * 100, 1) : 0 }}%</h3>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card primary">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stats-label">Total Users</div>
                        <div class="stats-value">{{ $totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card success">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stats-label">Total Revenue</div>
                        <div class="stats-value">${{ number_format($totalRevenue, 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card info">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stats-label">Active Subscriptions</div>
                        <div class="stats-value">{{ $activeSubscriptions }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sync stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card warning">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stats-label">Total Products</div>
                        <div class="stats-value">{{ $totalProducts }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <!-- Revenue Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0">Revenue Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- User Distribution Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0">User Distribution</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="userDistributionChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Admin
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Regular Users
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <!-- Recent Purchases -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0">Recent Purchases</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Plan</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPurchases as $purchase)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-sm me-2">
                                            {{ strtoupper(substr($purchase->user->name, 0, 1)) }}
                                        </div>
                                        {{ $purchase->user->name }}
                                    </div>
                                </td>
                                <td>{{ $purchase->product_name }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($purchase->plan) }}</span>
                                </td>
                                <td><strong>${{ number_format($purchase->amount, 2) }}</strong></td>
                                <td>{{ $purchase->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if($purchase->status === 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($purchase->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($purchase->status) }}</span>
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

    <!-- Recent Users -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0">Recent Users</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @foreach($recentUsers as $user)
                <div class="d-flex align-items-center mb-3">
                    <div class="user-avatar-sm me-3">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">{{ $user->name }}</div>
                        <div class="text-muted small">{{ $user->email }}</div>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">{{ $user->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.user-avatar-sm {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--sidebar-bg);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
}
</style>

<script>
// Revenue Chart
var ctx = document.getElementById('revenueChart');
var revenueChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
        datasets: [{
            label: 'Monthly Revenue',
            data: {!! json_encode($monthlyRevenue->pluck('revenue')) !!},
            backgroundColor: 'rgba(28, 200, 138, 0.05)',
            borderColor: 'rgba(28, 200, 138, 1)',
            pointRadius: 4,
            pointBackgroundColor: 'rgba(28, 200, 138, 1)',
            pointBorderColor: 'rgba(28, 200, 138, 1)',
            pointHoverRadius: 4,
            pointHoverBackgroundColor: 'rgba(28, 200, 138, 1)',
            pointHoverBorderColor: 'rgba(28, 200, 138, 1)',
            pointHitRadius: 10,
            pointBorderWidth: 2,
            tension: 0.3
        }]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '$' + value.toLocaleString();
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Revenue: $' + context.parsed.y.toLocaleString();
                    }
                }
            }
        }
    }
});

// User Distribution Pie Chart
var ctx2 = document.getElementById('userDistributionChart');
var userDistributionChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Admin Users', 'Regular Users'],
        datasets: [{
            data: [
                {{ \App\Models\User::where('is_admin', true)->count() }}, 
                {{ \App\Models\User::where('is_admin', false)->count() }}
            ],
            backgroundColor: ['#4e73df', '#1cc88a'],
            hoverBackgroundColor: ['#2e59d9', '#17a673'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endpush
