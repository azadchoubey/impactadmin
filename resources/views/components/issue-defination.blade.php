<div class="container mx-auto p-4 max-w-xl">
    <div class="bg-white text-black border border-black p-4 rounded mb-4">
        <h2 class="text-lg font-semibold mb-2">Concept</h2>
        <div class="flex flex-wrap gap-2">
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Cera">Cera</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Filter">Filter</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Grohe">Grohe</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Hindware">Hindware</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="India">India</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Jaquar">Jaquar</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Kohler">Kohler</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Roca">Roca</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Roca - Not Filter">Roca - Not Filter</div>
            <div class="concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="Toto">Toto</div>
        </div>
    </div>

    <div class="bg-white text-black border border-black p-4 rounded mb-4">
        <h2 class="text-lg font-semibold mb-2">Complex Concepts</h2>
        <div class="flex flex-wrap gap-2">
            <div class="complex-concept-option bg-gray-200 text-black p-2 rounded cursor-pointer" data-value="At least 3 occurrences of concept 'Filter'">At least 3 occurrences of concept 'Filter'</div>
        </div>
    </div>

    <div class="text-center mb-4">
        <div class="inline-flex gap-2">
            <button class="logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="(">(</button>
            <button class="logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="and">and</button>
            <button class="logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="or">or</button>
            <button class="logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="not">not</button>
            <button class="logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value=")">)</button>
            <button class="logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="C">C</button>
        </div>
    </div>

    <div class="bg-white p-4 rounded mb-4">
        <textarea id="concept-input" class="w-full h-24 p-2 border border-gray-300 rounded" placeholder="Type your concept here..."></textarea>
    </div>

    <div class="flex flex-col items-center mb-4 space-y-4">
        <div class="flex items-center gap-4">
            <div class="flex items-center">Save above concept:</div>
            <input type="text" id="concept-name" class="border border-gray-300 rounded p-2" placeholder="Concept Name" />
            <div class="flex items-center">Color: <input type="color" id="concept-color" class="ml-2" /></div>
        </div>
        <div class="flex gap-4">
            <label class="flex items-center"><input type="radio" name="platform" value="web" /> Web</label>
            <label class="flex items-center"><input type="radio" name="platform" value="twitter" /> Twitter</label>
            <label class="flex items-center"><input type="radio" name="platform" value="both" /> Both</label>
        </div>
        <div class="flex gap-4">
            <label class="flex items-center"><input type="radio" name="companyType" value="myCompany" /> My Company</label>
            <label class="flex items-center"><input type="radio" name="companyType" value="competitor" /> My Competitor</label>
            <label class="flex items-center"><input type="radio" name="companyType" value="industry" /> My Industry</label>
            <label class="flex items-center"><input type="radio" name="companyType" value="others" /> Others</label>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center">Company Issue:</div>
            <select class="border border-gray-300 rounded p-2">
                <option value="">--company--</option>
                <!-- Add more options here -->
            </select>
            <div><a href="#" class="text-indigo-600 hover:text-indigo-800">Add New</a></div>
        </div>
    </div>

    <div class="text-center">
        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Save</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputBox = document.getElementById('concept-input');
        const conceptOptions = document.querySelectorAll('.concept-option');
        const complexConceptOptions = document.querySelectorAll('.complex-concept-option');
        const logicalOpButtons = document.querySelectorAll('.logical-op-button');

        let lastConcept = null;
        let lastComplexConcept = null;
        let lastLogicalOp = null;

        function updateInput(value) {
            if (value === "C") {
                inputBox.value = '';
                lastConcept = null;
                lastComplexConcept = null;
                lastLogicalOp = null;
                return;
            }
            
            // Update logic to ensure correct handling of permutations and combinations
            if (["(", ")"].includes(value)) {
                if (lastConcept || lastComplexConcept) {
                    inputBox.value += value + ' ';
                    lastLogicalOp = null;
                }
            } else if (["and", "or", "not"].includes(value)) {
                if (lastLogicalOp || !lastConcept && !lastComplexConcept) {
                    return; // Prevent multiple logical operators or invalid sequences
                }
                lastLogicalOp = value;
                inputBox.value += value + ' ';
            } else {
                if (lastConcept || lastComplexConcept) {
                    return; // Prevent multiple concepts or complex concepts
                }
                if (conceptOptions[0].contains(document.activeElement)) {
                    lastConcept = value;
                } else if (complexConceptOptions[0].contains(document.activeElement)) {
                    lastComplexConcept = value;
                }
                inputBox.value += value + ' ';
                lastLogicalOp = null; // Reset logical operator when a new concept is added
            }
        }

        function handleConceptClick(event) {
            if (lastConcept) return; // Prevent selecting multiple concepts
            conceptOptions.forEach(option => option.classList.remove('bg-gray-300'));
            event.target.classList.add('bg-gray-300');
            const value = event.target.getAttribute('data-value');
            updateInput(value);
        }

        function handleComplexConceptClick(event) {
            if (lastComplexConcept) return; // Prevent selecting multiple complex concepts
            complexConceptOptions.forEach(option => option.classList.remove('bg-gray-300'));
            event.target.classList.add('bg-gray-300');
            const value = event.target.getAttribute('data-value');
            updateInput(value);
        }

        function handleLogicalOpClick(event) {
            const value = event.target.getAttribute('data-value');
            updateInput(value);
        }

        conceptOptions.forEach(option => option.addEventListener('click', handleConceptClick));
        complexConceptOptions.forEach(option => option.addEventListener('click', handleComplexConceptClick));
        logicalOpButtons.forEach(button => button.addEventListener('click', handleLogicalOpClick));
    });
</script>
