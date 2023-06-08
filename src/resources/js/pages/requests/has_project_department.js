const hasProjectDepartmentElement = document.getElementById('hasProjectDepartment');
const customerTypeElement = document.getElementById('customerType');

customerTypeElement.addEventListener('change', () => {
    const selectedOption = customerTypeElement.options[customerTypeElement.selectedIndex];
    const selectedText = selectedOption.textContent;
    console.log(selectedText);

    hasProjectDepartmentElement.checked = selectedText === 'проектная организация';
});
