import {Datepicker} from "vanillajs-datepicker";
import ru from 'vanillajs-datepicker/locales/ru';

Object.assign(Datepicker.locales, ru);

const expectedOrderDatePickerElement = document.getElementById('expectedOrderDatePicker');

const expectedOrderDatepicker = new Datepicker(expectedOrderDatePickerElement, {
    buttonClass: 'btn',
    autohide: true,
    language: 'ru'
});
