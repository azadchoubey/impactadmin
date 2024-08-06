<div class="complex-concepts-container">
    <!-- Section to display saved complex concepts -->
    <div class="box saved-complex-concepts">
        <h3>Saved Complex Concepts</h3>
        <ul>
            <!-- Example of saved complex concepts -->
            <li>
                At least 3 occurrences of the concept "Concept 1"
                <button type="button" class="delete-concept" onclick="deleteConcept(this)">Delete</button>
            </li>
            <li>
                Concept 1 within 5 words of Concept 2
                <button type="button" class="delete-concept" onclick="deleteConcept(this)">Delete</button>
            </li>
            <li>
                Concept 3 within first 10 words of the article
                <button type="button" class="delete-concept" onclick="deleteConcept(this)">Delete</button>
            </li>
        </ul>
    </div>

    <!-- Form to define complex concepts -->
    <div class="box define-complex-concepts">
        <h3>Define Complex Concepts</h3>
        <form id="complex-concepts-form" onsubmit="handleSubmit(event)">
            <!-- First Option: At least N occurrences of the concept -->
            <div class="complex-concept-row" data-form-type="occurrences">
                <label for="occurrences1">At least</label>
                <input type="number" id="occurrences1" name="occurrences1" min="1" required>
                
                <label for="concept1">occurrences of the concept</label>
                <select id="concept1" name="concept1" required>
                    <option value="" disabled selected>--concepts--</option>
                    <option value="concept1">Concept 1</option>
                    <option value="concept2">Concept 2</option>
                    <option value="concept3">Concept 3</option>
                </select>
                
                <button type="submit">OK</button>
                <button type="reset">Clear</button>
            </div>

            <!-- Second Option: Concept 1 within N words of Concept 2 -->
            <div class="complex-concept-row" data-form-type="within-words">
                <label for="concept2">Concept 1</label>
                <select id="concept2" name="concept2" required>
                    <option value="" disabled selected>--concepts--</option>
                    <option value="concept1">Concept 1</option>
                    <option value="concept2">Concept 2</option>
                    <option value="concept3">Concept 3</option>
                </select>
                
                <label for="words1">within</label>
                <input type="number" id="words1" name="words1" min="1" required>
                
                <label for="concept3">words of Concept 2</label>
                <select id="concept3" name="concept3" required>
                    <option value="" disabled selected>--concepts--</option>
                    <option value="concept1">Concept 1</option>
                    <option value="concept2">Concept 2</option>
                    <option value="concept3">Concept 3</option>
                </select>
                
                <button type="submit">OK</button>
                <button type="reset">Clear</button>
            </div>

            <!-- Third Option: Concept within first N words of the article -->
            <div class="complex-concept-row" data-form-type="first-words">
                <label for="concept4">Concept</label>
                <select id="concept4" name="concept4" required>
                    <option value="" disabled selected>--concepts--</option>
                    <option value="concept1">Concept 1</option>
                    <option value="concept2">Concept 2</option>
                    <option value="concept3">Concept 3</option>
                </select>
                
                <label for="words2">within first</label>
                <input type="number" id="words2" name="words2" min="1" required>
                
                <label for="words2">words of the article</label>
                
                <button type="submit">OK</button>
                <button type="reset">Clear</button>
            </div>
        </form>
    </div>
</div>

<!-- Optionally, add some styling -->
<style>
    .complex-concepts-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
    }
    .box {
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .saved-complex-concepts h3, 
    .define-complex-concepts h3 {
        margin-top: 0;
    }
    .saved-complex-concepts ul {
        list-style-type: none;
        padding: 0;
    }
    .saved-complex-concepts li {
        background: #f4f4f4;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .delete-concept {
        background: #e74c3c;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 3px;
        transition: background 0.3s;
    }
    .delete-concept:hover {
        background: #c0392b;
    }
    .complex-concept-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 10px;
    }
    .complex-concept-row label, 
    .complex-concept-row input, 
    .complex-concept-row select, 
    .complex-concept-row button {
        margin: 5px 10px;
    }
    .complex-concept-row input, 
    .complex-concept-row select {
        flex: 1;
        min-width: 150px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    .complex-concept-row button {
        flex: 0 0 auto;
        padding: 5px 10px;
        border: none;
        background: #3498db;
        color: #fff;
        border-radius: 3px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .complex-concept-row button:hover {
        background: #2980b9;
    }
    .complex-concept-row label {
        flex: 0 0 auto;
        white-space: nowrap;
    }
</style>

<!-- JavaScript to handle form submission and delete functionality -->
<script>
    function deleteConcept(button) {
        const listItem = button.parentElement;
        listItem.remove();
        // Optionally, add code here to handle the deletion on the server side
    }

    function handleSubmit(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the active form
        const form = event.target;
        const formType = form.querySelector('.complex-concept-row').getAttribute('data-form-type');
        
        // Collect form data based on the form type
        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => { data[key] = value; });

        // Perform actions based on the form type
        if (formType === 'occurrences') {
            // Handle occurrences submission
            console.log('Occurrences Data:', data);
        } else if (formType === 'within-words') {
            // Handle within words submission
            console.log('Within Words Data:', data);
        } else if (formType === 'first-words') {
            // Handle first words submission
            console.log('First Words Data:', data);
        }

        // Optionally, add code here to handle the data, e.g., send it to a server
    }
</script>
