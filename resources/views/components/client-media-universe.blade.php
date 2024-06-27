<div style="background-color:white;">
    <div class="flex flex-col items-center">
        <div class="flex space-x-4">
            <label class="block text-sm font-medium">Client Priority</label>
            <input type="checkbox" name="clientpriority" id="clientpriority" {{ $priority == 1 ? 'checked' : '' }}>
            <label class="block text-sm font-medium">Restricted MU</label>
            <input type="checkbox" name="restrictedmu" id="restrictedmu" {{ $restrictedmu == 1 ? 'checked' : '' }}>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-8 place-items-center">
        <div>
            <div class="flex flex-col items-center">
                <label class="mb-4 block text-sm font-medium">Language</label>
            </div>
            <div class="flex justify-between w-full">
            <div class="relative multiple mb-2">
                <input type="text" id="LanguageSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                <button id="clearLanguageSearch" class="absolute end-2.5 bottom-2.5 ">
                    x
                </button>
            </div>
            <div class="relative multiple mb-2 items-right">
                <input type="text" id="LanguageSelectionSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                <button id="clearLanguageSelectionSearch" class="absolute end-2.5 bottom-2.5 ">
                    x
                </button>
            </div>
            </div>
            <div class="flex space-x-4">
                <select id="languageSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                     @if (count($clientlang)>0)
                    <option  value="-1">All</option>   
                    @endif
                    @foreach ($Language as $lang)
                        <option value="{{ $lang->ID }}">{{ $lang->Name }}</option>
                    @endforeach
                   
                </select>
                <div class="flex flex-col justify-center items-center gap-2">
                    <button id="moveRightLang" class="bg-blue-500 text-white p-1 rounded">&gt;</button>
                    <button id="moveLeftLang" class="bg-blue-500 text-white p-1 rounded">&lt;</button>
                </div>
                
                <select id="languageselection" class="multiple border p-2 rounded" multiple>
                    @forelse ($clientlang as $lang)
                        <option selected value="{{ $lang->ID }}">{{ $lang->Name }}</option>
                    @empty
                        <option selected value="-1">All</option>
                    @endforelse
                </select>
            </div>
        
        </div>

        <div>
            <div class="flex flex-col items-center">
                <label class="mb-4 block text-sm font-medium">Edition</label>
            </div>
            <div class="flex justify-between w-full">
            <div class="relative multiple mb-2">
                <input type="text" id="EditionSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                <button id="clearEditionSearch" class="absolute end-2.5 bottom-2.5 ">
                    x
                </button>
            </div>
            <div class="relative multiple mb-2">
                <input type="text" id="EditionSelectionSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                <button id="clearEditionSelectionSearch" class="absolute end-2.5 bottom-2.5 ">
                    x
                </button>
            </div>
            </div>
            <div class="flex space-x-4">
                <select id="editionSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @if (count($clientedition)>0)
                    <option  value="-1">All</option>   
                    @endif
                    @foreach ($Edition as $lang)
                        <option value="{{ $lang->ID }}">{{ $lang->Name }}</option>
                    @endforeach
                   
                </select>
                <div class="flex flex-col justify-center items-center gap-2">
                    <button id="moveRightEdition" class="bg-blue-500 text-white p-1 rounded">&gt;</button>
                    <button id="moveLeftEdition" class="bg-blue-500 text-white p-1 rounded">&lt;</button>
                </div>
                <select id="editionselection" class="multiple border p-2 rounded" multiple>
                    @forelse ($clientedition as $lang)
                        <option selected value="{{ $lang->ID }}">{{ $lang->Name }}</option>
                    @empty
                        <option selected value="-1">All</option>
                    @endforelse
                </select>
            </div>
        </div>
        <div>
            <div class="flex flex-col items-center">
                <label class="mb-4 block text-sm font-medium">Newspaper Categories</label>
            </div>
            <div class="flex justify-between w-full">
                <div class="relative multiple mb-2">
                    <input type="text" id="NewspaperSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                    <button id="clearNewspaperSearch" class="absolute end-2.5 bottom-2.5 ">
                        x
                    </button>
                </div>
                <div class="relative multiple mb-2">
                    <input type="text" id="NewspaperSelectionSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                    <button id="clearNewspaperSelectionSearch" class="absolute end-2.5 bottom-2.5 ">
                        x
                    </button>
                </div>
            </div>

            <div class="flex space-x-4">
                <select id="newspaperSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @if (count($clientnewspapercat)>0)
                    <option value="-1">All</option>
                    @endif
                    @foreach ($Newspapercat as $lang)
                    <option value="{{ $lang->catid }}">{{ $lang->Category }}</option>
                    @endforeach
                </select>
                <div class="flex flex-col justify-center items-center gap-2">
                    <button id="moveRightNewspaper" class="bg-blue-500 text-white p-1 rounded">&gt;</button>
                    <button id="moveLeftNewspaper" class="bg-blue-500 text-white p-1 rounded">&lt;</button>
                </div>
                <select id="newspaperselection" class="multiple border p-2 rounded" multiple>
                    @forelse($clientnewspapercat as $lang)
                    <option selected value="{{ $lang->catid }}">{{ $lang->Category }}</option>
                    @empty
                    <option selected value="-1">All</option>
                    @endforelse
                </select>
            </div>
        </div>

        <div>
            <div class="flex flex-col items-center">
                <label class="mb-4 block text-sm font-medium">Magazine Categories</label>

            </div>
            <div class="flex justify-between w-full">
                <div class="relative multiple mb-2">
                    <input type="text" id="magazineSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search.. ">
                    <button id="clearMagazineSearch" class="absolute end-2.5 bottom-2.5 ">
                        x
                    </button>
                </div>
                <div class="relative multiple mb-2">
                    <input type="text" id="magazineSelectionSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                    <button id="clearMagazineSelectionSearch" class="absolute end-2.5 bottom-2.5 ">
                        x
                    </button>
                </div>
            </div>
            <div class="flex space-x-4">
                <select id="magazineSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @if (count($clientmagazinecat)>0)
                    <option value="-1">All</option>
                    @endif
                    @foreach ($Magazinecat as $lang)
                    <option value="{{ $lang->catid }}">{{ $lang->Category }}</option>
                    @endforeach
                </select>
                <div class="flex flex-col justify-center items-center gap-2">
                    <button id="moveRightMagazine" class="bg-blue-500 text-white p-1 rounded">&gt;</button>
                    <button id="moveLeftMagazine" class="bg-blue-500 text-white p-1 rounded">&lt;</button>
                </div>
                <select id="magazineselection" class="multiple border p-2 rounded" multiple>
                    @forelse ($clientmagazinecat as $lang)
                    <option selected value="{{ $lang->catid }}">{{ $lang->Category }}</option>
                    @empty
                    <option selected value="-1">All</option>

                    @endforelse
                </select>
            </div>
        </div>

    </div>
    <div class="flex flex-col items-center mb-4 mt-5">
        <button type="button" onclick="apply_filters('filter')" id="applyFilterBtn" class="bg-blue-500 text-white p-2 rounded ml-2">Apply Filter</button>
    </div>
    <div class="flex gap-2 items-center mb-4 mt-3">
        <label for="search" class="block text-sm font-medium">Search Exceptional Case </label>
        <input type="text" id="excpNewsMag" class="text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" />
        <label for="edition" class="block text-sm font-medium">Edition</label>
        <input type="radio" checked name="search" id="serach" value="edition">
        <label for="edition" class="block text-sm font-medium">Name</label>
        <input type="radio" name="search" id="serach" value="name">
        <button class="bg-blue-500 text-white p-2 rounded" onclick="searchExceptional()">Search</button>
    </div>
    <div class="grid grid-cols-2 gap-8 place-items-center">
        <div>
            <div class="flex flex-col items-center mb-4">
                <label class="mb-4 block text-sm font-medium">Newspaper</label>
            </div>
            <div class="flex justify-between w-full">
                <div class="relative multiple mb-2">
                    <input type="text" id="newspaperssSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search.. ">
                    <button id="clearNewspapersSearch" class="absolute end-2.5 bottom-2.5 ">
                        x
                    </button>
                </div>
                <div class="relative multiple mb-2">
                    <input type="text" id="newspaperssSelectionSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                    <button id="clearNewspapersSelectionSearch" class="absolute end-2.5 bottom-2.5 ">
                        x
                    </button>
                </div>
            </div>
            <div class="flex space-x-4">

                <select id="newspapersSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @foreach ($newspapers as $newspaper)
                    <option value="{{ $newspaper->PubId }}">{{ $newspaper->title }} ({{ $newspaper->ediPlace }})</option>
                    @endforeach
                </select>
                <div class="flex flex-col justify-center items-center gap-2">
                    <button id="moveRightnewspapers" class="bg-blue-500 text-white p-1 rounded">&gt;</button>
                    <button id="moveLeftnewspapers" class="bg-blue-500 text-white p-1 rounded">&lt;</button>
                </div>
                <select id="newspapersselection" class="multiple border p-2 rounded" multiple>
                    @forelse ($clientnewspaper as $clientnews)
                    <option class="{{in_array($clientnews->pubid ,$selectpubnews)?'bg-yellow-300':'bg-white-300'}}" selected value="{{ $clientnews->pubid }}">{{ $clientnews->title }} ({{ $clientnews->ediPlace }})</option>
                    @empty
                    <option selected value="-1">All</option>
                    @endforelse
                </select>
            </div>

        </div>
        <div>
            <div class="flex flex-col items-center mb-4">
                <label class="mb-4 block text-sm font-medium">Magazines</label>
            </div>
            <div class="flex justify-between w-full">
                <div class="relative multiple mb-2">
                    <input type="text" id="magazinesSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search.. ">
                    <button id="clearMagazinesSearch" class="absolute end-2.5 bottom-2.5 ">
                        x
                    </button>
                </div>
                <div class="relative multiple mb-2">
                    <input type="text" id="magazinesSelectionSearchInput" class="multiple text-xs rounded-sm focus:ring-blue-500 focus:border-blue-500 pl-2 pr-10" placeholder="Search..">
                    <button id="clearMagazinesSelectionSearch" class="absolute end-2.5 bottom-2.5 ">
                        x
                    </button>
                </div>
            </div>
            <div class="flex space-x-4">
                <select id="magazinesSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @foreach ($Magazines as $Magazine)
                    <option value="{{ $Magazine->pubid }}">{{ $Magazine->title }} ({{ $Magazine->ediPlace }})</option>
                    @endforeach
                </select>
                <div class="flex flex-col justify-center items-center gap-2">
                    <button id="moveRightmagazines" class="bg-blue-500 text-white p-1 rounded">&gt;</button>
                    <button id="moveLeftmagazines" class="bg-blue-500 text-white p-1 rounded">&lt;</button>
                </div>
                <select id="magazinesselection" class="multiple border p-2 rounded" multiple>
                    @forelse ($clientmagazines as $clientnews)
                    <option class="{{in_array($clientnews->pubid ,$selectpubnews)?'bg-yellow-300':''}}" selected value="{{ $clientnews->pubid }}">{{ $clientnews->title }} ({{ $clientnews->ediPlace }})</option>
                    @empty
                    <option selected value="-1">All</option>
                    @endforelse
                </select>
            </div>

        </div>
        <div class="flex flex-col items-center mb-4 mt-3">
            <button type="button" onclick="apply_filters('save')" id="SaveBtn" class="bg-blue-500 text-white p-2 rounded ml-2">Save</button>
        </div>
        <div class="flex gap-3 mb-4 mt-3 block text-sm font-medium">
            <a class="flex" href="{{route('downloadmediauniverse',['clid' => $clientid])}}"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 48 48">
                    <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path>
                    <path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path>
                    <path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path>
                    <path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                </svg>Export</a>
            <a class="flex" href="{{ route('clients.export') }}">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 48 48">
                    <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path>
                    <path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path>
                    <path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path>
                    <path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                </svg>
                Export Client Email
            </a>

            <a class="flex" href="{{ route('clients.exportDetails') }}">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 48 48">
                    <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path>
                    <path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path>
                    <path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path>
                    <path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                </svg>
                Client Master
            </a>
            <a class="flex" href="{{ route('clients.exportBrandStrings', ['clid' => $clientid]) }}">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 48 48">
                    <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path>
                    <path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path>
                    <path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path>
                    <path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                </svg>
                BrandString
            </a>
        </div>
    </div>
    <hr>
    <div class="flex flex-col items-center mb-4">
        <h2 class="block text-lg font-medium">Comments</h2>
        <textarea id="default"></textarea>
        <button id="add_comment" class="mt-2 bg-blue-500 text-white p-2 rounded ml-2">Add Comment</button>
        <table class="w-4/5	 table-auto border-collapse mt-4">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="px-1 py-1 border border-gray-300">Name</th>
                    <th class="px-1 py-1 border border-gray-300">Comment</th>
                    <th class="px-1 py-1 border border-gray-300">Created at</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                <tr id="hide-{{ $comment->id }}" class="bg-white hover:bg-gray-100">
                    <td class="px-1 py-1 border border-gray-300">{{ $comment->fullname }}</td>
                    <td class="px-1 py-1 border border-gray-300" id="afteredir-{{ $comment->id }}">{!! $comment->comment !!}</td>
                    <td class="px-1 py-1 border border-gray-300">{{ $comment->createddatetime }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 border border-gray-300 text-center">No comments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>

@section('scripts')
<script>
     function sortOptions(selectElement) {
           
           var options = $(selectElement).find('option');
           console.log(options);
           var emptyOption = options.filter(function() {        
            return this.value === "";
    });
    
    options = options.filter(function() {
        return this.value !== "";
    }).sort(function(a, b) {
        if (a.text.toLowerCase() > b.text.toLowerCase()) return 1;
        if (a.text.toLowerCase() < b.text.toLowerCase()) return -1;
        return 0;
    });
    
   $(selectElement).empty().append(options);
       }
    $(function() {
        $('#magazineSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('magazineSelect1'));
        });
        $('#magazinesSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('magazinesSelect1'));
        });
        $('#NewspaperSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('newspaperSelect1'));
        });
        $('#newspaperssSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('newspapersSelect1'));
        });
        $('#EditionSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('editionSelect1'));
        });
        $('#LanguageSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('languageSelect1'));
        });
        $('#LanguageSelectionSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('languageselection'));
        });
        $('#EditionSelectionSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('editionselection'));
        });
        $('#NewspaperSelectionSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('newspaperselection'));
        });
        $('#newspaperssSelectionSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('newspapersselection'));
        });
        $('#magazineSelectionSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('magazineselection'));
        });
        $('#magazinesSelectionSearchInput').on('input', function() {
            filterOptions(this, document.getElementById('magazinesselection'));
        });

        function moveItems(origin, destination) {
            var hasAllOption = $(destination).find('option[value="-1"]').length > 0;

            $(origin).find('option:selected').each(function() {
                var thiss = $(this);
                let mainSelect = $(destination).attr('id').includes('Select1');
                if (mainSelect && hasAllOption) {
                    if ($(this).val() != "-1") {
                        $(this).remove().appendTo(destination);
                    }
                    return;
                } else {
                    if (!mainSelect && $(this).val() == "-1") {
                        $(destination).empty();
                        $(this).remove().appendTo(destination);
                        return false;
                    }
                    if (!hasAllOption && !mainSelect) {
                        if ($(this).val() == "-8") {
                            var valuesToCheck = ["1", "232", "233", "156", "157", "450", "206", "531", "-6"];
                            var foundValues = $(destination).find('option').filter(function() {
                                return valuesToCheck.includes($(this).val());
                            }).remove();
                        }
                        if($(this).val() == "-6"){
                            var valuesToCheck = ["1", "232", "233", "156", "157", "450"];
                            var foundValues = $(destination).find('option').filter(function() {
                                return valuesToCheck.includes($(this).val());
                            }).remove();
                        }
                        $(this).remove().appendTo(destination);
                        
                       

                    }
                    if (!hasAllOption && mainSelect) {
                        $(this).remove().appendTo(destination);

                    }
                }

            });
            sortOptions(destination);
        }
        $('#clearMagazineSearch').on('click', function() {
            $('#magazineSearchInput').val('');
            filterOptions(document.getElementById('magazineSearchInput'), document.getElementById('magazineSelect1'));
        });
        $('#clearMagazinesSearch').on('click', function() {
            $('#magazinesSearchInput').val('');
            filterOptions(document.getElementById('magazinesSearchInput'), document.getElementById('magazinesSelect1'));
        });
        $('#clearNewspaperSearch').on('click', function() {
            $('#NewspaperSearchInput').val('');
            filterOptions(document.getElementById('NewspaperSearchInput'), document.getElementById('newspaperSelect1'));
        });
        $('#clearNewspapersSearch').on('click', function() {
            $('#newspaperssSearchInput').val('');
            filterOptions(document.getElementById('newspaperssSearchInput'), document.getElementById('newspapersSelect1'));
        });
        $('#clearEditionSearch').on('click', function() {
            $('#EditionSearchInput').val('');
            filterOptions(document.getElementById('EditionSearchInput'), document.getElementById('editionSelect1'));
        });
        $('#clearLanguageSearch').on('click', function() {
            $('#LanguageSearchInput').val('');
            filterOptions(document.getElementById('LanguageSearchInput'), document.getElementById('languageSelect1'));
        });
        $('#clearLanguageSelectionSearch').on('click', function() {
            $('#LanguageSelectionSearchInput').val('');
            filterOptions(document.getElementById('LanguageSelectionSearchInput'), document.getElementById('languageselection'));
        });
        $('#clearEditionSelectionSearch').on('click', function() {
            $('#EditionSelectionSearchInput').val('');
            filterOptions(document.getElementById('EditionSelectionSearchInput'), document.getElementById('editionselection'));
        });
        $('#clearNewspaperSelectionSearch').on('click', function() {
            $('#NewspaperSelectionSearchInput').val('');
            filterOptions(document.getElementById('NewspaperSelectionSearchInput'), document.getElementById('newspaperselection'));
        });
        $('#clearNewspapersSelectionSearch').on('click', function() {
            $('#newspaperssSelectionSearchInput').val('');
            filterOptions(document.getElementById('newspaperssSelectionSearchInput'), document.getElementById('newspapersselection'));
        });
        $('#clearMagazineSelectionSearch').on('click', function() {
            $('#magazineSelectionSearchInput').val('');
            filterOptions(document.getElementById('magazineSelectionSearchInput'), document.getElementById('magazineselection'));
        });
        $('#clearMagazinesSelectionSearch').on('click', function() {
            $('#magazinesSelectionSearchInput').val('');
            filterOptions(document.getElementById('magazinesSelectionSearchInput'), document.getElementById('magazinesselection'));
        });


        // Language Select
        $('#moveRightLang').click(function() {
            moveItems('#languageSelect1', '#languageselection');
        });
        $('#moveLeftLang').click(function() {
            moveItems('#languageselection', '#languageSelect1');
        });

        // Edition Select
        $('#moveRightEdition').click(function() {
            moveItems('#editionSelect1', '#editionselection');
        });
        $('#moveLeftEdition').click(function() {
            moveItems('#editionselection', '#editionSelect1');
        });

        // Newspaper Categories Select
        $('#moveRightNewspaper').click(function() {
            moveItems('#newspaperSelect1', '#newspaperselection');
        });
        $('#moveLeftNewspaper').click(function() {
            moveItems('#newspaperselection', '#newspaperSelect1');
        });

        // Magazine Categories Select
        $('#moveRightMagazine').click(function() {
            moveItems('#magazineSelect1', '#magazineselection');
        });
        $('#moveLeftMagazine').click(function() {
            moveItems('#magazineselection', '#magazineSelect1');
        });
        // Magazine  Select
        $('#moveRightmagazines').click(function() {
            moveItems('#magazinesSelect1', '#magazinesselection');
        });
        $('#moveLeftmagazines').click(function() {
            moveItems('#magazinesselection', '#magazinesSelect1');
        });
        // Newspaper  Select
        $('#moveRightnewspapers').click(function() {
            moveItems('#newspapersSelect1', '#newspapersselection');
        });
        $('#moveLeftNewspapers').click(function() {
            moveItems('#newspapersselection', '#newspapersSelect1');
        });


        $('#default').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });



    });

    function filterOptions(input, select) {
        var filter = input.value.toLowerCase();
        var options = select.options;
        for (var i = 0; i < options.length; i++) {
            if (options[i].value === "") continue;
            var text = options[i].text.toLowerCase();
            var isVisible = text.includes(filter);
            options[i].style.display = isVisible ? '' : 'none';
        }
    }

    function searchExceptional() {

        var newsPaperSelectedOpts = $('#newspapersselection option');
        var magzineSelectedOpts = $('#magazinesselection option');
        var newsPaper = $.map($(newsPaperSelectedOpts), function(e) {
            return e.value;
        });
        var magzine = $.map($(magzineSelectedOpts), function(e) {
            return e.value;
        });
        var newsNMag = $('#excpNewsMag').val();
        var searchCriteria = $('input[name=search]:checked').val();

        if (newsNMag == '') {
            alert("Search box is blank!");
            return false;
        }
        document.getElementById('processModal').classList.remove('hidden');
        jQuery.post("{{route('searchexceptional')}}", {
            newsNMag: newsNMag,
            newsPaper: newsPaper,
            magzine: magzine,
            searchCriteria: searchCriteria
        }, function(response) {
            document.getElementById('processModal').classList.add('hidden');
            var AjaxresultArr = response;
            var newsPaperdata = AjaxresultArr.news;
            var magazinedata = AjaxresultArr.magazine;
            document.getElementById('newspapersSelect1').innerHTML = newsPaperdata;
            document.getElementById('magazinesSelect1').innerHTML = magazinedata;

        });
    }

    function apply_filters(condition) {

        var mainPaper = false;
        var languageSelectedOpts = $('#languageselection option');
        var newspapercatSelectedOpts = $('#newspaperselection option');
        var magazinecatSelectedOpts = $('#magazineselection option');
        var editionSelectedOpts = $('#editionselection option');
        var newsPaperSelectedOpts = $('#newspapersselection option');
        var magzineSelectedOpts = $('#magazinesselection option');
        var lang = $.map($(languageSelectedOpts), function(e) {
            return e.value;
        });
        var editions = $.map($(editionSelectedOpts), function(e) {
            return e.value;
        });
        var newscat = $.map($(newspapercatSelectedOpts), function(e) {
            return e.value;
        });
        var magcat = $.map($(magazinecatSelectedOpts), function(e) {
            return e.value;
        });
        var newsPaper = $.map($(newsPaperSelectedOpts), function(e) {
            return e.value;
        });
        var magzine = $.map($(magzineSelectedOpts), function(e) {
            return e.value;
        });
        //for save record
        if (condition == 'save') {
            document.getElementById('processModal').classList.remove('hidden');

            setTimeout(function() {
                jQuery.ajax({
                    type: "POST",
                    url: "{{route('saveselecteddata')}}",
                    data: "language=" + lang + "&edition=" + editions + "&newspapercat=" + newscat + "&magzinecat=" + magcat + "&newsPaper=" + newsPaper + "&magzine=" + magzine + "&clientid=" + "{{$clientid}}" + "&user={{auth()->user()->UserID}}",
                    success: function(response) {
                        alert("saved successfully");
                        setTimeout(function() {
                            document.getElementById('processModal').classList.add('hidden');
                        }, 1000);
                        // for loader end
                        if (response.status == 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(error) {
                        alert("Error" + eval(error));
                    }
                });
            }, 100);
        } else {
            if (lang == '') {
                alert("Languege Box are empty!");
                return false;
            }
            if (editions == '') {
                alert("Edition Box are empty!");
                return false;
            }
            if (newscat == '' && magcat == '') {
                alert("Newspaper or Magazine Categories Box are empty!");
                return false;
            }
            document.getElementById('processModal').classList.remove('hidden');
            jQuery.ajax({
                type: "POST",
                url: "{{route('filter')}}",
                data: "language=" + lang + "&edition=" + editions + "&newspapercat=" + newscat + "&magzinecat=" + magcat + "&mainPaper=" + mainPaper + "&clientid=" + "{{$clientid}}",

                success: function(response) {
                    setTimeout(function() {
                        document.getElementById('processModal').classList.add('hidden');
                    }, 1000);
                    var AjaxresultArr = response;
                    var newsPaperdata = AjaxresultArr.news;
                    var magazinedata = AjaxresultArr.magazine;
                    var newsPaperdataAll = AjaxresultArr.newsAll;
                    var magazinedataAll = AjaxresultArr.magazineAll;
                    document.getElementById('newspapersSelect1').innerHTML = newsPaperdataAll;
                    document.getElementById('magazinesSelect1').innerHTML = magazinedataAll;
                    document.getElementById('newspapersselection').innerHTML = newsPaperdata;
                    document.getElementById('magazinesselection').innerHTML = magazinedata;
                }
            });
        }

        return false;
    }
    $(document).ready(function() {
        sortOptions('languageSelect1');
        sortOptions('editionSelect1');
        sortOptions('newspaperSelect1');
        sortOptions('magazineSelect1');

        $('#add_comment').click(function(e) {
            e.preventDefault();
            var comment = $('#default').val();
            var clientid = '{{ $clientid }}';
            var csrfToken = '{{csrf_token()}}';
            jQuery.ajax({
                type: "POST",
                url: "{{route('addcomment')}}",
                async: false,
                cache: false,
                data: {
                    addcomment: comment,
                    clientid: clientid,
                    _token: csrfToken
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    });
</script>
@endsection
@section('style')
<style scoped>
    .multiple {
        width: 280px;
        font-size: 9pt;
    }

    .flex a:hover {
        color: blue;
    }

    select:not([size]) {
        background-image: none;
    }
</style>
@endsection