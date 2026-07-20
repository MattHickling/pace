<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mt-4" x-data="{
        loading: true,
        data: null,
        error: null,
        loadData() {
            this.loading = true;
            this.error = null;

            fetch('{{ route('strava.data') }}', {
                headers: { Accept: 'application/json' }
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Unable to load Strava data.');
                    }

                    return response.json();
                })
                .then((result) => {
                    this.data = result;
                })
                .catch((err) => {
                    this.error = err.message;
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }" x-init="loadData()">
        <button type="button" @click="loadData()" :disabled="loading" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50">
            <span x-show="!loading">{{ __('Refresh') }}</span>
            <span x-show="loading">{{ __('Loading...') }}</span>
        </button>

        <div class="mt-3 text-sm text-gray-600" x-show="loading">Loading your Strava data...</div>
        <div class="mt-3 text-sm text-red-600" x-show="error" x-text="error"></div>

        <div class="mt-4" x-show="data">
            <pre class="whitespace-pre-wrap rounded bg-gray-50 p-4 text-xs text-gray-700" x-text="JSON.stringify(data, null, 2)"></pre>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

  
</x-app-layout>
