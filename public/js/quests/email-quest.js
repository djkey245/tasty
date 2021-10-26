const emailQuestName = 'email-quest'
function sendEmail() {

    console.log('start validate')
    if(!validateEmail($('#quest-email-field').val())) return;

    const data = {
        'email': $('#quest-email-field').val()
    }
    sendQuestResponse(data, emailQuestName)
    closeQuestModel(emailQuestName)
}
function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
