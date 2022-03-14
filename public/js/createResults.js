/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/custom/createResults.js ***!
  \**********************************************/
// const chooseUser = document.getElementById("user");
// chooseUser.addEventListener("Click", onClickChooseUser);
$('#user').on('change', function () {
  onClickChooseUser();
});
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