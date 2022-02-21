/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/custom/createResults.js ***!
  \**********************************************/
var chooseUser = document.getElementById("user");
chooseUser.addEventListener("click", onClickChooseUser);

function onClickChooseUser() {
  // console.log()
  $.ajax({
    url: $("#user option:selected").data('url'),
    type: 'GET'
  }).done(function (data) {// console.log(data);
  }).fail(function () {//some code going here if error
  }); // Perform other work here ...
  // Set another completion function for the request above
  // jqxhr.always(function () {
  //     alert("second complete");
  // });
  // console.log('coucofghf');
  // console.log(chooseUser.value);
  // var decksUser = chooseUser.value;
}
/******/ })()
;