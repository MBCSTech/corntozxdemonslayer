<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('CorntozxDemonSlayer Game Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        .custom-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 0.375rem;
            z-index: 50;
        }

        .custom-dropdown:hover .custom-dropdown-content {
            display: block;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            display: block;
            width: 100%;
            text-align: left;
            font-size: 0.875rem;
            color: #374151;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
        }
    </style>

    <div class="py-12">
        <div class="max-w-[105rem] mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Date Filter Form -->
                    <form id="filter-form" method="GET" action="{{ route('dashboard') }}" class="mb-4">
                        <div class="flex flex-col gap-4 md:flex-row">
                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                                    :value="old('start_date', $startDate)" />
                            </div>
                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
                                    :value="old('end_date', $endDate)" />
                            </div>
                            <div class="flex items-end">
                                <x-primary-button>{{ __('Filter') }}</x-primary-button>
                                <x-primary-button class="ml-2"
                                    onclick="clearFilters()">{{ __('Clear') }}</x-primary-button>
                            </div>
                        </div>
                    </form>

                    <div class="flex justify-end mb-4 gap-4">
                        <div class="custom-dropdown">
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Download Receipt') }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="custom-dropdown-content">
                                <button onclick="downloadAllImages('Week1')" class="dropdown-item">
                                    {{ __('Week 1: 1/6-8/6') }}
                                </button>
                                <button onclick="downloadAllImages('Week2')" class="dropdown-item">
                                    {{ __('Week 2: 9/6-15/6') }}
                                </button>
                                <button onclick="downloadAllImages('Week3')" class="dropdown-item">
                                    {{ __('Week 3: 16/6-22/6') }}
                                </button>
                                <button onclick="downloadAllImages('Week4')" class="dropdown-item">
                                    {{ __('Week 4: 23/6-29/6') }}
                                </button>
                                <button onclick="downloadAllImages('Week5')" class="dropdown-item">
                                    {{ __('Week 5: 30/6-6/7') }}
                                </button>
                                <button onclick="downloadAllImages('Week6')" class="dropdown-item">
                                    {{ __('Week 6: 7/7-13/7') }}
                                </button>
                                <button onclick="downloadAllImages('Week7')" class="dropdown-item">
                                    {{ __('Week 7: 14/7-20/7') }}
                                </button>
                                <button onclick="downloadAllImages('Week8')" class="dropdown-item">
                                    {{ __('Week 8: 21/7-31/7') }}
                                </button>
                            </div>
                        </div>
                        <button onclick="exportToCSV()"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-600 focus:outline-none focus:border-blue-600 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Export to Excel') }}
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        @if ($loading)
                            <p class="text-3xl text-center font-medium">Loading data...</p>
                        @else
                            @if (session('success'))
                                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                                    x-transition:leave="transition ease-in duration-1000"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <table class="table table-zebra table-auto text-left">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Date Posted</th>
                                        <th>Name</th>
                                        <th>IC Number</th>
                                        <th>Phone Number</th>
                                        <th>Score</th>
                                        <th>Receipt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ 'uid' . $user->id }}</td>
                                            <td>{{ $user->created_at->format('d/m/y H:i:s') }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->no_ic }}</td>
                                            <td>{{ $user->no_fon }}</td>
                                            <td>{{ $user->score ?? '-' }}</td>
                                            <td>
                                                @if ($user->receipt)
                                                    @php
                                                        $fileExtension = pathinfo($user->receipt, PATHINFO_EXTENSION);
                                                    @endphp

                                                    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <!-- Render Image -->
                                                        <a href="#"
                                                            onclick="showReceipt('{{ asset('storage/' . $user->receipt) }}', 'image')">
                                                            <img class="w-[4rem]"
                                                                src="{{ asset('storage/' . $user->receipt) }}"
                                                                alt="Resit">
                                                        </a>
                                                    @elseif ($fileExtension === 'pdf')
                                                        <!-- Render PDF Thumbnail using PDF.js -->
                                                        <a href="#"
                                                            onclick="showReceipt('{{ asset('storage/' . $user->receipt) }}', 'pdf')">
                                                            <canvas id="pdf-thumbnail-{{ $user->id }}"
                                                                class="w-[4rem] h-[4rem]"></canvas>
                                                        </a>
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                var url = "{{ asset('storage/' . $user->receipt) }}";
                                                                var canvas = document.getElementById('pdf-thumbnail-{{ $user->id }}');
                                                                var ctx = canvas.getContext('2d');
                                                                pdfjsLib.getDocument(url).promise.then(function(pdf) {
                                                                    pdf.getPage(1).then(function(page) {
                                                                        var viewport = page.getViewport({
                                                                            scale: 0.2
                                                                        });
                                                                        canvas.width = viewport.width;
                                                                        canvas.height = viewport.height;
                                                                        page.render({
                                                                            canvasContext: ctx,
                                                                            viewport: viewport
                                                                        });
                                                                    });
                                                                });
                                                            });
                                                        </script>
                                                    @else
                                                        <!-- Fallback for unsupported formats -->
                                                        <p>Unsupported file format</p>
                                                    @endif
                                                @else
                                                    No receipt uploaded
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $users->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-image-modal />
</x-app-layout>

