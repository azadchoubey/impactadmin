@extends('layouts.default')

@section('content')
<div class="p-5">
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="article-details" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Article Details</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Article Image Details</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Article Keyword</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Article Cilents</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="grid grid-cols-2 gap-4">
                <!-- Information Box -->
                <div class="border p-4 rounded-lg bg-white dark:bg-gray-700">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="articleid" class="block text-sm font-medium text-gray-700">Article Id</label>
                            <input disabled id="articleid" value="{{$article['article']->articleid}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input id="title" value="{{$article['article']->headline}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="subtitle" class="block text-sm font-medium text-gray-700">Sub Title</label>
                            <input id="subtitle" value="{{$article['article']->subtitle}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="publication" class="block text-sm font-medium text-gray-700">Publication</label>
                            <input id="publication" value="{{$article['article']->publication}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="no" class="block text-sm font-medium text-gray-700">Number of</label>
                            <input id="no" value="{{$article['article']->numberofpages}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="place" class="block text-sm font-medium text-gray-700">Place of</label>
                            <input id="place" value="{{$article['article']->city}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input id="type" value="{{$article['article']->type}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Date of</label>
                            <input id="date" value="{{$article['article']->pubdate}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="sector" class="block text-sm font-medium text-gray-700">Sector</label>
                            <input id="sector" value="{{$article['article']->sector}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="totaltime" class="block text-sm font-medium text-gray-700">Total Time</label>
                            <input id="totaltime" value="" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="totalave" class="block text-sm font-medium text-gray-700">Total AVE</label>
                            <input id="totalave" value="{{$article['article']->ave}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <div>
                            <label for="preminum" class="block text-sm font-medium text-gray-700">Preminum</label>
                            <input id="preminum" value="" type="checkbox">
                        </div>
                        <div>
                            <label for="includes" class="block text-sm font-medium text-gray-700">Includes</label>
                            <input id="includes" value="" type="checkbox">
                        </div>
                        <div>
                            <label for="pot" class="block text-sm font-medium text-gray-700">Pot No</label>
                            <input id="pot" value="" type="checkbox">
                        </div>
                        <div>
                            <label for="epapar" class="block text-sm font-medium text-gray-700">E paper</label>
                            <input id="epapar" value="" type="checkbox">
                        </div>
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                            <input id="color" value="{{$article['article']->ispremium}}" {{$article['article']->ispremium?'checked':''}} type="checkbox">
                        </div>
                        <div>
                            <label for="page" class="block text-sm font-medium text-gray-700">Pages</label>
                            <input id="page" value="" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <button class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save Article</button>
                        <button class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                        <button class="px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" data-modal-target="large-modal1" data-modal-toggle="large-modal1">Add to </button>
                        <button class="px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Mail </button>
                        <button class="px-3 py-2 text-xs font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Qc </button>
                    </div>
                </div>
                <!-- Image Box -->
                <div class="border p-4 rounded-lg bg-white dark:bg-gray-700">
                    <img src="{{ 'https://myimpact.in/backup/'.$article['article']->imagedirectory.'/'. $article['article']->imagename[0]['imagename'] }}" alt="Article Image" class="w-full h-auto rounded-lg">
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image Path</label>
                <input id="image" value=" {{ $article['article']->htmldirectory . '/' . $article['article']->imagedirectory . '/' . $article['article']->imagename[0]['imagename'] }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="pagename" class="block text-sm font-medium text-gray-700">Page Name</label>
                <input id="pagename" value="{{$article['article']->pagename}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="page" class="block text-sm font-medium text-gray-700">Page</label>
                <input id="page" value="{{$article['article']->pagenumber[0]['pagenumber']}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="clip" class="block text-sm font-medium text-gray-700">Clip</label>
                <input id="clip" value="" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="user" class="block text-sm font-medium text-gray-700">User Name</label>
                <input id="user" value="{{$article['article']->userid}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                <input id="time" value="{{$article['article']->date_time_acquired}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="ave" class="block text-sm font-medium text-gray-700">AVE &#x20B9; </label>
                <input id="ave" value="{{$article['article']->ave}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="lastupdate" class="block text-sm font-medium text-gray-700">Last Update User Time </label>
                <input id="lastupdate" value="{{$article['article']->lastupdated}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div>
                <label for="fulltext" class="block text-sm font-medium text-gray-700">OCRed Text</label>
                <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

            </div>
        </div>

    </div>
</div>
<div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">

    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Keywords</h2>
    <div class="grid grid-cols-3">

        @foreach(array_chunk($article['keywords'], 10) as $chunk)
        <ul class="list-disc list-inside">
            @foreach($chunk as $keyword=>$key)

            <li>{{ $key }}</li>
            @endforeach
        </ul>

        @endforeach
    </div>

</div>
<div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Clients</h2>
    <div class="grid grid-cols-3">
        @foreach(array_chunk($article['clients'], 10) as $chunk)

        <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
            @foreach($chunk as $keyword => $key)
            <li>{{ $key['clientname'] }}</li>
            @endforeach
        </ul>
        @endforeach

    </div>
    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Delivery</label>
    <textarea id="message" rows="4" class="max-w-lg block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
</div>
</div>

</div>
<x-addtoclient />
@endsection

@section('scripts')
<script>
    $('#keyword').on('input', fetchResults);

    function fetchResults() {
        const keyword = $('#keyword').val().trim();
        const autocompleteList = $('#autocomplete-list');
        const resultsList = $('#results-list');
        if (keyword.length > 2) {
            $.ajax({
                url: '/api/keywordlist',
                method: 'GET',
                data: {
                    keyword: keyword
                },
                success: function(response) {
                    resultsList.empty(); // Clear previous results
                    if (response.length > 0) {
                        $.each(response, function(index, result) {
                            const li = $('<li>').text(result.KeyWord);

                            li.css('padding', '8px')
                            li.on('click', function() {
                                selectResult(result.KeyWord, result.keyID);
                            });
                            resultsList.append(li);
                        });
                        autocompleteList.show(); // Show autocomplete list
                    } else {
                        autocompleteList.hide(); // Hide autocomplete list if no results
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching results:', error);
                }
            });
        } else {
            autocompleteList.hide(); // Hide autocomplete list if keyword length is less than 3
        }
    }

    function selectResult(keyword, keyID) {
        $('#keyword').val(keyword);
        $('#keywordid').val(keyID);
        $('#autocomplete-list').hide();
        $.ajax({
            url: '/api/keywordClients',
            method: 'GET',
            data: {
                keyid: keyID
            },
            success: function(response) {

                if (response.length > 0) {
                    response.forEach(function(client) {
                        $('#clientsTable tbody').append(`
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4"><input type="checkbox" name="client[]" value="${client.ClientID}"></td>
                        <td class="px-6 py-4">${client.ClientID}</td>
                        <td class="px-6 py-4">${client.Name}</td>
                    </tr>
                `);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching filter strings:', error);
            }
        });
    }

    function saveArticle() {
        $('#error-messages div').empty();
        let keyid = $('#keywordid').val();
        let selectedClients = [];
        $('input[name="client[]"]:checked').each(function() {
            selectedClients.push($(this).val());
        });
        $.ajax({
            url: `{{route('keywords.saveArticle')}}`, 
            method: 'POST',
            data: {
                keyid: keyid,
                clientids :selectedClients,
                articleid: `{{$article['article']->articleid}}`,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
              if(response.success){
                window.location.reload();
              }
                if (response.errors) {
                    console.log(response.errors);
                        $.each(response.errors, function(key, value) {
                     
                     $('#' + key + '-error').text(value);
                 });
                    } 
            },
            error: function(error) {
                if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function(key, value) {
                     
                     $('#' + key + '-error').text(value);
                 });
                    } 
                console.error('Error fetching data:', error);
            }
        });
        

    }
</script>
@endsection