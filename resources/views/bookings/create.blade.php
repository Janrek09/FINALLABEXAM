<x-app-layout>
    <style>
        .cartoon-shadow {
            box-shadow: 4px 4px 0px #222;
        }
        .cartoon-card {
            background-color: #fffafa;
            border: 3px solid #222;
            border-radius: 1.5rem;
            box-shadow: 4px 4px 0px #222;
        }
        .cartoon-button {
            background-color: #f43f5e;
            color: white;
            border: 2px solid #222;
            box-shadow: 3px 3px 0px #222;
            transition: all 0.2s ease;
        }
        .cartoon-button:hover {
            background-color: #be123c;
            transform: translateY(-2px);
            box-shadow: 6px 6px 0px #222;
        }
        .cartoon-heading {
            font-weight: 900;
            color: #be123c;
            text-shadow: 1px 1px #fbb6ce;
        }
        .fc-day-disabled {
            background-color: #fee2e2 !important;
            color: #dc2626 !important;
            cursor: not-allowed !important;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-pink-50 to-rose-100 py-10 font-sans">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-10 text-center">
                <h1 class="text-4xl font-extrabold cartoon-heading mb-2">💍 Book Your Special Day</h1>
                <p class="text-rose-500 text-lg">Choose a date and time to schedule your wedding appointment</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Booking Form -->
                <div class="cartoon-card p-8">
                    <h2 class="text-2xl font-semibold cartoon-heading mb-6">Wedding Appointment Details</h2>
                    <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6" id="bookingForm">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-rose-700 mb-2">Booking Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="w-full px-4 py-2 border border-rose-200 rounded-lg focus:ring-2 focus:ring-rose-400 focus:border-rose-400"
                                placeholder="E.g., Wedding Ceremony with Sarah & John" required>
                            @error('title')
                                <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date and Time Display -->
                        <div>
                            <label class="block text-sm font-medium text-rose-700 mb-2">Selected Date & Time</label>
                            <div class="flex items-center space-x-2">
                                <input type="text" id="display_date" 
                                    class="w-full px-4 py-2 border border-rose-200 rounded-lg bg-gray-50" 
                                    placeholder="Select a date from calendar" readonly>
                                <input type="text" id="display_time" 
                                    class="w-full px-4 py-2 border border-rose-200 rounded-lg bg-gray-50" 
                                    placeholder="Select a time" readonly>
                            </div>
                            @error('booking_date')
                                <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @error('booking_time')
                                <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hidden Inputs for form submission -->
                        <input type="hidden" id="booking_date" name="booking_date" value="{{ old('booking_date') }}">
                        <input type="hidden" id="booking_time" name="booking_time" value="{{ old('booking_time') }}">

                        <!-- Time Picker Modal -->
                        <div id="timePickerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 hidden">
                            <div class="cartoon-card w-full max-w-sm p-6">
                                <h3 class="text-lg font-bold mb-4 text-rose-700">Choose a Time for <span id="modalDate"></span></h3>
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    @foreach(['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'] as $time)
                                        <button type="button" class="time-option px-4 py-2 rounded-lg bg-rose-100 hover:bg-rose-500 hover:text-white"
                                            data-time="{{ $time }}">
                                            {{ \Carbon\Carbon::parse($time)->format('g:i A') }}
                                        </button>
                                    @endforeach
                                </div>
                                <button type="button" id="closeTimePicker"
                                    class="w-full mt-2 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                    Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-rose-700 mb-2">Notes or Preferences</label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full px-4 py-2 border border-rose-200 rounded-lg focus:ring-2 focus:ring-rose-400 focus:border-rose-400"
                                placeholder="Describe the ceremony or any special arrangements">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex items-center justify-between pt-4">
                            <button type="submit" class="cartoon-button inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Confirm Booking
                            </button>
                            <a href="{{ route('bookings.index') }}" class="text-sm text-rose-500 hover:underline">Cancel</a>
                        </div>
                    </form>
                </div>

                <!-- Calendar & Info -->
                <div class="space-y-8">
                    <!-- Calendar -->
                    <div class="cartoon-card p-6">
                        <h2 class="text-xl font-semibold cartoon-heading mb-4">📅 Choose a Date</h2>
                        <div id="fullcalendar"></div>
                        <div id="selectedDateDisplay" class="mt-4 text-center text-rose-700 font-semibold"></div>
                    </div>

                    <!-- Tips -->
                    <div class="cartoon-card p-6 bg-rose-50 border border-rose-200">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-rose-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c1.656 0 3-1.344 3-3S13.656 2 12 2 9 3.344 9 5s1.344 3 3 3zM12 14v-4m0 4v6m0-6h4m-4 0H8" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold cartoon-heading mb-2">Helpful Tips</h3>
                                <ul class="space-y-2 text-sm text-rose-600">
                                    <li>🌸 Select a meaningful date for your ceremony</li>
                                    <li>⏰ Choose a time that suits your theme</li>
                                    <li>📝 Share details like location or number of guests</li>
                                    <li>📅 Unavailable dates will be marked in red</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Time Categories -->
                    <div class="cartoon-card p-6">
                        <h3 class="text-lg font-semibold cartoon-heading mb-4">⏳ Popular Time Slots</h3>
                        <div class="grid grid-cols-3 gap-3 text-sm text-center">
                            <div class="p-3 bg-rose-100 text-rose-700 rounded-lg">
                                <p class="font-medium">Morning</p>
                                <p>9:00 AM – 12:00 PM</p>
                            </div>
                            <div class="p-3 bg-rose-200 text-rose-800 rounded-lg">
                                <p class="font-medium">Afternoon</p>
                                <p>1:00 PM – 4:00 PM</p>
                            </div>
                            <div class="p-3 bg-rose-300 text-white rounded-lg">
                                <p class="font-medium">Evening</p>
                                <p>4:00 PM – 5:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedDate = null;
            let selectedTime = null;
            let bookedDates = [];

            // Initialize FullCalendar with your existing configuration
            function renderCalendar() {
                let calendarEl = document.getElementById('fullcalendar');
                calendarEl.innerHTML = '';
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [FullCalendar.dayGridPlugin, FullCalendar.interactionPlugin],
                    initialView: 'dayGridMonth',
                    selectable: true,
                    dateClick: function(info) {
                        if (bookedDates.includes(info.dateStr)) return;
                        
                        selectedDate = info.dateStr;
                        document.getElementById('booking_date').value = selectedDate;
                        document.getElementById('display_date').value = formatDate(selectedDate);
                        document.getElementById('modalDate').textContent = formatDate(selectedDate);
                        document.getElementById('timePickerModal').classList.remove('hidden');
                    },
                    dayCellClassNames: function(arg) {
                        return bookedDates.includes(arg.date.toISOString().split('T')[0]) ? 
                            ['bg-rose-200', 'text-rose-600', 'cursor-not-allowed'] : [];
                    }
                });
                calendar.render();
            }

            // Fetch booked dates and initialize calendar
            fetch('/api/booking-dates')
                .then(response => response.json())
                .then(data => {
                    bookedDates = (data.dates || data).map(d => d.date || d);
                    renderCalendar();
                }).catch(() => {
                    bookedDates = [];
                    renderCalendar();
                });

            // Time selection handlers
            document.querySelectorAll('.time-option').forEach(button => {
                button.addEventListener('click', function() {
                    selectedTime = this.getAttribute('data-time');
                    document.getElementById('booking_time').value = selectedTime;
                    document.getElementById('display_time').value = formatTime(selectedTime);
                    document.getElementById('timePickerModal').classList.add('hidden');
                });
            });

            // Close time picker
            document.getElementById('closeTimePicker').addEventListener('click', function() {
                document.getElementById('timePickerModal').classList.add('hidden');
            });

            // Form validation before submission
            document.getElementById('bookingForm').addEventListener('submit', function(e) {
                if (!selectedDate || !selectedTime) {
                    e.preventDefault();
                    alert('Please select both a date and time for your booking.');
                }
            });

            // Helper functions
            function formatDate(dateStr) {
                const date = new Date(dateStr);
                return date.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
            }

            function formatTime(timeStr) {
                const [hours, minutes] = timeStr.split(':');
                const hour = parseInt(hours);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const displayHour = hour % 12 || 12;
                return `${displayHour}:${minutes} ${ampm}`;
            }

            // Initialize display fields if there are old values (form validation errors)
            if (document.getElementById('booking_date').value) {
                document.getElementById('display_date').value = formatDate(document.getElementById('booking_date').value);
            }
            if (document.getElementById('booking_time').value) {
                document.getElementById('display_time').value = formatTime(document.getElementById('booking_time').value);
            }
        });
    </script>
</x-app-layout>
