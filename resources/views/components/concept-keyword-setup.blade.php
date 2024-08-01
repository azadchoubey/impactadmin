<div class="flex items-center justify-center">
<div class="grid grid-cols-2 gap-4 w-3/4">
    <div class="relative">
        <label for="select1" class="block text-sm font-medium text-gray-700">Concepts</label>
        <select multiple id="select1" class="mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm select2"></select>
        <button id="addOption1Btn" style="right: 4.25rem;"  class="absolute top-1 px-2 py-1 bg-blue-500 text-white text-xs rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add
        </button>
        <button id="editOption1Btn" class="absolute top-1 right-2 px-2 py-1 bg-gray-500 text-white text-xs rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 5l3 3m-3-3v12m0-12l-4 4M7 7l-4 4m4-4v12m0-12l4 4" />
            </svg>
            Edit
        </button>
    </div>
    <div class="relative">
        <label for="select2" class="block text-sm font-medium text-gray-700">Keywords</label>
        <select multiple id="select2" class="mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm select2"></select>
        <button id="addOption2Btn" style="right: 4.25rem;"  class="absolute top-1  px-2 py-1 bg-blue-500 text-white text-xs rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add
        </button>
        <button id="editOption2Btn" class="absolute top-1 right-2 px-2 py-1 bg-gray-500 text-white text-xs rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 5l3 3m-3-3v12m0-12l-4 4M7 7l-4 4m4-4v12m0-12l4 4" />
            </svg>
            Edit
        </button>
    </div>
</div>



    <!-- Add Option Modal -->
    <div id="addOptionModal" data-visible="false"  class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b">
                <h5 class="text-lg font-medium">Add New Option</h5>
                <button type="button" class="addCancelBtn text-gray-500 hover:text-gray-700 float-right" >×</button>
            </div>
            <div class="p-4">
                <label for="newOptionText" class="block text-sm font-medium text-gray-700">New Option Text</label>
                <input type="text" id="newOptionText" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="p-4 border-t text-right">
                <button type="button" class="addCancelBtn px-4 py-2 bg-gray-500 text-white rounded-md" >Cancel</button>
                <button type="button" id="saveNewOptionBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
            </div>
        </div>
    </div>

    <!-- Edit Option Modal -->
    <div id="editOptionModal" data-visible="false"  class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b">
                <h5 class="text-lg font-medium">Edit Option</h5>
                <button type="button" class="editCancelBtn text-gray-500 hover:text-gray-700 float-right" >×</button>
            </div>
            <div class="p-4">
                <label for="editOptionText" class="block text-sm font-medium text-gray-700">Edit Option Text</label>
                <input type="text" id="editOptionText" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="p-4 border-t text-right">
                <button type="button" class="editCancelBtn px-4 py-2 bg-gray-500 text-white rounded-md" >Cancel</button>
                <button type="button" id="saveEditOptionBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
        $(document).ready(function() {
         
            const optionsData = ['Option 1', 'Option 2', 'Option 3'];
            optionsData.forEach(optionText => {
                const newOption = new Option(optionText, optionText, false, false);
                $('#select1').append(newOption).trigger('change');
            });

            // Handle selection change on first select element
            $('#select1').on('change', function() {
                const selectedOptions = $(this).val();
                if (selectedOptions.length > 1) {
                    alert("You can select only one option at a time.")
                    $(this).find('option:selected').last().prop('selected', false);
                    fetchKeywords($(this).find('option:selected').val());

                }
            });

            function fetchKeywords(selectedOptions) {
                if (selectedOptions) {
                    $.ajax({
                        url: '', // Update this route to your route
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            selectedOptions: selectedOptions
                        },
                        success: function(response) {
                            updateSelect2(response.keywords);
                        }
                    });
                }
            }

            function updateSelect2(keywords) {
                $('#select2').empty();
                if (keywords.length > 0) {
                    keywords.forEach(keyword => {
                        const newOption = new Option(keyword, keyword, false, false);
                        $('#select2').append(newOption).trigger('change');
                    });
                }
            }

            function toggleModal(modalId, visible) {
            const modal = $(modalId);
            if (visible) {
                modal.removeClass('hidden');
                modal.attr('data-visible', 'true');
            } else {
                modal.addClass('hidden');
                modal.attr('data-visible', 'false');
            }
        }

        // Open Add Modal
        $('#addOption1Btn').on('click', function() {
            toggleModal('#addOptionModal', true);
        });
        $('#addOption2Btn').on('click', function() {
            toggleModal('#addOptionModal', true);
        });

     

        // Close Add Modal
        $('.addCancelBtn').on('click', function() {
            toggleModal('#addOptionModal', false);
        });

        // Close Edit Modal
        $('.editCancelBtn').on('click', function() {
            toggleModal('#editOptionModal', false);
        });
            $('#saveNewOptionBtn').on('click', function() {
                const newOptionText = $('#newOptionText').val().trim();
                if (newOptionText) {
                    const targetSelect = $('#addOptionModal').data('targetSelect');
                    const newOption = new Option(newOptionText, newOptionText, false, false);
                    $(targetSelect).append(newOption).trigger('change');
                    toggleModal('#addOptionModal', false);
                }
            });

            // Edit option handling
            $('#editOption1Btn, #editOption2Btn').on('click', function() {
                const targetSelect = $(this).attr('id') === 'editOption1Btn' ? '#select1' : '#select2';
                const selectedOption = $(targetSelect).find('option:selected');
             
                if (selectedOption.length > 0) {
                    
                    $('#editOptionText').val(selectedOption.text());
                    $('#editOptionModal').data('targetSelect', targetSelect).data('selectedOption', selectedOption).removeClass('hidden').addClass('flex');
            
                    
                } else {
                    alert('Please select an option to edit.');
                }
            });

            $('#saveEditOptionBtn').on('click', function() {
                const editedOptionText = $('#editOptionText').val().trim();
                if (editedOptionText) {
                    const targetSelect = $('#editOptionModal').data('targetSelect');
                    const selectedOption = $('#editOptionModal').data('selectedOption');
                    selectedOption.text(editedOptionText).val(editedOptionText).trigger('change');
                    closeModal('editOptionModal');
                }
            });

            function closeModal(modalId) {
                console.log(modalId);
                $('#' + modalId).removeClass('flex').addClass('hidden');
            }
        });
    </script>
@endsection