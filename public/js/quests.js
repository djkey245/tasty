function openQuestModal(questName) {
    $('#' + questName).fadeIn(300)
}

function sendQuestResponse(data, name) {
    $.ajax({
        method: 'POST',
        url: `/quests/${name}`,
        data: data,
        success: function (result) {
            $('.header__top_account_balance span').html(result.modified_balance)
            document.location.reload();
        }
    })
}

function closeQuestModel(questName) {
    $('#' + questName).fadeOut(300)
}
