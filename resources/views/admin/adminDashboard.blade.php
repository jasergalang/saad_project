@extends('layout.authlayout')

@section('content')
@include('layout.adminNavbar')
    <div class="content flex-grow ml-0 bg-transparent pt-20">
        <div class="container p-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="container p-6">
                    <canvas id="tenantsAndOwnersChart" width="400" height="400"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="paymentsChart" width="400" height="400"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="rentedPropertiesChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Tenants Chart
        var tenantsAndOwnersCtx = document.getElementById('tenantsAndOwnersChart').getContext('2d');
        var tenantsAndOwnersChart = new Chart(tenantsAndOwnersCtx, {
            type: 'pie',
            data: {
                labels: ['Tenants', 'Owners'],
                datasets: [{
                    label: 'Tenants vs Owners',
                    data: [{{ $totalTenants }}, {{ $totalOwners }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', // Tenants color
                        'rgba(54, 162, 235, 0.2)'  // Owners color
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Payments Chart
        var paymentsCtx = document.getElementById('paymentsChart').getContext('2d');
        var paymentsChart = new Chart(paymentsCtx, {
            type: 'bar',
            data: {
                labels: ['Payments'],
                datasets: [{
                    label: 'Total Payments',
                    data: [{{ $totalPayments }}],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Rented Properties Chart
        var rentedPropertiesCtx = document.getElementById('rentedPropertiesChart').getContext('2d');
        var rentedPropertiesChart = new Chart(rentedPropertiesCtx, {
            type: 'bar',
            data: {
                labels: ['Rented Properties'],
                datasets: [{
                    label: 'Total Rented Properties',
                    data: [{{ $totalRentedProperties }}],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
