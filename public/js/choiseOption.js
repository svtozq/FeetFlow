document.addEventListener('DOMContentLoaded', function () {
    const selectType = document.getElementById('question_type');
    const optionsContainer = document.getElementById('options-container');

    function renderOptions() {
        const type = selectType.value;
        optionsContainer.innerHTML = '';

        if (type === 'radio' || type === 'checkbox') {
            // Label pour nombre d'options
            const labelNb = document.createElement('label');
            labelNb.textContent = "Nombre d'options : ";
            labelNb.className = 'block mb-1 font-medium';

            const selectNb = document.createElement('select');
            selectNb.id = 'number_options';
            selectNb.className = 'border p-2 mb-2';

            for (let i = 1; i <= 10; i++) {
                const opt = document.createElement('option');
                opt.value = i;
                opt.textContent = i;
                selectNb.appendChild(opt);
            }

            optionsContainer.appendChild(labelNb);
            optionsContainer.appendChild(selectNb);

            // Container pour les inputs des options
            const optionsDiv = document.createElement('div');
            optionsDiv.id = 'options_inputs';
            optionsContainer.appendChild(optionsDiv);

            // Fonction pour générer les inputs
            function generateInputs(n) {
                optionsDiv.innerHTML = '';
                for (let i = 0; i < n; i++) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'mb-1';

                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = 'options[]';
                    input.placeholder = 'Option ' + (i + 1);
                    input.className = 'border p-2 w-full';

                    wrapper.appendChild(input);
                    optionsDiv.appendChild(wrapper);
                }
            }

            selectNb.addEventListener('change', function () {
                const n = parseInt(this.value);
                generateInputs(n);
            });

            // Créer initialement 1 input
            generateInputs(parseInt(selectNb.value));
        }
    }

    selectType.addEventListener('change', renderOptions);
    renderOptions(); // Initial render
});
