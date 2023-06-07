import {Datepicker} from 'vanillajs-datepicker';
import ru from 'vanillajs-datepicker/locales/ru';

Object.assign(Datepicker.locales, ru);

const receivedAtDatePickerElement = document.getElementById('receivedAtDatePicker');

const receivedAtDatepicker = new Datepicker(receivedAtDatePickerElement, {
    buttonClass: 'btn',
    autohide: true,
    language: 'ru'
});



