<div class="complex-concepts-container container mx-auto p-2 rounded-lg space-y-8 mb-4 max-w-6xl">
    <!-- Section to display saved complex concepts -->
    <div id="saved-complex-concepts-box" class="box saved-complex-concepts bg-white border border-gray-300 rounded-lg p-2 shadow max-h-60 overflow-auto">
        <h3 class="text-sm font-semibold mb-4">Saved Complex Concepts</h3>
        <ul id="saved-complex-concepts-list" class="list-none p-0">
        @foreach ($complexprintconcepts as $complexconcept)
                <li data-id="{{ $complexconcept->id }}" class="text-sm flex justify-between items-center bg-gray-100 mb-2 p-2 border border-gray-200 rounded-md">
                <span class="concept-name1">{{$complexconcept->name}}</span>
                <div>
                <button type="button" class="edit-concept bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600" onclick="editConcept1(this)">Edit</button>

                <button type="button" class="delete-concept bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600" onclick="deleteConcept1(this)">Delete</button>
                </div>
            </li>

        @endforeach
        </ul>
    </div>

    <!-- Form to define complex concepts -->
    <div class="box define-complex-concepts bg-white border border-gray-300 rounded-lg p-2 shadow mb-4">
        <h3 class="text-sm font-semibold mb-4">Define Complex Concepts</h3>

        <!-- First Option Form -->
        <form class="space-y-6" id="form-occurrences1" onsubmit="handleFormSubmit1(event, 'occurrences')" >
        <input type="hidden" name="clientid" value="{{$clientid}}">
            <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="occurrences1" class="mr-2 text-sm">At least</label>
                <input type="number" id="occurrences1" name="occurrences1" min="1" required class="flex-1 text-xs min-w-40 border border-gray-300 rounded">

                <label for="concept_1" class="ml-2 mr-2 text-sm">occurrences of the concept</label>
                <select id="concept_1" name="concept1" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                </select>

                <button type="submit"  onclick="handleFormSubmit1(event, 'occurrences')" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>

        <!-- Second Option Form -->
        <form class="space-y-6" id="form-within-words1" onsubmit="handleFormSubmit1(event, 'within-words')" >
        <input type="hidden" name="clientid" value="{{$clientid}}">

        <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="concept_2" class="mr-2 text-sm">Concept 1</label>
                <select id="concept_2" name="concept2" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                </select>

                <label for="words1" class="ml-2 mr-2 text-sm">within</label>
                <input type="number" id="words1" name="words1" min="1" required class="flex-1 text-xs min-w-40 border border-gray-300 rounded">

                <label for="concept_3" class="ml-2 mr-2 text-sm">words of Concept 2</label>
                <select id="concept_3" name="concept3" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                </select>
                <div id="error-message" class="ml-2 text-red-500 text-xs mt-2" style="display: none;"></div>

                <button type="submit" onclick="handleFormSubmit1(event, 'within-words')" class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>

        <!-- Third Option Form -->
        <form class="space-y-6"  id="form-first-words1" onsubmit="handleFormSubmit1(event, 'first-words')" >
        <input type="hidden" name="clientid" value="{{$clientid}}">

        <div class="complex-concept-row flex flex-wrap items-center mb-4">
                <label for="concept_4" class="mr-2 text-sm">Concept</label>
                <select id="concept_4" name="concept4" required class="flex-1 text-xs min-w-40 p-2 border border-gray-300 rounded">
                    <option value="" disabled selected>--concepts--</option>
                </select>

                <label for="words2" class="ml-2 mr-2 text-sm">within first</label>
                <input type="number" id="words2" name="words2" min="1" required class="flex-1 text-xs min-w-40 border border-gray-300 rounded">

                <label for="words2" class="ml-2 text-sm">words of the article</label>

                <button type="submit" onclick="handleFormSubmit1(event, 'first-words')"  class="text-sm ml-4 py-1 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">OK</button>
                <button type="reset" class="text-sm ml-2 py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</button>
            </div>
        </form>
    </div>
</div>
