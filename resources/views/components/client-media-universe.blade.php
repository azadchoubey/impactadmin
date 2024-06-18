<div style="background-color:white;">
    <div class="flex flex-col items-center ">
        <div class="flex space-x-4">
            <label>Client Prioriy</label>
            <input type="checkbox" name="clientpriority">
            <label>Restricted MU </label>
            <input type="checkbox" name="clientpriority">
        </div>

    </div>
    <div class="grid grid-cols-2 gap-8 place-items-center">


        <div class="flex flex-col items-center">
            <label class="mb-4">Language</label>
            <div class="flex space-x-4">
                <select id="languageSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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

        <div class="flex flex-col items-center">
            <label class="mb-4">Edition</label>
            <div class="flex space-x-4">
                <select id="editionSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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

        <div class="flex flex-col items-center">
            <label class="mb-4">Newspaper Categories</label>
            <div class="flex space-x-4">
                <select id="newspaperSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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

        <div class="flex flex-col items-center">
            <label class="mb-4">Magazine Categories</label>
            <div class="flex space-x-4">
                <select id="magazineSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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
    <div class="flex flex-col items-center mb-4 mt-3">
        <button type="button" id="applyFilterBtn" class="bg-blue-500 text-white p-2 rounded ml-2">Apply Filter</button>
    </div>
 
    <div class="grid grid-cols-2 gap-8 place-items-center">
<div class="flex flex-col items-center mb-4">
    <label class="mb-4">Newspaper</label>
            <div class="flex space-x-4">
                <select id="languageSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @foreach ($newspapers as $newspaper)
                    <option value="{{ $newspaper->PubId }}">{{ $newspaper->title }} ({{ $newspaper->ediPlace }})</option>
                    @endforeach
                </select>
                <div class="flex flex-col justify-center items-center gap-2">
                    <button id="moveRightLang" class="bg-blue-500 text-white p-1 rounded">&gt;</button>
                    <button id="moveLeftLang" class="bg-blue-500 text-white p-1 rounded">&lt;</button>
                </div>
                <select id="languageselection" class="multiple border p-2 rounded" multiple>
                    @forelse ($clientnewspaper as $clientnews)
                    <option selected value="{{ $clientnews->pubid }}">{{ $clientnews->title }} ({{ $clientnews->ediPlace }})</option>
                    @empty
                    <option selected value="-1">All</option>
                    @endforelse
                </select>
            </div>
    </div>
    
<div class="flex flex-col items-center mb-4">
    <label class="mb-4">Magazines</label>
            <div class="flex space-x-4">
                <select id="languageSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @foreach ($Magazines as $Magazine)
                    <option value="{{ $Magazine->pubid }}">{{ $Magazine->title }} ({{ $Magazine->ediPlace }})</option>
                    @endforeach
                </select>
                <div class="flex flex-col justify-center items-center gap-2">
                    <button id="moveRightLang" class="bg-blue-500 text-white p-1 rounded">&gt;</button>
                    <button id="moveLeftLang" class="bg-blue-500 text-white p-1 rounded">&lt;</button>
                </div>
                <select id="languageselection" class="multiple border p-2 rounded" multiple>
                    @forelse ($clientmagazines as $clientnews)
                    <option selected value="{{ $clientnews->pubid }}">{{ $clientnews->title }} ({{ $clientnews->ediPlace }})</option>
                    @empty
                    <option selected value="-1">All</option>
                    @endforelse
                </select>
            </div>
    </div>
</div>
    <hr>
    <div class="flex flex-col items-center mb-4">
        <h2>Comments</h2>
        <textarea id="default"></textarea>
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
    $(function() {
        function moveItems(origin, destination) {
            var hasAllOption = $(destination).find('option[value="-1"]').length > 0;
            $(origin).find('option:selected').each(function() {
                let mainSelect = $(destination).attr('id').includes('Select1');
    if ( mainSelect && hasAllOption ) { 
        if( $(this).val() != "-1"){
            $(this).remove().appendTo(destination);
        }    
        return; 
    } else {
        if(!mainSelect && $(this).val() == "-1"){

            console.log("mai" ,$(this));
            $(destination).empty(); 
            $(this).remove().appendTo(destination);
            return false; 
        }
        if( !hasAllOption && !mainSelect){
            console.log("ok" ,$(this));

            $(this).remove().appendTo(destination);

        }
        if( !hasAllOption && mainSelect){
            $(this).remove().appendTo(destination);

        }
    }

            });
            sortOptions(destination);
        }
        function sortOptions(selectElement) {
            var options = $(selectElement).find('option');
            options.sort(function(a, b) {
                if (a.text.toLowerCase() > b.text.toLowerCase()) return 1;
                if (a.text.toLowerCase() < b.text.toLowerCase()) return -1;
                return 0;
            });
            $(selectElement).empty().append(options); 
        }
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
</script>
@endsection
@section('style')
<style scoped>
    .multiple {
        width: 250px;
        font-size: 9pt;
    }
</style>
@endsection