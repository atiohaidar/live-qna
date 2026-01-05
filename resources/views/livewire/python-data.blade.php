<div class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl mb-4">
                Laravel <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">x</span> Python
            </h1>
            <p class="text-xl text-indigo-100">
                Demo integrasi data langsung dari script Python menggunakan shell execution.
            </p>
        </div>

        @if($error)
            <div class="bg-red-500/20 border border-red-500/50 backdrop-blur-md rounded-2xl p-6 text-red-100 mb-8">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold">{{ $error }}</span>
                </div>
            </div>
        @endif

        @if($pythonData)
            <div class="space-y-8">
                <!-- Status Card -->
                <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl transition-all hover:scale-[1.01]">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-green-500/20 rounded-2xl">
                                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Execution Success</h2>
                                <p class="text-indigo-200 text-sm">{{ $pythonData['timestamp'] }}</p>
                            </div>
                        </div>
                        <button wire:click="fetchDataFromPython" class="px-6 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-full font-medium transition-all shadow-lg shadow-indigo-500/25 active:scale-95">
                            Refresh Data
                        </button>
                    </div>

                    <p class="text-lg text-white/90 leading-relaxed mb-6 italic">
                        "{{ $pythonData['message'] }}"
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                            <span class="text-indigo-300 text-xs uppercase tracking-wider font-semibold">Python Version</span>
                            <p class="text-white mt-1 font-mono text-sm">{{ $pythonData['python_version'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Table/List Card -->
                <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl overflow-hidden shadow-2xl">
                    <div class="px-8 py-6 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white">Processed Items from Python</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/5">
                                    <th class="px-8 py-4 text-indigo-200 font-semibold uppercase text-xs">ID</th>
                                    <th class="px-8 py-4 text-indigo-200 font-semibold uppercase text-xs">Feature Name</th>
                                    <th class="px-8 py-4 text-indigo-200 font-semibold uppercase text-xs text-right">Value</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($pythonData['items'] as $item)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-8 py-5 text-indigo-100 font-mono">{{ $item['id'] }}</td>
                                        <td class="px-8 py-5 text-white font-medium">{{ $item['name'] }}</td>
                                        <td class="px-8 py-5 text-right">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item['value'] == 'Positif' || $item['value'] == 'Bullish' || $item['value'] == 'Buy' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                                {{ $item['value'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="/" class="text-indigo-300 hover:text-white transition-colors text-sm font-medium flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Home</span>
            </a>
        </div>
    </div>
</div>
