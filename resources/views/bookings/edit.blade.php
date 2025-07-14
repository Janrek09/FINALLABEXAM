<x-app-layout>
    <style>
        .cartoon-shadow {
            box-shadow: 4px 4px 0 #222;
        }
        .cartoon-card {
            border: 3px solid #222;
            border-radius: 1.5rem;
            box-shadow: 4px 4px 0 #222;
            background-color: #fffafa;
        }
        .cartoon-button {
            background-color: #f43f5e;
            border: 2px solid #222;
            color: white;
            box-shadow: 3px 3px 0 #222;
            transition: all 0.2s ease;
        }
        .cartoon-button:hover {
            background-color: #be123c;
            transform: translateY(-2px);
            box-shadow: 5px 5px 0 #222;
        }
        .cartoon-heading {
            font-weight: 900;
            color: #be123c;
            text-shadow: 1px 1px #fbb6ce;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-100 to-white">
        <!-- Header -->
        <div class="bg-white border-b border-rose-200 py-10 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl cartoon-heading mb-2">🎀 Edit Wedding Booking</h1>
                <p class="text-lg text-gray-600 italic">Cherish every detail of your special day</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="cartoon-card p-10">
                <form method="POST" action="{{ route('bookings.update', $booking) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Booking Info -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-semibold cartoon-heading flex items-center gap-2">
                                <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c1.104 0 2 .896 2 2s-.896 2-2 2-2-.896-2-2 .896-2 2-2zm0 10c-3.314 0-6-2.686-6-6 0-2.846 4-8 6-8s6 5.154 6 8c0 3.314-2.686 6-6 6z" />
                                </svg>
                                Booking Info
                            </h3>

                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $booking->title) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rose-400 focus:border-rose-400" required>
                                @error('title')
                                    <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea id="description" name="description" rows="4"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rose-400 focus:border-rose-400">{{ old('description', $booking->description) }}</textarea>
                                @error('description')
                                    <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Date & Time -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-semibold cartoon-heading flex items-center gap-2">
                                <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Wedding Schedule
                            </h3>

                            <!-- Date -->
                            <div>
                                <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-1">Wedding Date</label>
                                <input type="date" id="booking_date" name="booking_date"
                                       value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d')) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rose-400 focus:border-rose-400" required>
                                @error('booking_date')
                                    <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Time -->
                            <div>
                                <label for="booking_time" class="block text-sm font-medium text-gray-700 mb-1">Wedding Time</label>
                                <select id="booking_time" name="booking_time"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rose-400 focus:border-rose-400" required>
                                    <option value="">Select a time</option>
                                    @php
                                        $currentTime = \Carbon\Carbon::parse($booking->booking_time)->format('H:i');
                                    @endphp
                                    @foreach (['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'] as $time)
                                        <option value="{{ $time }}" {{ old('booking_time', $currentTime) == $time ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('g:i A') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('booking_time')
                                    <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-8 border-t border-gray-100">
                        <div class="flex gap-4">
                            <button type="submit"
                                    class="cartoon-button inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Save Changes
                            </button>
                            <a href="{{ route('bookings.index') }}"
                               class="cartoon-button bg-gray-400 hover:bg-gray-500 inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Delete Button (outside the edit form) -->
                <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                    <form method="POST" action="{{ route('bookings.destroy', $booking) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="cartoon-button bg-rose-300 hover:bg-rose-400 px-4 py-2 text-sm rounded-full"
                                onclick="return confirm('Are you sure you want to delete this booking?')">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
