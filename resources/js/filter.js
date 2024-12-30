const filterButton = document.getElementById('filter-button');
const filterCard = document.getElementById('filter-card');
// Function to filter non-numeric characters in real time
const filterNumericInput = (elementId) => {
    const inputElement = document.getElementById(elementId);
    inputElement.addEventListener('input', () => {
        inputElement.value = inputElement.value.replace(/[^0-9]/g, '');
    });
};

// Apply numeric filtering to all relevant inputs
const numericInputIds = ['HargaTerendah', 'HargaTertinggi', 'LTMin', 'LTMax', 'LBMin', 'LBMax'];
numericInputIds.forEach(filterNumericInput);

// Function to reset all filters and styles
const resetFilters = (propertyTypeLabels) => {
    propertyTypeLabels.forEach(label => {
        label.classList.remove('bg-orange-500', 'text-white');
        label.classList.add('bg-white', 'text-gray-700');
        label.querySelector('input').checked = false; // Uncheck all radios
    });
};

// Handle the click event for property type labels
const handlePropertyTypeClick = (label) => {
    label.addEventListener('click', () => {
        resetFilters(propertyTypeLabels);
        label.classList.remove('bg-white', 'text-gray-700');
        label.classList.add('bg-orange-500', 'text-white');
        label.querySelector('input').checked = true; // Check the clicked radio
    });
};

// Initialize property type labels
const propertyTypeLabels = document.querySelectorAll('#property-type-group .property-type-label');
propertyTypeLabels.forEach(handlePropertyTypeClick);

// Reset button functionality
const resetButton = document.getElementById('reset-filter-btn');
resetButton.addEventListener('click', () => {
    resetFilters(propertyTypeLabels);
    numericInputIds.forEach(id => {
        document.getElementById(id).value = '';
    });
});

// Load filters from Local Storage on DOMContentLoaded
document.addEventListener("DOMContentLoaded", () => {
    const filterData = JSON.parse(localStorage.getItem('filterData')) || {};
    const pencarianInput = document.getElementById('pencarian-input');
    if (filterData.Pencarian) {
        pencarianInput.value = filterData.Pencarian; // Set the value from local storage
    }
});

// Load filters from Local Storage on window load
window.onload = () => {
    const filterData = JSON.parse(localStorage.getItem('filterData'));
    if (filterData) {
        for (const key in filterData) {
            const inputElement = document.getElementById(key);
            if (key === 'Pencarian') {
                document.getElementById('lokasi-input').value = filterData[key];
            } else if (key === 'Tipe') {
                const radioButton = document.querySelector(`input[name="Tipe"][value="${filterData[key]}"]`);
                if (radioButton) {
                    radioButton.checked = true;
                    const correspondingLabel = radioButton.closest('.property-type-label');
                    if (correspondingLabel) {
                        correspondingLabel.classList.remove('bg-white', 'text-gray-700');
                        correspondingLabel.classList.add('bg-orange-500', 'text-white');
                    }
                }
            } else if (numericInputIds.includes(key)) {
                inputElement.value = filterData[key];
            }
        }
    }
};

// Handle form submission for filters
const filterForm = document.getElementById('filter-form');
filterForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent default form submission
    const formData = new FormData(filterForm);
    const filterData = {};
    formData.forEach((value, key) => {
        if (value.trim() !== '') {
            filterData[key] = value; // Store data in filter object
        }
    });
    localStorage.setItem('filterData', JSON.stringify(filterData)); // Save to Local Storage

    // Create a new URL with query parameters
    const params = new URLSearchParams(filterData).toString();
    const newUrl = `${window.location.origin}${window.location.pathname}?${params}`;
    window.location.href = newUrl; // Redirect to the new URL
});

// Handle main form submission
const mainForm = document.getElementById('main-form');
mainForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent the default form submission
    const formData = new FormData(mainForm);
    const filterData = JSON.parse(localStorage.getItem('filterData')) || {};

    // Get the current Pencarian input value
    const currentPencarian = formData.get('Pencarian');

    // If the Pencarian input is empty, remove it from filterData
    if (currentPencarian && currentPencarian.trim() !== '') {
        filterData.Pencarian = currentPencarian;
    } else {
        delete filterData.Pencarian; // Remove Pencarian if input is empty
    }

    // Update local storage with the modified filterData
    localStorage.setItem('filterData', JSON.stringify(filterData));

    // Prepare the query string
    const params = new URLSearchParams();

    // Append all filter data to params
    for (const key in filterData) {
        params.append(key, filterData[key]);
    }

    // Create a new URL with query parameters
    const baseUrl = window.location.origin + window.location.pathname;
    const newUrl = baseUrl + '?' + params.toString();

    // Redirect to the new URL
    window.location.href = newUrl;
});
