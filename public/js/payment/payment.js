let coinModifier = {
    value: 15,
    get() {
        return this.value;
    },
    set(value) {
        this.value = value;
        updateBonus();
    }
};

function getSelectedMethod() {
    const paymentMethods = document.querySelectorAll('.payment__method_radio');
    for (let method of paymentMethods) {
        if (method.checked)
            return method.getAttribute('id')
    }
    return null;
}

function setAmount(value) {
    document.querySelector('.payment__deposit_inp').value = value;
    updateBonus();
}


function updateBonus() {
    const money = document.querySelector('.payment__deposit_inp').value
    document.querySelector('.payment__deposit_bonus span').innerText = money
    document.querySelector('.payment__deposit_bonus_plus span').innerText = money * coinModifier.get()
}

document.querySelector('.payment__deposit_inp').addEventListener('change', function () {
    updateBonus()
})



function getData(locale) {
    return {
        sum: document.querySelector('.payment__deposit_inp').value,
        locale: locale
    }

}

function sendRequestToPay(locale) {
    const method = getSelectedMethod();
    $.ajax({
        url: `/payment/${method}`,
        type: 'POST',
        data: getData(locale),
        success: function (result) {
            if (result.href) {
                location.href = result.href;
            }
        },
        error: function () {
            return toastr.error("Something went wrong")
        }
    })
}
