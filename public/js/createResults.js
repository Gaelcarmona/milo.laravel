let chooseUser = document.getElementById("user_id");
const onClickChooseUser = () => {
    $.ajax({
        url: $("#user_id option:selected").data('url'),
        type: 'GET'


    }).done(data => {
        console.log(data)
        console.log(chooseUser.value)
        // todo
        // selectionner mon select
        //supprimer les anciennes options
        let html = ''
        data.forEach((deck) => {
            // faire option et ajouter au select
            html += `<option value="${deck.id}">${deck.title}</option>`
        })
        $('#deck_id').html(html)

    }).fail(() => {
        //some code going here if error
    })
}

chooseUser.addEventListener("click", onClickChooseUser)
