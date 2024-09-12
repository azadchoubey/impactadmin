<div class="complex-concepts-container container mx-auto p-2 rounded-lg space-y-8 mb-4 max-w-6xl">
    <!-- Section to display saved complex concepts -->
    <div id="saved-complex-concepts-box" class="box saved-complex-concepts bg-white border border-gray-300 rounded-lg p-2 shadow max-h-60 overflow-auto">
        <h3 class="text-sm font-semibold mb-4">Saved Complex Concepts</h3>
        <ul id="saved-complex-concepts-list" class="list-none p-0">
            <!-- Example complex concept item -->
            <li class="text-sm flex justify-between items-center bg-gray-100 mb-2 p-2 border border-gray-200 rounded-md">
                <span class="concept-name">Example Concept</span>
                <div>
                    <button type="button" class="edit-concept bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600" onclick="editConcept(this)">Edit</button>
                    <button type="button" class="delete-concept bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="deleteConcept(this)">Delete</button>
                </div>
            </li>
        </ul>
    </div>

    <!-- Form to define complex concepts -->
    <div class="box define-complex-concepts bg-white border border-gray-300 rounded-lg p-2 shadow mb-4">
        <h3 class="text-sm font-semibold mb-4">Define Complex Concepts</h3>

        <!-- First Option Form -->
        <form class="space-y-6">
            <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="occurrences1" class="mr-2 text-sm">At least</label>
                <input type="number" id="occurrences1" name="occurrences1" min="1" required class="flex-1 text-xs min-w-40 border border-gray-300 rounded">
                
                <label for="concept1" class="ml-2 mr-2 text-sm">occurrences of the concept</label>
                <select id="concept1" name="concept1" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                </select>

                <button type="submit" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>

        <!-- Second Option Form -->
        <form class="space-y-6">
            <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="concept2" class="mr-2 text-sm">Concept 1</label>
                <select id="concept2" name="concept2" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                </select>

                <label for="words1" class="ml-2 mr-2 text-sm">within</label>
                <input type="number" id="words1" name="words1" min="1" required class="flex-1 text-xs min-w-40 border border-gray-300 rounded">

                <label for="concept3" class="ml-2 mr-2 text-sm">words of Concept 2</label>
                <select id="concept3" name="concept3" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                </select>

                <button type="submit" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>

        <!-- Third Option Form -->
        <form class="space-y-6">
            <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="concept4" class="mr-2 text-sm">Concept</label>
                <select id="concept4" name="concept4" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                </select>

                <label for="words2" class="ml-2 mr-2 text-sm">within first</label>
                <input type="number" id="words2" name="words2" min="1" required class="flex-1 text-xs min-w-40 border border-gray-300 rounded">

                <label for="words2" class="ml-2 text-sm">words of the article</label>

                <button type="submit" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript to handle form submission and delete functionality -->
<script>
    function editConcept(button) {
        const listItem = button.closest('li');
        const conceptNameSpan = listItem.querySelector('.concept-name');
        const currentName = conceptNameSpan.textContent;

        // Replace the span with an input field
        const inputField = document.createElement('input');
        inputField.type = 'text';
        inputField.value = currentName;
        inputField.className = 'edit-input text-sm w-4/5 p-1 border border-gray-300 rounded';
        listItem.replaceChild(inputField, conceptNameSpan);

        // Change the Edit button to Save
        button.textContent = 'Save';
        button.classList.remove('bg-blue-500', 'hover:bg-blue-600');
        button.classList.add('bg-green-500', 'hover:bg-green-600');
        button.setAttribute('onclick', 'saveConcept(this)');
    }

    function saveConcept(button) {
        const listItem = button.closest('li');
        const inputField = listItem.querySelector('.edit-input');
        const newName = inputField.value.trim();

        if (newName === '') {
            alert('Concept name cannot be empty.');
            return;
        }

        // Replace the input field with a span
        const span = document.createElement('span');
        span.className = 'concept-name';
        span.textContent = newName;
        listItem.replaceChild(span, inputField);

        // Change the Save button back to Edit
        button.textContent = 'Edit';
        button.classList.remove('bg-green-500', 'hover:bg-green-600');
        button.classList.add('bg-blue-500', 'hover:bg-blue-600');
        button.setAttribute('onclick', 'editConcept(this)');
    }

    function deleteConcept(button) {
        const listItem = button.closest('li');
        if (confirm('Are you sure you want to delete this concept?')) {
            listItem.remove();
        }
    }
</script>
