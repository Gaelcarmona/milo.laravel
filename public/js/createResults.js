/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/custom/createResults.js ***!
  \**********************************************/
// const chooseUser = document.getElementById("user");
// chooseUser.addEventListener("Click", onClickChooseUser);
$(document).ready(function () {
  $('#sortTablePlayerInChampionship').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
$(document).ready(function () {
  $('#sortTableDeckInChampionship').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
$(document).ready(function () {
  $('#sortTablePlayer').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
$(document).ready(function () {
  $('#sortTableDeck').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

$('#user').on('change', function () {
  onClickChooseUser();
});

function onClickChooseUser() {
  $.ajax({
    url: $("#user option:selected").data('url'),
    type: 'GET'
  }).done(function (data) {
    console.log(data); // todo
    // selectionner mon select
    //supprimer les anciennes options
    // $('#deck').html('');

    var html = '';
    data.forEach(function (deck) {
      html += '<option value="' + deck.id + '">' + deck.title + '</option>'; // faire option et ajouter au select
    });
    $('#deck').html(html);
  }).fail(function () {//some code going here if error
  }); // let filtered = window.listOfDecks.filter(deck => {

}
/******/ })()
;