<script>
    function showReceipt(fileSrc, fileType) {
        const modal = document.getElementById('receipt-modal');
        const imageElement = document.getElementById('receiptImage');
        const pdfCanvas = document.getElementById('receiptPdfCanvas');
        const downloadButton = document.getElementById('download-button');

        // Clear previous content
        imageElement.style.display = 'none';
        pdfCanvas.style.display = 'none';

        // Set the download link
        downloadButton.href = fileSrc;

        if (fileType === 'image') {
            // Show image
            imageElement.src = fileSrc;
            imageElement.style.display = 'block';
        } else if (fileType === 'pdf') {
            // Render PDF in canvas using PDF.js
            const ctx = pdfCanvas.getContext('2d');
            pdfjsLib.getDocument(fileSrc).promise.then(function(pdf) {
                pdf.getPage(1).then(function(page) {
                    const viewport = page.getViewport({
                        scale: 1
                    });
                    pdfCanvas.width = viewport.width;
                    pdfCanvas.height = viewport.height;
                    pdfCanvas.style.display = 'block';
                    page.render({
                        canvasContext: ctx,
                        viewport: viewport
                    });
                });
            });
        }

        modal.showModal(); // Show the modal
    }


    function clearFilters() {
        document.getElementById('start_date').value = '';
        document.getElementById('end_date').value = '';
        document.getElementById('filter-form').submit();
    }

    // async function downloadAllImages() {
    //     // Store the clicked button element
    //     const button = event.target;
    //     const originalText = button.innerHTML;

    //     try {
    //         // Set loading state
    //         button.innerHTML = `
    //         <span class="inline-flex items-center">
    //             <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    //                 <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    //                 <path class="opacity-75" fill="green" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    //             </svg>
    //             Downloading...
    //         </span>`;
    //         button.disabled = true;

    //         const startDate = document.getElementById('start_date').value;
    //         const endDate = document.getElementById('end_date').value;

    //         // Fetch the list of images without puzzle version filter
    //         const url = `{{ route('dashboard') }}?start_date=${startDate}&end_date=${endDate}&export=1`;
    //         const response = await fetch(url);

    //         if (!response.ok) {
    //             throw new Error('Failed to fetch data for export');
    //         }

    //         const users = await response.json();

    //         if (users.length === 0) {
    //             throw new Error('No receipts found for the selected date range.');
    //         }

    //         const zip = new JSZip();
    //         let processedFiles = 0;
    //         const totalFiles = users.filter(user => user.Receipt_Name).length;

    //         for (const user of users) {
    //             if (user.Receipt_Name) {
    //                 const fileExtension = user.Receipt_Name.split('.').pop().toLowerCase();
    //                 const fileUrl = `{{ asset('storage') }}/resit/${user.Receipt_Name}`;

    //                 if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension) || fileExtension === 'pdf') {
    //                     try {
    //                         const fileResponse = await fetch(fileUrl);
    //                         if (!fileResponse.ok) continue;

    //                         const fileBlob = await fileResponse.blob();
    //                         const fileName = `${user['User ID']}_resit.${fileExtension}`;
    //                         zip.file(fileName, fileBlob);

    //                         processedFiles++;
    //                     } catch (error) {
    //                         console.error(`Error processing file for ${user['User ID']}:`, error);
    //                     }
    //                 }
    //             }
    //         }

    //         if (processedFiles === 0) {
    //             throw new Error('No files were successfully processed');
    //         }

    //         // Generate the current date in ddmmyyyy format
    //         const date = new Date();
    //         const day = String(date.getDate()).padStart(2, '0');
    //         const month = String(date.getMonth() + 1).padStart(2, '0');
    //         const year = date.getFullYear();
    //         const formattedDate = `${day}${month}${year}`;

    //         // Generate the zip file and trigger download
    //         const content = await zip.generateAsync({
    //             type: "blob"
    //         });
    //         saveAs(content, `receipts_${formattedDate}.zip`);

    //         // Show success state briefly
    //         button.innerHTML = `
    //         <span class="inline-flex items-center text-green-500">
    //             <svg class="h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    //                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    //             </svg>
    //             Downloaded!
    //         </span>`;

    //         // Reset button after 2 seconds
    //         setTimeout(() => {
    //             button.innerHTML = originalText;
    //             button.disabled = false;
    //         }, 2000);

    //     } catch (error) {
    //         console.error('Error in downloadAllImages:', error);

    //         // Show error state briefly
    //         button.innerHTML = `
    //         <span class="inline-flex items-center text-red-500">
    //             <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="red">
    //                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    //             </svg>
    //             Failed to download
    //         </span>`;

    //         // Show error message to user
    //         console.error(error.message || 'An error occurred while downloading the receipts. Please try again.');

    //         // Reset button after 2 seconds
    //         setTimeout(() => {
    //             button.innerHTML = originalText;
    //             button.disabled = false;
    //         }, 2000);

    //     } finally {
    //         // Ensure button is re-enabled even if the timeout hasn't finished
    //         setTimeout(() => {
    //             if (button.disabled) {
    //                 button.innerHTML = originalText;
    //                 button.disabled = false;
    //             }
    //         }, 5000); // Failsafe timeout
    //     }
    // }

    async function downloadAllImages(week) {
        // Store the clicked button element
        const button = event.target;
        const originalText = button.innerHTML;

        try {
            // Set loading state
            button.innerHTML = `
            <span class="inline-flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="green" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Downloading...
            </span>`;
            button.disabled = true;

            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            // Fetch the list of images with puzzle version filter
            const url =
                `{{ route('dashboard') }}?start_date=${startDate}&end_date=${endDate}&week=${week}&export=1`;
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Failed to fetch data for export');
            }

            const users = await response.json();
            console.log(users);
            

            if (users.length === 0) {
                throw new Error('No receipts found for the selected week and date range.');
            }

            const zip = new JSZip();
            let processedFiles = 0;
            const totalFiles = users.filter(user => user.Receipt_Name).length;
            console.log(totalFiles);
            
            
            for (const user of users) {
                if (user.Receipt_Name) {
                    const fileExtension = user.Receipt_Name.split('.').pop().toLowerCase();
                    const fileUrl = `{{ asset('storage') }}/resit/${user.Receipt_Name}`;

                    if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension) || fileExtension === 'pdf') {
                        try {
                            const fileResponse = await fetch(fileUrl);
                            if (!fileResponse.ok) continue;

                            const fileBlob = await fileResponse.blob();
                            const fileName = `${user.id||user['User ID']}_resit.${fileExtension}`;
                            zip.file(fileName, fileBlob);

                            processedFiles++;
                        } catch (error) {
                            console.error(`Error processing file for ${user['User ID']}:`, error);
                        }
                    }
                }
            }

            if (processedFiles === 0) {
                throw new Error('No files were successfully processed');
            }

            // Generate the current date in ddmmyyyy format
            const date = new Date();
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            const formattedDate = `${day}${month}${year}`;

            // Include puzzle version in the filename
            const weekFormatted = week.replace(/\s+/g, '_').toLowerCase();

            // Generate the zip file and trigger download
            const content = await zip.generateAsync({
                type: "blob"
            });
            saveAs(content, `receipts_${weekFormatted}_${formattedDate}.zip`);

            // Show success state briefly
            button.innerHTML = `
            <span class="inline-flex items-center text-green-500">
                <svg class="h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Downloaded!
            </span>`;

            // Reset button after 2 seconds
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);

        } catch (error) {
            console.error('Error in downloadAllImages:', error);

            // Show error state briefly
            button.innerHTML = `
            <span class="inline-flex items-center text-red-500">
                <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="red">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Failed to download
            </span>`;

            // Show error message to user
            console.error(error.message || 'An error occurred while downloading the receipts. Please try again.');

            // Reset button after 2 seconds
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);

        } finally {
            // Ensure button is re-enabled even if the timeout hasn't finished
            setTimeout(() => {
                if (button.disabled) {
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            }, 5000); // Failsafe timeout
        }
    }

    function downloadImage(url, filename) {
        fetch(url)
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(err => console.error('Error downloading image:', err));
    }
</script>
<script>
    async function exportToCSV() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;

        const url = `{{ route('dashboard') }}?start_date=${startDate}&end_date=${endDate}&export=1`;

        const response = await fetch(url);
        if (!response.ok) {
            console.error('Failed to fetch data for export:', response.statusText);
            return;
        }

        const data = await response.json();

        // Process the data using SheetJS
        const worksheet = XLSX.utils.json_to_sheet(data);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Users");

        const date = new Date();
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = String(date.getFullYear()).slice(-2);
        const formattedDate = `${day}/${month}/${year}`;

        const fileName = `corntoz_${formattedDate}.xlsx`;

        // Export to CSV
        XLSX.writeFile(workbook, fileName, {
            bookType: 'xlsx'
        });
    }
</script>
