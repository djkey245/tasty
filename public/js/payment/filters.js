let minValue = {
    value: 0.5,
    set(value) {
        this.value = value
    },
    get() {
        return this.value
    }
};

function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
        textbox.addEventListener(event, function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = getMinValue();
            }
        });
    });
}



function onlyNumbers(value) {
    return /^\d*\.?\d*$/.test(value);
}

function minValueCheck(value) {
    const parsedValue = parseFloat(value)
    if (parsedValue)
        return value >= minValue.get()
    return true;
}

function filterFunction(value) {

    return onlyNumbers(value) && minValueCheck(value)

}

setInputFilter(document.querySelector('.payment__deposit_inp'), filterFunction);
