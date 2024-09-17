<div class="container mx-auto p-4 max-w-6xl">
    <div class="bg-white text-black border border-black p-4 rounded mb-4">
        <h2 class="text-sm font-semibold mb-2">Concept</h2>
        <div class="flex flex-wrap gap-2">
            <div class="text-sm concept-option bg-gray-200 text-black p-2 rounded cursor-pointer">Concept 1</div>
            <div class="text-sm concept-option bg-gray-200 text-black p-2 rounded cursor-pointer">Concept 2</div>
            <div class="text-sm concept-option bg-gray-200 text-black p-2 rounded cursor-pointer">Concept 3</div>
        </div>
    </div>

    <div class="bg-white text-black border border-black p-4 rounded mb-4">
        <h2 class="text-sm font-semibold mb-2">Complex Concepts</h2>
        <div class="flex flex-wrap gap-2">
            <div class="text-sm complex-concept-option bg-gray-200 text-black p-2 rounded cursor-pointer">Complex Concept 1</div>
            <div class="text-sm complex-concept-option bg-gray-200 text-black p-2 rounded cursor-pointer">Complex Concept 2</div>
        </div>
    </div>

    <div class="text-center mb-4">
        <div class="inline-flex gap-2">
            <button class="text-sm logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">(</button>
            <button class="text-sm logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">and</button>
            <button class="text-sm logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">or</button>
            <button class="text-sm logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">not</button>
            <button class="text-sm logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">)</button>
            <button class="text-sm logical-op-button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">C</button>
        </div>
    </div>

    <form id="issueadd">
        <div class="bg-white p-4 rounded mb-4">
            <textarea id="concept-input" name="concept_conditions" class="w-full text-sm h-24 p-2 border border-gray-300 rounded" placeholder="Type your concept here..."></textarea>
        </div>
        <div class="flex flex-col items-center mb-4 space-y-4">
            <div class="flex items-center gap-4 text-sm">
                <div class="flex items-center">Save above concept:</div>
                <input type="text" id="issue" name="issue" class="text-sm border border-gray-300 rounded p-1" placeholder="Concept Name" />
                <div class="flex items-center">Color: <input type="color" name="issue_color" id="concept-color" class="text-sm ml-2" /></div>
            </div>
            <div class="flex gap-4">
                <label class="flex items-center text-sm gap-2 "><input type="radio" name="tracking_type" value="1" /> Web</label>
                <label class="flex items-center text-sm gap-2 "><input type="radio" name="tracking_type" value="2" /> Twitter</label>
                <label class="flex items-center text-sm gap-2 "><input type="radio" name="tracking_type" value="3" /> Both</label>
            </div>
            <div class="flex gap-4">
                <label class="flex items-center text-sm gap-2"><input type="radio" name="type" value="My Company Keyword" /> My Company</label>
                <label class="flex items-center text-sm gap-2"><input type="radio" name="type" value="My Competitor Keyword" /> My Competitor</label>
                <label class="flex items-center text-sm gap-2"><input type="radio" name="type" value="My Industry Keyword" /> My Industry</label>
                <label class="flex items-center text-sm gap-2"><input type="radio" name="type" value="Others" /> Others</label>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center text-sm">Company Issue:</div>
                <select name="company_issue" class="border border-gray-300 rounded p-1 text-sm">
                    <option value="">--company--</option>
                    <option value="1">Company 1</option>
                    <option value="2">Company 2</option>
                </select>
                <div><a href="#" class="text-indigo-600 hover:text-indigo-800">Add New</a></div>
            </div>
        </div>

        <div class="text-center">
            <button id="saveissue" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Save</button>
        </div>
    </form>

    <div class="container mx-auto p-1 max-w-6xl">
        <h2 class="text-sm font-semibold mb-4">Existing Issues:</h2>
        <div class="bg-white border border-gray-300 rounded-lg shadow overflow-hidden">
            <div class="text-sm flex bg-gray-100 text-gray-800 font-semibold p-1">
                <div class="w-2/6 p-2">Issue</div>
                <div class="w-1/6 p-2">Type</div>
                <div class="w-2/6 p-2">Concept Conditions</div>
                <div class="w-1/6 p-2">Color</div>
                <div class="w-1/6 p-2">Company</div>
                <div class="w-1/6 p-2 text-center">Action</div>
            </div>

            <div class="divide-y divide-gray-200">
                <div class="text-sm flex items-center p-1">
                    <div class="w-2/6 p-1">Issue 1</div>
                    <div class="w-1/6 p-1">Type 1</div>
                    <div class="w-2/6 p-1">Condition 1</div>
                    <div class="w-1/6 p-1">
                        <div class="w-6 h-6 rounded-full" style="background-color: #ffc020;"></div>
                    </div>
                    <div class="w-1/6 p-1">Company 1</div>
                    <div class="w-1/6 p-1 flex justify-center gap-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Enable</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addCompanyModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold mb-4">Company String:</h2>
            <form id="addCompanyForm">
                <div class="mb-4">
                    <label for="companyName" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="companyName" name="companyName" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="cancelButton" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const $inputBox = $('#concept-input');
        const $postfixInput = $('#postfix-expression');
        let lastConcept = null;
        let lastComplexConcept = null;
        let lastLogicalOp = null;
        let postfixParts = []; 
      
        function updateInput1(value, id, isConcept) {
        let currentValue = $inputBox.val().trim();
        
        // Initialize postfixParts with the current postfix expression
        postfixParts.push($postfixInput.val().trim());
    
        if (value === "C") {
            // Clear input and reset state
            $inputBox.val('');
            postfixParts = [];
            $postfixInput.val('');
            lastConcept = null;
            lastComplexConcept = null;
            lastLogicalOp = null;
            return;
        }
    
        if (["(", ")"].includes(value)) {
            // Handle parentheses
            if (value === "(" && !currentValue) {
                // Allow open bracket at the start
                currentValue = ` ${value} `;
                postfixParts.push(value);
            } else if (value === ")" && (lastConcept || lastComplexConcept)) {
                // Handle closing bracket
                currentValue += ` ${value} `;
                postfixParts.push(value);
                lastLogicalOp = null;
            }
        } else if (["and", "or", "not"].includes(value)) {
            // Handle logical operators
            if (lastLogicalOp || (!lastConcept && !lastComplexConcept)) {
                return;
            }
            lastLogicalOp = value;
            currentValue += ` ${value} `;
            postfixParts.push(value);
        } else {
            // Handle concepts
            if ((lastConcept == value) || (lastComplexConcept == value)) {
                return;
            }
            if (isConcept) {
                postfixParts.push(id);
                currentValue += ` ${value} `;
            } else {
                postfixParts.push(id);
                currentValue += ` ${value} `;
            }
            lastConcept = isConcept ? value : null;
            lastComplexConcept = isConcept ? null : value;
            lastLogicalOp = null;
        }
    
        $inputBox.val(currentValue.trim());
        $postfixInput.val(postfixParts.join(' '));
    }
    
        $('.concept-option').on('click', function () {
            const value = $(this).data('value');
            const id = $(this).data('id');
            if (lastConcept == value) return;
    
            $('.concept-option').removeClass('bg-gray-300');
            $(this).addClass('bg-gray-300');
    
            updateInput1(value, id, true);
        });
    
        $('.complex-concept-option').on('click', function () {
            const value = $(this).data('value');
            const id = $(this).data('id');
            if (lastComplexConcept) return;
    
            $('.complex-concept-option').removeClass('bg-gray-300');
            $(this).addClass('bg-gray-300');
    
            updateInput1(value, id, false);
        });
    
        $('.logical-op-button').on('click', function () {
            const value = $(this).data('value');
            updateInput1(value, null, false);
        });
    
        $('a[href="#"]').on('click', function (e) {
            e.preventDefault();
            $('#addCompanyModal').removeClass('hidden');
        });
    
        $('#cancelButton').on('click', function () {
            $('#addCompanyModal').addClass('hidden');
        });
    
        $('#addCompanyForm').on('submit', function (e) {
            e.preventDefault();
            const companyName = $('#companyName').val();
            $('#addCompanyModal').addClass('hidden');
            alert(`Company "${companyName}" added successfully!`);
        });
    
        $('#issueadd').on('submit', function (e) {
            e.preventDefault();
            let form = new FormData(this);
            form.append('clientid', '{{ $clientid }}');
            $.ajax({
                url: `{{ route('save.issue') }}`,
                type: 'POST',
                data: form,
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.status) {
                        alert(result.message);
                        window.location.href = "{{ route('client') }}";
                    } else {
                        alert(result.error);
                       // window.location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        displayValidationErrors(errors);
                    } else {
    
                        console.error('Error saving issue:', error.error);
                    }
                }
            });
        });
       
    });
    
    
    </script>