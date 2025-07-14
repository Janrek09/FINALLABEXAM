<x-app-layout>
    <style>
        .cartoon-card {
            border: 3px solid #222;
            border-radius: 1.5rem;
            background-color:rgb(107, 179, 190);
            box-shadow: 5px 5px 0 #222;
            padding: 1.75rem;
        }

        .cartoon-button {
            border: 2px solid #222;
            box-shadow: 3px 3px 0 #222;
            transition: all 0.2s ease-in-out;
            font-weight: bold;
        }

        .cartoon-button:hover {
            transform: translateY(-2px);
            box-shadow: 5px 5px 0 #222;
        }

        .cartoon-heading {
            font-weight: 900;
            color: #e11d48;
            text-shadow: 1px 1px #fbcfe8;
        }

        .section-spacing {
            margin-bottom: 3rem;
        }

        .text-base {
            font-size: 1.1rem;
            line-height: 1.75rem;
        }

        .active-view-btn {
            background-color: #be123c !important;
            color: #fff !important;
            border-color: #be123c !important;
            transform: scale(1.05);
            box-shadow: 4px 4px 0 #222;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-pink-50 to-rose-100 bg-fixed bg-cover pb-16">
        <!-- Header -->
        <div class="bg-white bg-opacity-90 border-b border-rose-200 py-10 shadow-inner mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl cartoon-heading font-serif mb-3">📖 My Bookings</h1>
                <p class="text-xl text-gray-700 italic">Cherish every moment — manage your bookings here</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Message -->
            @if(session('success'))
                <div class="cartoon-card mb-10 bg-green-100 border-2 border-green-300 text-green-800 text-base flex items-center gap-3">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 section-spacing">
                @foreach ([
                    ['value' => $totalBookings, 'label' => 'Total Bookings'],
                    ['value' => $upcomingBookings, 'label' => 'Upcoming'],
                    ['value' => $pastBookings, 'label' => 'Past']
                ] as $stat)
                    <div class="cartoon-card text-center">
                        <div class="text-4xl font-extrabold text-rose-600 mb-1">{{ $stat['value'] }}</div>
                        <div class="text-sm text-gray-700 font-semibold uppercase tracking-wide">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Toggle View -->
            <div class="text-center mb-12">
                <button onclick="showView('list')" id="list-btn"
                        class="px-8 py-3 bg-rose-700 text-white rounded-full cartoon-button active-view-btn">
                    📝 List View
                </button>
                <button onclick="showView('calendar')" id="calendar-btn"
                        class="px-8 py-3 bg-rose-700 text-white rounded-full cartoon-button active-view-btn">
                    📅 Calendar View
                </button>
            </div>

            <!-- List View -->
            <div id="list-view" class="view-section section-spacing">
                @if($bookings->count() > 0)
                    <div class="space-y-8">
                        @foreach($bookings as $booking)
                            <div class="cartoon-card">
                                <div class="flex flex-col md:flex-row justify-between gap-4 md:items-start">
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-rose-700 mb-2">{{ $booking->title }}</h3>
                                        <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                            📅 {{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y - h:i A') }}
                                        </div>
                                        @if($booking->description)
                                            <p class="text-base text-gray-800 leading-relaxed">{{ $booking->description }}</p>
                                        @endif
                                    </div>
                                    <div class="flex flex-wrap gap-3 md:gap-2 md:flex-col justify-end md:justify-start">
                                        <a href="{{ route('bookings.edit', $booking) }}"
                                           class="px-6 py-2 bg-yellow-400 text-black rounded-full cartoon-button">
                                            ✏️ Edit
                                        </a>
                                        <form method="POST" action="{{ route('bookings.destroy', $booking) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this booking?')"
                                                    class="px-6 py-2 bg-yellow-400 text-black rounded-full cartoon-button">
                                                🗑️ Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="w-20 h-20 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner text-3xl">
                            💍
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">No bookings found!</h3>
                        <p class="text-gray-700 text-base mb-6">Start your journey by adding a beautiful event.</p>
                        <a href="{{ route('bookings.create') }}"
                           class="px-8 py-3 bg-rose-700 text-white rounded-full cartoon-button active-view-btn">
                            ➕ Create New Booking
                        </a>
                    </div>
                @endif
            </div>

            <!-- Calendar View -->
            <div id="calendar-view" class="view-section hidden section-spacing">
                <div class="cartoon-card">
                    <div id="calendar" class="min-h-[400px] text-gray-800 text-base"></div>
                </div>
            </div>
    </div>

    <!-- View Toggle Script -->
    <script>
        function showView(view) {
            document.querySelectorAll('.view-section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(view + '-view').classList.remove('hidden');

            ['list', 'calendar'].forEach(id => {
                const btn = document.getElementById(id + '-btn');
                btn.classList.remove('active-view-btn');
            });
            document.getElementById(view + '-btn').classList.add('active-view-btn');
        }
    </script>
</x-app-layout>
