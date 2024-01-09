<x-app-layout>
    <div class="flex gap-6 mt-3 mb-4 flex-col sm:flex-row">
        <div class="w-full md:w-1/2 lg:w-1/4">
            <a href="{{ route('admin.course_management') }}">
                <div class="h-[100px] bg-gradient-to-b from-cyan-500 to-blue-700 hover:from-cyan-300 hover:to-blue-500 text-white overflow-hidden shadow rounded flex justify-center items-center flex-col">
                    <h2 class="text-lg font-medium inline-flex items-center gap-2">
                        <svg class="w-4 h-4 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M17 11h-2.722L8 17.278a5.512 5.512 0 0 1-.9.722H17a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1ZM6 0H1a1 1 0 0 0-1 1v13.5a3.5 3.5 0 1 0 7 0V1a1 1 0 0 0-1-1ZM3.5 15.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM16.132 4.9 12.6 1.368a1 1 0 0 0-1.414 0L9 3.55v9.9l7.132-7.132a1 1 0 0 0 0-1.418Z"/>
                        </svg>
                        {{ __('Total Courses') }}
                    </h2>
                    <p class="text-5xl">{{ $courseCount }}</p>
                </div>
            </a>
        </div>
    
        <div class="w-full md:w-1/2 lg:w-1/4">
            <a href="{{ route('admin.department_management') }}">
                <div class="h-[100px] bg-gradient-to-b from-yellow-300 to-yellow-400 hover:from-yellow-200 hover:to-yellow-300 text-white overflow-hidden shadow rounded flex justify-center items-center flex-col">
                    <h2 class="text-lg font-medium inline-flex items-center gap-2">
                        <svg class="w-4 h-4 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M17 16h-1V2a1 1 0 1 0 0-2H2a1 1 0 0 0 0 2v14H1a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM5 4a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4Zm0 5V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1Zm6 7H7v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm2-7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1Zm0-4a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1Z"/>
                        </svg>
                        {{ __('Total Departments') }}
                    </h2>
                    <p class="text-5xl">{{ $departmentCount }}</p>
                </div>
            </a>
        </div>
    
        <div class="w-full md:w-1/2 lg:w-1/4">
            <a href="{{ route('admin.college_management') }}">
                <div class="h-[100px] bg-gradient-to-b from-green-400 to-green-500 hover:from-green-300 hover:to-green-400 text-white overflow-hidden shadow rounded flex justify-center items-center flex-col">
                    <h2 class="text-lg font-medium inline-flex items-center gap-2">
                        <svg class="w-4 h-4 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M17 16h-1V2a1 1 0 1 0 0-2H2a1 1 0 0 0 0 2v14H1a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM5 4a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4Zm0 5V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1Zm6 7H7v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm2-7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1Zm0-4a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1Z"/>
                        </svg>
                        {{ __('Total Colleges') }}
                    </h2>
                    <p class="text-5xl">{{ $collegeCount }}</p>
                </div>
            </a>
        </div>
    
        <div class="w-full md:w-1/2 lg:w-1/4">
            <a href="{{ route('admin.campus_management') }}">
                <div class="h-[100px] bg-gradient-to-b from-purple-400 to-purple-500 hover:from-purple-300 hover:to-purple-400 text-white overflow-hidden shadow rounded flex justify-center items-center flex-col">
                    <h2 class="text-lg font-medium inline-flex items-center gap-2">
                        <svg class="w-4 h-4 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M17 16h-1V2a1 1 0 1 0 0-2H2a1 1 0 0 0 0 2v14H1a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM5 4a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4Zm0 5V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1Zm6 7H7v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm2-7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1Zm0-4a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1Z"/>
                        </svg>
                        {{ __('Total Campuses') }}
                    </h2>
                    <p class="text-5xl">{{ $campusCount }}</p>
                </div>
            </a>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg">
        <div class="bg-white dark:bg-gray-800 overflow-hidden">
            <div class="flex justify-between items-center">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li aria-current="page">
                            <div class="flex items-center">
                            <span class="ml-1 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Instructional Material Submission Trend') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-between items-center mt-3">
                <form method="get" action="{{ route('admin.dashboard') }}">
                    <div date-rangepicker class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input name="start_date" type="text" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            
                            <input name="end_date" type="text" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                        </div>
                        <button type="submit" class="p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:focus:ring-gray-800">
                            {{ __('Go') }}
                        </button>
                    </div>
                </form>

                <button id="downloadChart" onclick="downloadChart()" class="w-full sm:w-auto mt-3 sm:mt-0 bg-green-500 hover:bg-green-700 text-sm text-white font-bold py-2.5 px-4 rounded-lg">
                    {{ __('Download as PNG') }}
                </button>
            </div>

            <div class="mt-3">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    
    @section('scripts')
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
                                label: 'Total Submitted Materials',
                                fill: true,
                                data: data.map(entry => entry.count),
                                borderColor: 'rgb(14, 159, 110)',
                                backgroundColor: 'rgb(14, 159, 110, 0.3)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 10,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                }
        
                updateChart(@json($imsPerDay));
        
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
    @endsection
</x-app-layout>
