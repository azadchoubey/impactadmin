<div >
<div class="flex flex-col items-left ">
<div class="flex space-x-4">
<label class="mb-2">Client id {{ $clientid}}</label>
</div>
<div class="flex space-x-4">
<label >Client Prioriy</label>
<input type="checkbox" name="clientpriority" >
</div>
<div class="flex space-x-4">
<label>Restricted MU	</label>
<input type="checkbox" name="clientpriority" >
</div>
</div>  
<div class="grid grid-cols-2 gap-8 place-items-center">


    <div class="flex flex-col items-center">
        <label class="mb-2">Language</label>
        <div class="flex space-x-4">
            <select id="languageSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option selected value="-1">All</option>
                 @foreach ($clientlang as $lang)
                <option selected value="{{ $lang->ID }}">{{ $lang->Name }}</option>
                @endforeach
                @foreach ($Language as $lang)
                    <option value="{{ $lang->ID }}">{{ $lang->Name }}</option>
                @endforeach
            </select>
           
        </div>
    </div>

    <div class="flex flex-col items-center">
        <label class="mb-2">Edition</label>
        <div class="flex space-x-4">
            <select id="editionSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option selected value="-1">All</option>
                @foreach ($clientedition as $lang)
                    <option selected value="{{ $lang->ID }}">{{ $lang->Name }}</option>
                @endforeach   
            @foreach ($Edition as $lang)
                    <option value="{{ $lang->ID }}">{{ $lang->Name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex flex-col items-center">
        <label class="mb-2">Newspaper Categories</label>
        <div class="flex space-x-4">
            <select id="newspaperSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option selected value="-1">All</option>
                @foreach ($clientnewspapercat as $lang)
                    <option selected value="{{ $lang->catid }}">{{ $lang->Category }}</option>
                @endforeach 
            @foreach ($Newspapercat as $lang)
                    <option value="{{ $lang->catid }}">{{ $lang->Category }}</option>
                @endforeach
            </select>
            
        </div>
    </div>

    <div class="flex flex-col items-center">
        <label class="mb-2">Magazine Categories</label>
        <div class="flex space-x-4">
            <select id="magazineSelect1" multiple class="multiple w-48 h-48 p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option selected value="-1">All</option>
                @foreach ($clientmagazinecat as $lang)
                    <option selected value="{{ $lang->catid }}">{{ $lang->Category }}</option>
                @endforeach   
            @foreach ($Magazinecat as $lang)
                    <option value="{{ $lang->catid }}">{{ $lang->Category }}</option>
                @endforeach
            </select>
        </div>
    </div>
   
</div>
<div class="flex flex-col items-center mb-4">
        <button type="button" id="applyFilterBtn" class="bg-blue-500 text-white p-2 rounded ml-2">Apply Filter</button>
    </div>
    <hr>
    <div class="flex flex-col items-center mb-4">
    <h2 >Comments</h2>
    <textarea id="default">Hello
        
    </textarea>
    <table class="w-4/5	 table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200">
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
        $('.multiple').multiSelect({
            dblClick: true,
            selectableHeader: "<input type='text' class='search-input small' autocomplete='off' placeholder='Search...'>",
            selectionHeader: "<input type='text' class='search-input small' autocomplete='off' placeholder='Search...'>",
            afterInit: function(ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function() {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function() {
                this.qs1.cache();
                this.qs2.cache();
            }
        });
     
        tinymce.init({
  selector: 'textarea#default',
  license_key: 'gpl'
});
    });
</script>
@endsection
@section('style')
<style>
    .small {
  width: 100px;
  height: 30px;
  font-size: 14px; }
</style>
@endsection
