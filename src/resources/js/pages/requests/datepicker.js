import { Datepicker } from 'vanillajs-datepicker';
import 'vanillajs-datepicker/css/datepicker.css';
import ru from 'vanillajs-datepicker/locales/ru';

Object.assign(Datepicker.locales, ru);

const receivedAt = document.querySelector('#receivedAt');

if (receivedAt) {
    const receivedAtDatepicker = new Datepicker(receivedAt, {
        buttonClass: 'btn',
        autohide: true,
        language: 'ru'
    });
}

const answeredAt = document.querySelector('#answeredAt');

if (answeredAt) {
    const answeredAtDatepicker = new Datepicker(answeredAt, {
        buttonClass: 'btn',
        autohide: true,
        language: 'ru'
    });
}

