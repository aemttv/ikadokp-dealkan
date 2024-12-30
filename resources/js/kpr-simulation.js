document.addEventListener('DOMContentLoaded', () => {
    const dropdownButton = document.getElementById('dropdownSearchButton');
    const dropdownMenu = document.getElementById('dropdownSearch');
    const radioButtons = document.querySelectorAll('input[name="default-radio"]');
    window.interestRateInput = document.getElementById('selectedInterestRate');

    // Toggle dropdown menu visibility
    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Handle radio button selection
    radioButtons.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.checked) {
                const selectedValue = radio.value;
                const bankName = radio.nextElementSibling.textContent.trim();
                dropdownButton.innerHTML = `
                    <span class="mx-2 text-gray-400">${bankName} (${selectedValue}%)</span>
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                `;

                // Store selected interest rate in hidden input
                interestRateInput.value = selectedValue;

                dropdownMenu.classList.add('hidden'); // Hide dropdown after selection

                updateSimulationResult();
            }
        });
    });
});

// Function to format number as currency without decimal places
function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(number);
}

// Function to calculate and update simulation result
function updateSimulationResult() {
    const hargaProperty = parseInt(document.getElementById('harga-property').value.replace(/[^0-9]/g, '')) || 0;
    const uangMuka = parseInt(document.getElementById('uang-muka').value.replace(/[^0-9]/g, '')) || 0;
    const jangkaWaktu = parseInt(document.getElementById('jangka-waktu-p').value) || 0;

    const bungaTahunan = parseFloat(interestRateInput.value) || 0; // Ensure we get the correct interest rate
    const bungaBulanan = bungaTahunan / 100 / 12; // Convert annual interest to monthly

    console.log(`Harga Property: ${hargaProperty}, Uang Muka: ${uangMuka}, Jangka Waktu: ${jangkaWaktu}, Bunga Bulanan: ${bungaBulanan}`); // Debugging line

    // Display harga property in result
    document.getElementById('harga-property-result').textContent = formatRupiah(hargaProperty);

    // Only perform calculation if uang muka and jangka waktu are filled
    if (uangMuka >= 0 && jangkaWaktu > 0 && hargaProperty > uangMuka) {
        const totalPinjaman = hargaProperty - uangMuka; // Total amount borrowed
        const jumlahAngsuran = (totalPinjaman * bungaBulanan) / (1 - Math.pow(1 + bungaBulanan, -jangkaWaktu * 12)); // Calculate monthly installment

        // Check if jumlahAngsuran is a valid number
        const formattedAngsuran = isNaN(jumlahAngsuran) || jumlahAngsuran < 0 ? '-' : formatRupiah(jumlahAngsuran.toFixed(0)); // Round to the nearest integer

        // Update the results in the DOM
        document.getElementById('angsuran-bulan-result').textContent = formattedAngsuran;
    } else {
        // Clear the installment result if conditions are not met
        document.getElementById('angsuran-bulan-result').textContent = '-';
    }
}

// Real-time filtering and updating of input fields
function setupInputListeners() {
    const inputs = document.querySelectorAll('#harga-property, #uang-muka, #jangka-waktu-p');
    inputs.forEach(input => {
        input.addEventListener('input', function () {
            // Replace any non-numeric character with an empty string
            this.value = this.value.replace(/[^0-9]/g, '');

            // Format the value as currency or leave as is for jangka waktu
            if (input.id === 'jangka-waktu-p') {
                this.value = this.value; // Don't format jangka waktu as currency
            } else {
                const numericValue = parseInt(this.value, 10) || 0;
                this.value = formatRupiah(numericValue);
            }

            // Update simulation result
            updateSimulationResult(); // Update simulation result on input change
        });

        // Auto-format existing value if present
        if (input.value) {
            const numericValue = parseInt(input.value.replace(/[^0-9]/g, ''), 10) || 0;
            if (input.id !== 'jangka-waktu-p') {
                input.value = formatRupiah(numericValue);
            }
        }
    });
}

// Initialize the application on page load
document.addEventListener('DOMContentLoaded', function () {
    setupInputListeners(); // Set up input listeners for real-time updates
    updateSimulationResult(); // Ensure the simulation result is updated based on existing values

    const searchInput = document.getElementById('input-group-search');
    const bankList = document.getElementById('bank-list');

    // Search filter for banks
    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();
        const items = bankList.querySelectorAll('li');
        items.forEach(item => {
            const label = item.textContent.toLowerCase();
            item.style.display = label.includes(searchTerm) ? '' : 'none'; // Filter bank items based on search
        });
    });
});
