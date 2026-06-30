
 function validateForm(event) {
    let department = document.getElementById("department").value;
    let errorElement = document.querySelector("[x-data] p");

    if (!department) {
        errorElement.innerText = "Please select a department.";
        event.preventDefault(); // Prevent form submission
    } else {
        errorElement.innerText = ""; // Clear error if valid
    }
}