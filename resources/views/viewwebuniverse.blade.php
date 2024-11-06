@extends('layouts.default')

@section('content')
<div id="tabs" class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <!-- Website Tab -->
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg text-blue-600 border-blue-600" id="website-tab" data-tabs-target="#website" type="button" role="tab" aria-controls="website" aria-selected="true">
                Website
            </button>
        </li>

        <!-- RSS Feed Tab -->
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="rss-tab" data-tabs-target="#rss" type="button" role="tab" aria-controls="rss" aria-selected="false">
                RSS Feed
            </button>
        </li>
    </ul>
</div>

<!-- Tab Content Area -->
<div id="default-tab-content">
    <!-- Website Content -->
    <div id="website" role="tabpanel" aria-labelledby="website-tab" class="p-4">
        <h2 class="text-lg font-semibold mb-4">Website Information</h2>
        <form action="{{ route('webuniverse.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- URL/Link -->
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL/Link</label>
                    <input type="url" name="url" id="url" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="news">News</option>
                        <option value="blog">Blog</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="type" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="local">Local</option>
                        <option value="national">National</option>
                        <option value="international">International</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <!-- Regional Focus -->
                <div>
                    <label for="regional_focus" class="block text-sm font-medium text-gray-700">Regional Focus</label>
                    <select name="regional_focus" id="regional_focus" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="africa">Africa</option>
                        <option value="asia">Asia</option>
                        <option value="europe">Europe</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <!-- Webrank -->
                <div>
                    <label for="webrank" class="block text-sm font-medium text-gray-700">Webrank</label>
                    <input type="number" name="webrank" id="webrank" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Newsrank -->
                <div>
                    <label for="newsrank" class="block text-sm font-medium text-gray-700">Newsrank</label>
                    <input type="number" name="newsrank" id="newsrank" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Reach -->
                <div>
                    <label for="reach" class="block text-sm font-medium text-gray-700">Reach</label>
                    <input type="number" name="reach" id="reach" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Has a Print Publication? -->
                <div class="flex items-center">
                    <label for="print_publication" class="block text-sm font-medium text-gray-700 mr-4">Has a Print Publication?</label>
                    <input type="checkbox" name="print_publication" id="print_publication" class="text-blue-600 rounded">
                </div>

                <!-- Audience Type Focus -->
                <div class="md:col-span-2">
                    <label for="audience_type" class="block text-sm font-medium text-gray-700">Audience Type Focus</label>
                    <select name="audience_type[]" id="audience_type" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500" multiple>
                        <option value="general">General</option>
                        <option value="professionals">Professionals</option>
                        <option value="students">Students</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <!-- Audience Age Focus -->
                <div class="md:col-span-2">
                    <label for="audience_age" class="block text-sm font-medium text-gray-700">Audience Age Focus</label>
                    <select name="audience_age[]" id="audience_age" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500" multiple>
                        <option value="18-25">18-25</option>
                        <option value="26-35">26-35</option>
                        <option value="36-50">36-50</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <!-- Country of Origin -->
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Country of Origin</label>
                    <select name="country" id="country" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="us">United States</option>
                        <option value="uk">United Kingdom</option>
                        <option value="ca">Canada</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Advertising Rate -->
                <div>
                    <label for="advertising_rate" class="block text-sm font-medium text-gray-700">Advertising Rate</label>
                    <input type="number" name="advertising_rate" id="advertising_rate" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Twitter Handle -->
                <div>
                    <label for="twitter" class="block text-sm font-medium text-gray-700">Twitter Handle</label>
                    <input type="text" name="twitter" id="twitter" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="@">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center">Submit</button>
            </div>
        </form>
    </div>

    <!-- RSS Feed Content -->
    <div id="rss" role="tabpanel" aria-labelledby="rss-tab" class="hidden p-4">
        <h2 class="text-lg font-semibold mb-4">RSS Feed Information</h2>
        <form action="{{ route('rssfeed.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- RSS Name -->
                <div>
                    <label for="rss_name" class="block text-sm font-medium text-gray-700">RSS Name</label>
                    <input type="text" name="rss_name" id="rss_name" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- RSS URL -->
                <div>
                    <label for="rss_url" class="block text-sm font-medium text-gray-700">RSS URL</label>
                    <input type="url" name="rss_url" id="rss_url" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <!-- RSS Category -->
                <div>
                    <label for="rss_category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="rss_category" id="rss_category" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="technology">Technology</option>
                        <option value="health">Health</option>
                        <option value="business">Business</option>
                    </select>
                </div>

                <!-- RSS Frequency -->
                <div>
                    <label for="rss_frequency" class="block text-sm font-medium text-gray-700">Frequency</label>
                    <select name="rss_frequency" id="rss_frequency" class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="mt-4 md:col-span-2">
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('[data-tabs-target]');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Hide all tab content
                document.querySelectorAll('[role="tabpanel"]').forEach(content => {
                    content.classList.add('hidden');
                });

                // Show the selected tab content
                const target = document.querySelector(tab.getAttribute('data-tabs-target'));
                target.classList.remove('hidden');

                // Update the active tab style
                tabs.forEach(t => t.classList.remove('border-blue-600', 'text-blue-600'));
                tab.classList.add('border-blue-600', 'text-blue-600');
            });
        });
    });
</script>
@endsection
