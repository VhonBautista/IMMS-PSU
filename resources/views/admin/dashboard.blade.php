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
            <a href="{{ route('admin.college_management') }}">
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
    
    <div class="bg-white p-6 rounded-lg mt-6">
        <span class="ml-1 mb-2 font-semibold text-sm lg:text-lg text-gray-700 dark:text-gray-400">{{ __('Published Instructional Materials') }}</span>
        
        <div class="relative overflow-x-auto border sm:rounded-lg mt-3">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Title') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Publisher') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Status') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Date Published') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">{{ __('Actions') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($instructionalMaterials as $material)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="font-medium text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $material->title }}</div>
                            </th>
                            <td class="px-6 py-4 text-xs">
                                {{ $material->user->lastname . ', ' . $material->user->firstname }}
                            </td>
                            <td class="px-6 py-4 text-xs capitalize">
                                {{ $material->status }}
                            </td>
                            <td class="px-6 py-4 text-xs capitalize">
                                {{ $material->updated_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ asset($material->pdf_path) }}" target="_blank" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-600 rounded-lg hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                                    {{ __('Download Material') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="7" class="px-6 py-4 text-center">
                                <div class="p-4 text-sm">
                                    {{ __('There are no records') }}
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $instructionalMaterials->links() }}
    </div>
    
   @section('scripts')
        <script>
            $(document).ready(function () {
                $('#imsTable').DataTable();
            });
            
            let table = new DataTable('#imsTable')
        </script>
        <script>
           document.addEventListener('DOMContentLoaded', function () {
               var ctx = document.getElementById('myChart').getContext('2d');
               var myChart;
       
                function updateChart(submittedData, approvedData) {
                    if (myChart) {
                        myChart.destroy();
                    }
        
                    myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: submittedData.map(entry => entry.date),
                            datasets: [
                                {
                                    label: 'Submitted Materials',
                                    fill: true,
                                    data: submittedData.map(entry => entry.count),
                                    borderColor: 'rgb(66, 139, 248)',
                                    backgroundColor: 'rgba(66, 139, 248, 0.3)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Approved Materials',
                                    fill: true,
                                    data: approvedData.map(entry => entry.count),
                                    borderColor: 'rgb(14, 159, 110)',
                                    backgroundColor: 'rgba(14, 159, 110, 0.3)',
                                    borderWidth: 1
                                }
                            ]
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
       
               updateChart(@json($submittedMaterials), @json($approvedMaterials));
       
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
