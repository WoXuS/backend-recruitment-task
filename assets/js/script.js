import { removeButtonHandler, checkboxHandler } from './table.js';
import { paginationInit } from './pagination.js';
import { formSubmitHandler, inputBlurHandler, setupInputMasks } from './form.js';

$(() => {
  removeButtonHandler();
  checkboxHandler();
  paginationInit();
  formSubmitHandler();
  inputBlurHandler();
  setupInputMasks();
});
