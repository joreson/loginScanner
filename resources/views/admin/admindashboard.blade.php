@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center text-light">Admin Dashboard</h1>
        
        <!-- Buttons row with alignment -->
        <div class="row mb-5">
            <div class="col-md-6"></div>
            <div class="col-md-6 d-flex justify-content-end">
            <a href="{{ route('admin.users') }}" class="btn btn-primary mr-2">Manage Users</a>
                <a href="{{ route('admin.request') }}" class="btn btn-secondary mr-2">Pending </a>
              
            </div>
        </div>

        <!-- Row with two centered boxes -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-4">
                <div class="box p-4 border rounded shadow-sm bg-success">
                    <h2 class="display-4 text-light">{{ $acceptedUserCount }}</h2>
                    <p class="text-light">Total Employees</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box p-4 border rounded shadow-sm bg-warning ">
                    <h2 class="display-4 text-light">{{ $pendingUserCount }}</h2>
                    <p class="text-light">Pending Requests</p>
                </div>
            </div>
        </div>

        <!-- Section title -->
        <div class="mb-4 text-center">
            <h5 class="text-light">Numbers of Faculties at Each Campus</h5>
        </div>

        <!-- Rows with eight boxes (4 columns, 2 rows) -->
        <div class="row text-center">
            @php
                $campuses = [
                    ['name' => 'Alaminos City', 'count' => $Alaminos],
                    ['name' => 'Asingan', 'count' => $Asingan],
                    ['name' => 'Bayambang', 'count' => $Bayambang],
                    ['name' => 'Binmaley', 'count' => $Binmaley],
                    ['name' => 'Lingayen', 'count' => $Lingayen],
                    ['name' => 'San Carlos', 'count' => $SanCarlos],
                    ['name' => 'Sta. Maria', 'count' => $StaMaria],
                    ['name' => 'Urdaneta City', 'count' => $UrdanetaCity]
                ];

                $colors = ['bg-primary', 'bg-primary', 'bg-primary', 'bg-primary', 'bg-primary', 'bg-primary', 'bg-primary', 'bg-primary'];
            @endphp

            @foreach($campuses as $index => $campus)
                <div class="col-md-3 mb-4">
                    <div class="box p-4 border rounded shadow-sm text-white {{ $colors[$index % count($colors)] }}">
                        <h4>{{ $campus['count'] }}</h4>
                        <p>{{ $campus['name'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
       
        <!-- <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <button class="btn btn-primary mr-2" onclick="updateChart('days')">Days</button>
        <button class="btn btn-primary mr-2" onclick="updateChart('months')">Months</button>
        <button class="btn btn-primary mr-2" onclick="updateChart('years')">Years</button>
    </div>
    <script>
        function generateDateLabels(range) {
            const now = new Date();
            let labels = [];
            let data = [];

            if (range === 'days') {
                for (let i = 0; i < 5; i++) {
                    let date = new Date();
                    date.setDate(now.getDate() - i);
                    labels.unshift(date.toISOString().split('T')[0]);
                    data.unshift(Math.floor(Math.random() * 1000));
                }
            } else if (range === 'months') {
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                for (let i = 0; i < 5; i++) {
                    let date = new Date();
                    date.setMonth(now.getMonth() - i);
                    labels.unshift(monthNames[date.getMonth()]);
                    data.unshift(Math.floor(Math.random() * 1000));
                }
            } else if (range === 'years') {
                for (let i = 0; i < 5; i++) {
                    let date = new Date();
                    date.setFullYear(now.getFullYear() - i);
                    labels.unshift(date.getFullYear().toString());
                    data.unshift(Math.floor(Math.random() * 1000));
                }
            }

            return { labels, data };
        }

        const chartData = {
            days: generateDateLabels('days'),
            months: generateDateLabels('months'),
            years: generateDateLabels('years')
        };

        const ctx = document.getElementById('myChart').getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.days.labels,
                datasets: [{
                    label: 'Data',
                    data: chartData.days.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 1000
                    }
                },
                plugins: {
                    background: {
                        color: 'white'
                    }
                }
            },
            plugins: [{
                id: 'customCanvasBackgroundColor',
                beforeDraw: (chart) => {
                    const ctx = chart.canvas.getContext('2d');
                    ctx.save();
                    ctx.globalCompositeOperation = 'destination-over';
                    ctx.fillStyle = 'white';
                    ctx.fillRect(0, 0, chart.width, chart.height);
                    ctx.restore();
                }
            }]
        });

        function updateChart(range) {
            const newChartData = generateDateLabels(range);
            myChart.data.labels = newChartData.labels;
            myChart.data.datasets[0].data = newChartData.data;
            myChart.update();
        }
    </script>
    </div> -->
@endsection
