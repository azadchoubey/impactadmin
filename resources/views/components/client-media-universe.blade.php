<div >
<div class="flex flex-col items-center ">
<div class="flex space-x-4">
<label class="mb-2">Client id {{ $clientid}}</label>
<label >Client Prioriy</label>
<input type="checkbox" name="clientpriority" >
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
    selectableHeader: "<div class='header-wrapper'><input type='text' class='search-input small mb-2' autocomplete='off' placeholder='Search...'><button type='button' class='clear-btn'>&times;</button></div>",
    selectionHeader: "<div class='header-wrapper'><input type='text' class='search-input small mb-2' autocomplete='off' placeholder='Search...'><button type='button' class='clear-btn'>&times;</button></div>",
    afterInit: function(ms) {
        var that = this,
            $selectableSearch = that.$selectableUl.prev().find('.search-input'),
            $selectionSearch = that.$selectionUl.prev().find('.search-input'),
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

        // Add event listener for clear button
        $('.clear-btn').on('click', function(){
            var $input = $(this).prev('.search-input');
            $input.val('').trigger('keyup');
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
<style scoped>
    .small {
  width: 90%;
  height: 30px;
  font-size: 8pt;
  
   }
   .ms-container {
    font-family: verdana;
    width: 530px;
   }
   .ms-container .ms-selectable li.ms-elem-selectable, .ms-container .ms-selection li.ms-elem-selection {
    font-size: 8pt;
   }
</style>
@endsection
