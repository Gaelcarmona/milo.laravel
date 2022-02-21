/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/custom/createResults.js ***!
  \**********************************************/
var chooseUser = document.getElementById("user");
chooseUser.addEventListener("click", onClickChooseUser);

function onClickChooseUser() {
  console.log();
  window.listOfDecks;
  $.ajax({
    url: $("#user option:selected").data('url'),
    type: 'GET'
  }).done(function (data) {
    // console.log(data);
    // todo
    // selectionner mon select
    //supprimer les anciennes options
    data.forEach(function (deck) {// faire option et ajouter au select
    });
  }).fail(function () {//some code going here if error
  }); // let filtered = window.listOfDecks.filter(deck => {
  //     return deck.user_id === parseInt(chooseUser.value)
  // })
  // console.log(filtered)
  //     foreach(decksUser as $deck){
  // <option
  // value={{$deck->id}}>
  // {{$deck->title}}
  // ></option>
  //     }
  //
  // foreach($decksUser as $deck)
  // <option
  //
  //     value="{{ $deck->id }}">
  //     {{$deck->title}}
  // </option>
  // Perform other work here ...
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