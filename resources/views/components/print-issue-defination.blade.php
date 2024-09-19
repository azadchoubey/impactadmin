<div class="container mx-auto p-4 max-w-6xl">
    <div class="bg-white text-black border border-black p-4 rounded mb-4">
        <h2 class="text-sm font-semibold mb-2">Concept</h2>
        <div class="flex flex-wrap gap-2">
            @foreach ($getprintissueforclients as $concept)
            <div class="text-sm concept-option1 bg-gray-200 text-black p-2 rounded cursor-pointer" data-id="{{$concept->id}}" data-value="{{$concept->name}}">{{ $concept->name}}</div>
            @endforeach
        </div>
    </div>

    <div class="bg-white text-black border border-black p-4 rounded mb-4">
        <h2 class="text-sm font-semibold mb-2">Complex Concepts</h2>
        <div class="flex flex-wrap gap-2">
            @foreach ($complexprintconcepts as $complexconcept)
            <div class="text-sm complex-concept-option1 bg-gray-200 text-black p-2 rounded cursor-pointer" data-id="{{$complexconcept->id}}" data-value="{{$complexconcept->name}}">{{ $complexconcept->name}}</div>
            @endforeach
        </div>
    </div>

    <div class="text-center mb-4">
        <div class="inline-flex gap-2">
        <button class="text-sm logical-op-button1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="(">(</button>
            <button class="text-sm logical-op-button1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="and">and</button>
            <button class="text-sm logical-op-button1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="or">or</button>
            <button class="text-sm logical-op-button1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="not">not</button>
            <button class="text-sm logical-op-button1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value=")">)</button>
            <button class="text-sm logical-op-button1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-value="C">C</button>
        </div>
    </div>
    <div class="error-container hidden p-4 border border-red-500 bg-red-100 text-red-700 rounded-md"></div>

    <form id="issueadd1">
        <div class="bg-white p-4 rounded mb-4">
            <textarea id="concept-input1" name="concept_conditions" class="w-full text-sm h-24 p-2 border border-gray-300 rounded" placeholder="Type your concept here..."></textarea>
        </div>
        <input type="hidden" id="issue-id1" name="issue_id">
        <div class="flex flex-col items-center mb-4 space-y-4">
            <div class="flex items-center gap-4 text-sm">
                <div class="flex items-center">Save above concept:</div>
                <input type="text" id="issue1" name="issue" class="text-sm border border-gray-300 rounded p-1" placeholder="Concept Name" />
                <div class="flex items-center">Color: <input type="color" name="issue_color" id="concept-color1" class="text-sm ml-2" /></div>
            </div>
           {{-- <div class="flex gap-4">
                <label class="flex items-center text-sm gap-2 "><input type="radio" name="tracking_typeprint" value="1" /> Web</label>
                <label class="flex items-center text-sm gap-2 "><input type="radio" name="tracking_typeprint" value="2" /> Twitter</label>
                <label class="flex items-center text-sm gap-2 "><input type="radio" name="tracking_typeprint" value="3" /> Both</label>
            </div>  --}}
            <div class="flex gap-4">
                <label class="flex items-center text-sm gap-2"><input type="radio" name="typeprint" value="My Company Keyword" /> My Company</label>
                <label class="flex items-center text-sm gap-2"><input type="radio" name="typeprint" value="My Competitor Keyword" /> My Competitor</label>
                <label class="flex items-center text-sm gap-2"><input type="radio" name="typeprint" value="My Industry Keyword" /> My Industry</label>
                <label class="flex items-center text-sm gap-2"><input type="radio" name="typeprint" value="Others" /> Others</label>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center text-sm">Company Issue:</div>
                <select name="company_issueprint" class="border border-gray-300 rounded p-1 text-sm">
                    <option value="">--company--</option>
                   @foreach ($issuesprints as $issuesprint)
                   <option value="{{ $issue->id }}">{{ $issue->name }}</option>
                   @endforeach
                </select>
              {{--  <div><a href="#" class="text-indigo-600 hover:text-indigo-800">Add New</a></div>  --}} 
            </div>
        </div>

        <div class="text-center">
            <button id="saveissue1" class="bg-indigo-700 hover:bg-indigo-500 text-white  text-xs py-2 px-4 rounded">Save</button>
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
            @foreach ($getissueforprintclients as $getissueforclient)
                <div class="text-sm flex items-center p-1">

                    <div class="w-2/6 p-2">{{$getissueforclient->name}}</div>
                    <div class="w-1/6 p-2">{{$getissueforclient->type}}</div>
                    <div class="w-2/6 p-2">{{$getissueforclient->conceptcondition}}</div>
                    <div class="w-1/6 p-2">
                        <div class="w-6 h-6 rounded-full" style="background-color: {{$getissueforclient->issuecolor}};"></div>
                        </div>
                    <div class="w-1/6 p-2">{{$getissueforclient->companyissue}}</div>
                    <div class="w-1/6 p-2 flex justify-center gap-2">
                        <button class="bg-blue-500 text-xs hover:bg-blue-700 text-white py-1 px-2 rounded" onclick="editIssue1({{$getissueforclient->id}})">Edit</button>
                        <button class="bg-red-500 text-xs hover:bg-red-700 text-white py-1 px-2 rounded" onclick="deleteIssue1({{$getissueforclient->id}})">Delete</button>
                        @if($getissueforclient->enabled == 1)
                        <button class="bg-orange-500  text-xs hover:bg-orange-700 text-white py-1 px-2 rounded" onclick="enableDisableIssue1({{$getissueforclient->id}}, 'Disable')">Disable</button>
                        @else
                        <button class="bg-green-500  text-xs hover:bg-green-700 text-white  py-1 px-2 rounded" onclick="enableDisableIssue1({{$getissueforclient->id}},'Enable')">Enable</button>
                        @endif
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>

  {{--  <div id="addCompanyModal1" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold mb-4">Company String:</h2>
            <form id="addCompanyForm1">
                <div class="mb-4">
                    <label for="companyName1" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="companyName1" name="companyName1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="cancelButton1" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Add</button>
                </div>
            </form>
        </div>
    </div>  --}}
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const $inputBox = $('#concept-input1');
        const $postfixInput = $('#postfix-expression1');
        let lastConcept = null;
        let lastComplexConcept = null;
        let lastLogicalOp = null;
        let postfixParts = [];

        function updateInput1(value, id, isConcept) {

            let currentValue = $inputBox.val();

            // Initialize postfixParts with the current postfix expression
            postfixParts.push($postfixInput.val());

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
                lastConcept = null;
                lastComplexConcept = null;
            } else if (["and", "or", "not"].includes(value)) {
                // Handle logical operators
                if (lastLogicalOp !='null' || (!lastConcept && !lastComplexConcept)) {
                    return;
                }
                lastLogicalOp = value;
                currentValue += ` ${value} `;
                postfixParts.push(value);
                lastConcept = null;
                lastComplexConcept = null;
            } else {
                // Handle concepts
                console.log(lastConcept,"ok");
                
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
                lastLogicalOp = 'null';
            }

            $inputBox.val(currentValue.trim());
            $postfixInput.val(postfixParts.join(' '));
        }

        $('.concept-option1').on('click', function() {

            console.log($(this).data('value'));
            const value = $(this).data('value');
            const id = $(this).data('id');
            if (lastConcept == value) return;
            if(lastLogicalOp == 'null') return;
            $('.concept-option1').removeClass('bg-gray-300');
            $(this).addClass('bg-gray-300');
          
            updateInput1(value, id, true);
        });

        $('.complex-concept-option1').on('click', function() {
            const value = $(this).data('value');
            const id = $(this).data('id');
            if (lastComplexConcept == value) return;
            if(lastLogicalOp == 'null') return;
            $('.complex-concept-option1').removeClass('bg-gray-300');
            $(this).addClass('bg-gray-300');

            updateInput1(value, id, false);
        });

        $('.logical-op-button1').on('click', function() {
            const value = $(this).data('value');
            updateInput1(value, null, false);
        });

        $('a[href="#"]').on('click', function(e) {
            e.preventDefault();
            $('#addCompanyModal1').removeClass('hidden');
        });

        $('#cancelButton1').on('click', function() {
            $('#addCompanyModal1').addClass('hidden');
        });

        $('#addCompanyForm1').on('submit', function(e) {
            e.preventDefault();
            const companyName1 = $('#companyName1').val();
            $('#addCompanyModal1').addClass('hidden');
            alert(`Company "${companyName1}" added successfully!`);
        });

        $('#issueadd1').on('submit', function(e) {
            e.preventDefault();
        $('.error-container').addClass('hidden');
            let form = new FormData(this);
            form.append('clientid', '{{ $clientid }}');
            $.ajax({
                url: `{{ route('save.print.issue') }}`,
                type: 'POST',
                data: form,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.status) {
                        alert(result.message);
                    window.location.reload();
                    } else {
                        alert(result.error);
                       
                    }
                },
                error: function(xhr, status, error) {
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