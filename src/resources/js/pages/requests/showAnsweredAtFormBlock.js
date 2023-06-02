const selectRequestStatusElement = document.getElementById('status');
const element = document.querySelector('#answeredAtFormBlock');

if (selectRequestStatusElement) {
    const selectedOption = selectRequestStatusElement.options[selectRequestStatusElement.selectedIndex];
    const selectedText = selectedOption.textContent;

    if (selectedText === 'ответ отправлен') {
        element.style.display = 'flex';
    } else {
        element.style.display = 'none';
    }

    selectRequestStatusElement.addEventListener('change', () => {
        const selectedOption = selectRequestStatusElement.options[selectRequestStatusElement.selectedIndex];
        const selectedText = selectedOption.textContent;

        if (selectedText === 'ответ отправлен') {
            element.style.display = 'flex';
        } else {
            element.style.display = 'none';
        }
    });
}



