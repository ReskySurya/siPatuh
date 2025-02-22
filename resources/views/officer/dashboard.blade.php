@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Header Section -->
        <div class="border-b pb-4 mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">{{ __('Officer Dashboard') }}</h1>

            @if (session('status'))
            <div class="mt-4 bg-green-100 border-l-4 border-green-500 p-4 rounded" role="alert">
                <p class="text-green-700">{{ session('status') }}</p>
            </div>
            @endif

            <div class="mt-4">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-700">
                    Welcome, Officer {{ Auth::guard('officer')->user()->name }}
                </h2>
                <p class="mt-1 text-gray-600">
                    <span class="font-medium">NIP:</span> {{ Auth::guard('officer')->user()->nip }}
                </p>
                <p class="mt-1 text-gray-600">
                    <span class="font-medium">Lisensi:</span> {{ Auth::guard('officer')->user()->lisensi }}
                </p>
            </div>
        </div>

        <!-- Rejected Forms Section dengan Card -->
        <div class="mt-6">
            <h3 class="text-lg sm:text-xl font-semibold text-red-600 mb-4">
                Form yang Perlu Diperbaiki
            </h3>

            @php
            $rejectedHhmdForms = \App\Models\hhmdsaved::where('submitted_by', Auth::guard('officer')->id())
                ->where('status', 'rejected')
                ->orderBy('reviewed_at', 'desc')
                ->get();

            $rejectedWtmdForms = \App\Models\wtmdsaved::where('submitted_by', Auth::guard('officer')->id())
                ->where('status', 'rejected')
                ->orderBy('reviewed_at', 'desc')
                ->get();

            $rejectedXrayForms = \App\Models\xraysaved::where('submitted_by', Auth::guard('officer')->id())
                ->where('status', 'rejected')
                ->orderBy('reviewed_at', 'desc')
                ->get();

            $rejectedForms = $rejectedHhmdForms->concat($rejectedWtmdForms)->concat($rejectedXrayForms)->sortByDesc('reviewed_at');
            @endphp

            @if($rejectedForms->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($rejectedForms as $form)
                <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <span class="px-2 py-1 text-xs rounded-full
                                {{ $form instanceof \App\Models\hhmdsaved ? 'bg-purple-100 text-purple-800' :
                                   ($form instanceof \App\Models\wtmdsaved ? 'bg-blue-100 text-blue-800' :
                                   'bg-green-100 text-green-800') }}">
                                @if($form instanceof \App\Models\hhmdsaved)
                                    HHMD
                                @elseif($form instanceof \App\Models\wtmdsaved)
                                    WTMD
                                @elseif($form instanceof \App\Models\xraysaved)
                                    X-Ray
                                @endif
                            </span>
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $form->testDateTime->format('d/m/Y H:i') }} WIB
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div>
                            <span class="text-sm font-medium text-gray-600">Lokasi:</span>
                            <span class="text-sm text-gray-800">{{ $form->location }}</span>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Catatan:</span>
                            <p class="text-sm text-red-600">{{ $form->rejection_note }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        @if($form instanceof \App\Models\hhmdsaved)
                            <a href="{{ route('officer.hhmd.edit', $form->id) }}"
                               class="inline-block w-full text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                Edit Form
                            </a>
                        @elseif($form instanceof \App\Models\wtmdsaved)
                            <a href="{{ route('officer.wtmd.edit', $form->id) }}"
                               class="inline-block w-full text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                Edit Form
                            </a>
                        @elseif($form instanceof \App\Models\xraysaved)
                            <a href="{{ $form->location == 'HBSCP Bagasi Timur' || $form->location == 'HBSCP Bagasi Barat'
                                ? route('officer.xray.editbagasi', $form->id)
                                : route('officer.xray.editcabin', $form->id) }}"
                               class="inline-block w-full text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                Edit Form
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-gray-50 rounded-lg p-6 text-center">
                <p class="text-gray-600">Tidak ada form yang perlu diperbaiki.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const tableContainer = document.getElementById('tableContainer');
    const scrollIndicator = document.getElementById('scrollIndicator');

    if (tableContainer && scrollIndicator) {
            const checkScroll = () => {
                scrollIndicator.style.display =
                    tableContainer.scrollWidth > tableContainer.clientWidth ? 'block' : 'none';
            };

            tableContainer.addEventListener('scroll', () => {
                if (tableContainer.scrollLeft > 0) {
                    scrollIndicator.style.display = 'none';
                }
            });

            // Check on load and resize
            checkScroll();
            window.addEventListener('resize', checkScroll);
        }
    });
</script>
@endpush

@push('styles')
<style>
    @media (max-width: 640px) {
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
            overflow-x: auto;
        }

        .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            @apply bg-gray-100 rounded;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            @apply bg-gray-400 rounded hover: bg-gray-500 transition-colors;
        }

        .scrollbar-thin {
            scrollbar-width: thin;
            scrollbar-color: #9ca3af #f3f4f6;
        }

        table {
            display: block;
            width: 100%;
            -webkit-overflow-scrolling: touch;
        }
    }
</style>
@endpush
@endsection
