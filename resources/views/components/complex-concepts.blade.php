<div class="complex-concepts-container container mx-auto p-2 rounded-lg space-y-8 mb-4">
    <!-- Section to display saved complex concepts -->
    <div id="saved-complex-concepts-box" class="box saved-complex-concepts bg-white border border-gray-300 rounded-lg p-2 shadow max-h-60 overflow-auto">
        <h3 class="text-sm font-semibold mb-4">Saved Complex Concepts</h3>
        <ul id="saved-complex-concepts-list" class="list-none p-0">
            <!-- Saved complex concepts will be appended here -->
        </ul>
    </div>

    <!-- Form to define complex concepts -->
    <div class="box define-complex-concepts bg-white border border-gray-300 rounded-lg p-2 shadow mb-4">
        <h3 class="text-sm font-semibold mb-4">Define Complex Concepts</h3>
        
        <!-- First Option Form -->
        <form id="form-occurrences" onsubmit="handleFormSubmit(event, 'occurrences')" class="space-y-6">
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
                
                <button type="submit" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>

        <!-- Third Option Form -->
        <form id="form-first-words" onsubmit="handleFormSubmit(event, 'first-words')" class="space-y-6">
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
        // Optionally, add code here to handle the deletion on the server side
    }

    function handleFormSubmit(event, formType) {
        event.preventDefault(); // Prevent the default form submission

        // Get the active form
        const form = event.target;

        // Collect form data based on the form type
        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => { data[key] = value; });

        // Create a new list item based on the form type with bold concept names
        let listItemContent = '';
        if (formType === 'occurrences') {
            listItemContent = `At least <strong>${data['occurrences1']}</strong> occurrences of the concept <strong>${data['concept1']}</strong>`;
        } else if (formType === 'within-words') {
            listItemContent = `Concept <strong>${data['concept2']}</strong> within <strong>${data['words1']}</strong> words of <strong>${data['concept3']}</strong>`;
        } else if (formType === 'first-words') {
            listItemContent = `Concept <strong>${data['concept4']}</strong> within first <strong>${data['words2']}</strong> words of the article`;
        }

        // Create a new list item element
        const newListItem = document.createElement('li');
        newListItem.className = 'text-sm flex justify-between items-center bg-gray-100 mb-2 p-2 border border-gray-200 rounded-md';
        newListItem.innerHTML = `
            ${listItemContent}
            <button type="button" class="delete-concept bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="deleteConcept(this)">Delete</button>
        `;

        // Append the new list item to the "Saved Complex Concepts" list
        document.getElementById('saved-complex-concepts-list').appendChild(newListItem);

        // Optionally, add code here to handle the data, e.g., send it to a server
    }
</script>
