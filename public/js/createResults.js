/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/custom/createResults.js ***!
  \**********************************************/
var chooseUser = document.getElementById("user");
chooseUser.addEventListener("click", onClickChooseUser);

function onClickChooseUser() {
  // console.log('coucofghf');
  console.log(chooseUser.value);
  decksUser(chooseUser.value);
}
/******/ })()
;