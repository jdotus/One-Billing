// DATE
const today = new Date();
const maxDate = today.toISOString().split('T')[0]; // Get only the date part

document.getElementById('invoice_date').max = maxDate;

// Get references to both input elements
const total_priceInput = document.getElementById("total_price");
const totalInput = document.getElementById("total"); // Replace "target_input_id" with the actual ID of the target input
const vatInput = document.getElementById("vat"); // Replace "target_input_id" with the actual ID of the target input
const totalSalesInput = document.getElementById("total_sales"); // Replace "target_input_id" with the actual ID of the target input

// Add an event listener to the total_price input
total_priceInput.addEventListener("input", () => {

    // Get the value from the total_price input
    const total_priceValue = parseFloat(total_priceInput.value) || 0;
    // const vatValue = parseFloat(vatInput.value) || 0;
    // const total_salesValue = parseFloat(totalSalesInput.value) || 0;

    // Set the value of the target input
    totalInput.value = total_priceValue;
    
    const totalSalesCompute = total_priceValue / 1.12;
    const vatCompute = total_priceValue - totalSalesCompute;

    totalSalesInput.value = totalSalesCompute.toFixed(2);
    vatInput.value = vatCompute.toFixed(2);
});


// // Modal functionality
// var modal = document.getElementById("myModal");
// var btn = document.getElementById("myBtn");
// var span = document.getElementsByClassName("close")[0];



// btn.onclick = function () {
//     modal.style.display = "block";
//     modal.style.transitionDuration = "5s";
// }

// span.onclick = function () {
//     modal.style.display = "none";
// }

// window.onclick = function (event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }
