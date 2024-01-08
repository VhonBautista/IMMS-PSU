<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="w-full md:w-1/2 lg:w-1/4 mb-4 px-4">
            <div class="bg-blue-500 text-white dark:bg-blue-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4"><i class="fas fa-graduation-cap mr-2"></i>Courses</h2>
                <p class="text-2xl">{{ $courseCount }}</p>
            </div>
        </div>
    
        <div class="w-full md:w-1/2 lg:w-1/4 mb-4 px-4">
            <div class="bg-yellow-500 text-white dark:bg-yellow-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4"><i class="fas fa-building mr-2"></i>Departments</h2>
                <p class="text-2xl">{{ $departmentCount }}</p>
            </div>
        </div>
    
        <div class="w-full md:w-1/2 lg:w-1/4 mb-4 px-4">
            <div class="bg-green-500 text-white dark:bg-green-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4"><i class="fas fa-university mr-2"></i>Colleges</h2>
                <p class="text-2xl">{{ $collegeCount }}</p>
            </div>
        </div>
    
        <div class="w-full md:w-1/2 lg:w-1/4 mb-4 px-4">
            <div class="bg-purple-500 text-white dark:bg-purple-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4"><i class="fas fa-map-marker-alt mr-2"></i>Campuses</h2>
                <p class="text-2xl">{{ $campusCount }}</p>
            </div>
        </div>
    </div>
    
    
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mt-4">
                    <h1 class="text-lg font-semibold mb-6">Instructional Materials per dates.</h1>
                    <div class="mt-4">
                        <div class="mt-4">
                            <form method="get" action="{{ route('admin.dashboard') }}">
                                <label for="start_date">Start Date:</label>
                                <input type="date" name="start_date" value="{{ $startDate }}">
    
                                <label for="end_date">End Date:</label>
                                <input type="date" name="end_date" value="{{ $endDate }}">
    
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Apply
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Line Chart --}}
                <div>
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
    
                {{-- Download Button --}}
                <div class="mt-4">
                    <button id="downloadChart" onclick="downloadChart()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Download Chart
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- render IM chart --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart;
    
            function updateChart(data) {
                if (myChart) {
                    myChart.destroy();
                }
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.map(entry => entry.date),
                        datasets: [{
                            label: 'Instructional Materials this Day',
                            data: data.map(entry => entry.count),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                precision: 0
                            }
                        }
                    }
                });
            }
    
            updateChart(@json($imsPerDay));
    
            // Function to download the chart
            window.downloadChart = function () {
                var canvas = document.getElementById('myChart');
                var image = canvas.toDataURL('image/png');
                var link = document.createElement('a');
                link.href = image;
                link.download = 'chart.png';
                link.click();
            };
        });
    </script>
</x-app-layout>
