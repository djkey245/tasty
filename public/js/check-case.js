function checkCase(url) {
    loading()
    $.ajax({
        method: 'GET',
        url: url,
        data: {
            count: getCountCase()
        },
        success: function (data) {
            insetDataFromRequest(data.itemSum, data.caseSum)
        }
    })
}

function setTextToButton(text) {
    document.querySelector('.check-value span').innerText = text;
}

function setButtonDisabled(disabled) {
    document.querySelector('.check-value').disabled = disabled;
}

function getCountCase() {
    return document.querySelector('.check-value-input').value || 500;
}

function loading() {
    setTextToButton('cчитаем ...')
    setButtonDisabled(true)
}

function insetDataFromRequest(itemSum, caseSum) {
    itemSum = new Intl.NumberFormat().format(itemSum)
    caseSum = new Intl.NumberFormat().format(caseSum)
    setTextToButton(`${caseSum}/${itemSum}`)
    setButtonDisabled(false)
}
