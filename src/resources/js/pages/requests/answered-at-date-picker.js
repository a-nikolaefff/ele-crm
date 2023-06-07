import {Datepicker} from "vanillajs-datepicker";
import ru from 'vanillajs-datepicker/locales/ru';

Object.assign(Datepicker.locales, ru);

const answeredAtDatePickerElement = document.getElementById('answeredAtDatePicker');

const answeredAtDatepicker = new Datepicker(answeredAtDatePickerElement, {
    buttonClass: 'btn',
    autohide: true,
    language: 'ru'
});

/*
* Show answered at form block and set required tag for answeredAt input if the status is completed
* */
const selectRequestStatusElement = document.getElementById('requestStatus');
const answeredAtFormBlockElement = document.getElementById('answeredAtFormBlock');

const selectedOption = selectRequestStatusElement.options[selectRequestStatusElement.selectedIndex];
const selectedText = selectedOption.textContent;

if (selectedText === 'ответ отправлен') {
    answeredAtFormBlockElement.style.display = 'flex';
    answeredAtDatePickerElement.required = true;
} else {
    answeredAtFormBlockElement.style.display = 'none';
}

selectRequestStatusElement.addEventListener('change', () => {
    const selectedOption = selectRequestStatusElement.options[selectRequestStatusElement.selectedIndex];
    const selectedText = selectedOption.textContent;

    if (selectedText === 'ответ отправлен') {
        answeredAtFormBlockElement.style.display = 'flex';
        answeredAtDatePickerElement.required = true;
    } else {
        answeredAtFormBlockElement.style.display = 'none';
    }
});
