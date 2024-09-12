<div class="flex items-center justify-center">
    <div class="grid grid-cols-2 gap-4 max-w-6xl">
        <div class="relative">
            <label for="select1" class="block text-sm font-medium text-gray-700">Concepts</label>
            <select multiple id="select1" class="h-48 mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm select2"></select>
            <button id="addOption1Btn" style="right: 4.25rem;" class="absolute top-1 px-2 py-1 bg-blue-500 text-white text-xs rounded-md flex items-center">
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
            <select multiple id="select2" class="h-48 mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm select2"></select>
            <button id="addOption2Btn" style="right: 4.25rem;" class="absolute top-1 px-2 py-1 bg-blue-500 text-white text-xs rounded-md flex items-center">
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
        <div class="col-span-2 flex justify-center mb-9">
            <button id="button1" class="bg-blue-500 px-2 py-1 text-white text-xs rounded-md">
                Define Complex Concepts
            </button>
        </div>
    </div>

    <!-- Add Option Modal -->
    <div id="addOptionModal" data-visible="false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="addOptionForm">
                <input type="hidden" name="datatype" id="data">
                <input type="hidden" name="clientid" value="{{$clientid}}">
                <div class="p-4 border-b">
                    <h5 id="header" class="text-lg font-medium"></h5>
                    <button type="button" class="addCancelBtn text-gray-500 hover:text-gray-700 float-right">×</button>
                </div>
                <div class="p-4">
                    <label for="newOptionText" class="block text-sm font-medium text-gray-700">Text</label>
                    <input type="text" name="option" id="newOptionText" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="p-4 border-t text-right">
                    <button type="button" class="addCancelBtn px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                    <button type="button" id="saveNewOptionBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Option Modal -->
    <div id="editOptionModal" data-visible="false" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="editOptionForm">

                <div class="p-4 border-b">
                    <h5 class="text-lg font-medium">Edit Option</h5>
                    <button type="button" class="editCancelBtn text-gray-500 hover:text-gray-700 float-right">×</button>
                </div>
                <div class="p-4">
                    <label for="editOptionText" class="block text-sm font-medium text-gray-700">Edit Option Text</label>
                    <input type="text" name="name" id="editOptionText" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <input type="hidden" name="conceptid" id="editconceptid">
                    <input type="hidden" name="keywordid" id="keywordid">
                    <input type="hidden" name="datatype" id="datatype">
                    <input type="hidden" name="clientid" value="{{$clientid}}">
                </div>
                <div class="p-4 border-t text-right">
                    <button type="button" class="editCancelBtn px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                    <button type="button" id="saveEditOptionBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
                </div>
                </form>
            </div>
    
    </div>
</div>
@section('scripts')
<script>
    $(document).ready(function() {
        $('#button1').click(function() {
            $('#button2').click();
        });
        const optionsData = @json($concepts);

        optionsData.forEach(option => {
            const newOption = new Option(option.name, option.id, false, false);
            $('#select1').append(newOption).trigger('change');
        });

        // Handle selection change on first select element
        $('#select1').on('change', function() {
            const selectedOptions = $(this).val();
            if (selectedOptions.length > 1) {
                alert("You can select only one option at a time.")
                $(this).find('option:selected').last().prop('selected', false);
            }
            fetchKeywords($(this).find('option:selected').val());

        });

        function fetchKeywords(selectedOptions) {
            if (selectedOptions) {
                $.ajax({
                    url: `{{route('displayKeywords')}}`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        selectedOptions: selectedOptions
                    },
                    success: function(response) {
                        updateSelect2(response);
                    }
                });
            }
        }

        function updateSelect2(keywords) {
            $('#select2').empty(); // Clear the select element

            $('#select2').append(keywords).trigger('change');
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
            $('#header').html('Add Concept');
            $('#data').val('concept');
            toggleModal('#addOptionModal', true);
        });
        $('#addOption2Btn').on('click', function() {
            const selectedOption = $('#select1').find('option:selected');
            if (selectedOption.length == 0) {
                alert('Please select a concept first');
                return;
            }
            $('#header').html('Add Keyword');
            $('#data').val('keyword');
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
            const form = $('#addOptionForm');
            const selectedValue = $('#select1').val();
            let formData = form.serialize();
            formData += '&username=' + encodeURIComponent('{{ Auth::user()->UserID }}') + '&concept_id=' + encodeURIComponent(selectedValue);
            $.ajax({
                url: `{{route('saveOption')}}`,
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert('Option saved successfully!');
                    form[0].reset();
                    if (response.concepts) {
                        response.concepts.forEach(function(concept) {
                            var newOption = new Option(concept.name, concept.id, false, false);
                            $('#select1').append(newOption);
                        });
                    } else {
                        response.keywords.forEach(function(keyword) {
                            var newOption = new Option(keyword.name, keyword.id, false, false);
                            $('#select2').append(newOption);
                        });
                    }

                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        displayValidationErrors(errors);
                    } else {
                        alert('An error occurred while saving the option.');
                    }
                }
            });
        });

        function displayValidationErrors(errors) {
            $('.validation-error').remove();
            $.each(errors, function(field, messages) {
                var input = $('input[name=' + field + ']');
                $.each(messages, function(index, message) {
                    input.after('<span class="validation-error text-red-500">' + message + '</span>');
                });
            });
        }
        $('#editOption1Btn, #editOption2Btn').on('click', function() {
            $('#datatype').val($(this).attr('id') === 'editOption1Btn' ? 'concept' : 'keyword')
        
            const targetSelect = $(this).attr('id') === 'editOption1Btn' ? '#select1' : '#select2';
            const selectedOption = $(targetSelect).find('option:selected');

            if (selectedOption.length > 0) {

                $('#editOptionText').val(selectedOption.text());
                $('#editOptionModal').data('targetSelect', targetSelect).data('selectedOption', selectedOption).removeClass('hidden').addClass('flex');
                if($('#datatype').val() == 'concept'){
                $('#editconceptid').val(selectedOption.val())

            }else{
                $('#editconceptid').val($('#select1').find('option:selected').val());
                console.log(selectedOption.val());
                
                $('#keywordid').val(selectedOption.val());
            }

            } else {
                alert('Please select an option to edit.');
            }
        });

        $('#saveEditOptionBtn').on('click', function() {
            const editedOptionText = $('#editOptionText').val().trim();
            if (editedOptionText) {
                const targetSelect = $('#editOptionModal').data('targetSelect');
                const selectedOption = $('#editOptionModal').data('selectedOption');
                const form = $('#editOptionForm');
                let formData = form.serialize();
                $.ajax({
                    url: `{{route('renameconcept')}}`,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                      
                        if(response.success){
                            alert('Option saved successfully!');
                            form[0].reset();
                            window.location.reload();
                        }
                       

                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            displayValidationErrors(errors);
                        } else {
                            alert('An error occurred while saving the option.');
                        }
                    }
                });
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