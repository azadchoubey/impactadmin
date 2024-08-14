<div class="complex-concepts-container container mx-auto p-2 rounded-lg space-y-8 mb-4 max-w-6xl">
    <!-- Section to display saved complex concepts -->
    <div id="saved-complex-concepts-box" class="box saved-complex-concepts bg-white border border-gray-300 rounded-lg p-2 shadow max-h-60 overflow-auto">
        <h3 class="text-sm font-semibold mb-4">Saved Complex Concepts</h3>
        <ul id="saved-complex-concepts-list" class="list-none p-0">
                @foreach ($complexconcepts as $complexconcept)
                <li data-id="{{ $complexconcept->id }}" class="text-sm flex justify-between items-center bg-gray-100 mb-2 p-2 border border-gray-200 rounded-md">
                <span class="concept-name">{{$complexconcept->name}}</span>
                <div>
                <button type="button" class="edit-concept bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600" onclick="editConcept(this)">Edit</button>

                <button type="button" class="delete-concept bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="deleteConcept(this)">Delete</button>
                </div>
            </li>

                @endforeach
        </ul>
    </div>

    <!-- Form to define complex concepts -->
    <div class="box define-complex-concepts bg-white border border-gray-300 rounded-lg p-2 shadow mb-4">
        <h3 class="text-sm font-semibold mb-4">Define Complex Concepts</h3>
        
        <!-- First Option Form -->
        <form id="form-occurrences" onsubmit="handleFormSubmit(event, 'occurrences')" class="space-y-6">
            <input type="hidden" name="clientid" value="{{$clientid}}">
            <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="occurrences1" class="mr-2 text-sm">At least</label>
                <input type="number" id="occurrences1" name="occurrences1" min="1" required class="flex-1 text-xs min-w-40 border border-gray-300 rounded">
                
                <label for="concept1" class="ml-2 mr-2 text-sm">occurrences of the concept</label>
                <select id="concept1" name="concept1" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                    <!-- Options here -->
                </select>
                
                <button type="submit" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>

        <!-- Second Option Form -->
        <form id="form-within-words" onsubmit="handleFormSubmit(event, 'within-words')" class="space-y-6">
        <input type="hidden" name="clientid" value="{{$clientid}}">

        <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="concept2" class="mr-2 text-sm">Concept 1</label>
                <select id="concept2" name="concept2" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                    <!-- Options here -->
                </select>
                
                <label for="words1" class="ml-2 mr-2 text-sm">within</label>
                <input type="number" id="words1" name="words1" min="1" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                
                <label for="concept3" class="ml-2 mr-2 text-sm">words of Concept 2</label>
                <select id="concept3" name="concept3" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                    <!-- Options here -->
                </select>
                <div id="error-message" class="ml-2 text-red-500 text-xs mt-2" style="display: none;"></div>

                <button id="submit-button" type="submit" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>

        <!-- Third Option Form -->
        <form id="form-first-words" onsubmit="handleFormSubmit(event, 'first-words')" class="space-y-6">
        <input type="hidden" name="clientid" value="{{$clientid}}">

        <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="concept4" class="mr-2 text-sm">Concept</label>
                <select id="concept4" name="concept4" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                    <!-- Options here -->
                </select>
                
                <label for="words2" class="ml-2 mr-2 text-sm">within first</label>
                <input type="number" id="words2" name="words2" min="1" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                
                <label for="words2" class="ml-2 text-sm">words of the article</label>
                
                <button type="submit" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript to handle form submission and delete functionality -->
<script>

    function deleteConcept(button) {
        const listItem = button.parentElement;
        listItem.remove();
    }

    function handleFormSubmit(event, formType) {
        event.preventDefault();
        const form = event.target;

        const formData = new FormData(form);
        
        const data = {};
    $(form).find('select').each(function() {
    const key = $(this).attr('name');
    const value = $(this).val();
    const text = $(this).find('option:selected').text();
    data[key] = { value, text };
});


formData.forEach((value, key) => {
    if (!data[key]) { 
        data[key] = value;
    }
});
    document.getElementById('processModal').classList.remove('hidden');
       
        $.ajax({
        url: `{{route('add-complex-concepts')}}`,
        type: 'POST',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            document.getElementById('processModal').classList.add('hidden');
            if (response.success) {
                alert(response.success); 
            }else{
                alert(response.error); 
            }    
            window.location.reload();

        },
        error: function(xhr, status, error) {
            console.error('Error adding complex concept:', error);
        }
    });
    }
    function editConcept(button) {
    const listItem = $(button).closest('li');
    const conceptNameSpan = listItem.find('.concept-name');
    const currentName = conceptNameSpan.text();

    // Replace the span with an input field
    const inputField = `<input type="text" class="edit-input text-sm w-4/5	 p-1 border border-gray-300 rounded" value="${currentName}" />`;
    conceptNameSpan.replaceWith(inputField);

    // Change the Edit button to Save
    $(button).text('Save').removeClass('bg-blue-500 hover:bg-blue-600').addClass('bg-green-500 hover:bg-green-600');
    $(button).attr('onclick', 'saveConcept(this)');
}

function saveConcept(button) {

    const listItem = $(button).closest('li');
    const inputField = listItem.find('.edit-input');
    const newName = inputField.val();

    // Validation: Check if the new name is not empty
    if (newName.trim() === '') {
        alert('Concept name cannot be empty.');
        return;
    }
    document.getElementById('processModal').classList.remove('hidden');

    $.ajax({
        url: `{{route('updateComplexConcepts')}}`,
        method: 'POST',
        data: {
            id: listItem.data('id'),
            name: newName,
            clientid:`{{$clientid}}`,
            _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token if needed
        },
        success: function(response) {
            document.getElementById('processModal').classList.add('hidden');
            if (response.success) {
                alert(response.success);
                window.location.reload();
            } else {
                alert('Failed to update the concept. Please try again.');
            }
        },
        error: function() {
            alert('An error occurred. Please try again.');
        }
    });
}
function deleteConcept(button) {
    const listItem = $(button).closest('li');
    const conceptId = listItem.data('id'); // Retrieve the concept ID from the data-id attribute

    if (confirm('Are you sure you want to delete this concept?')) {
        $.ajax({
            url: `{{route('deleteConcept')}}`,
            method: 'DELETE', 
            data: {
                concept_id: conceptId,
                clientid:`{{$clientid}}`,
                _token: $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response) {
                if (response.success) {
                    listItem.remove();
                    alert(response.success);
                    window.location.reload();
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Failed to delete the concept.');
            }
        });
    }
}

</script>
