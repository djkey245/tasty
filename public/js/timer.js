let interval = null

function setTimer(days, hours, minutes, seconds) {
    const timer = document.querySelector('.topusers__header_block_timer');
    setElement(days, timer.querySelector('.days'))
    setElement(hours, timer.querySelector('.hours'))
    setElement(minutes, timer.querySelector('.minutes'))
    setElement(seconds, timer.querySelector('.seconds'))

}

function setElement(value, document = null) {
    document.innerText = value;
    document.setAttribute('value', value)
}

function subSecond() {
    subElement('.seconds', subMinute)
}

function subMinute() {
    subElement('.minutes', subHour)
}

function subHour() {
    subElement('.hours', subDays, 23)
}

function subDays() {
    subElement('.days', timerEnded, 0)
}

function timerEnded() {
    if (interval)
        clearInterval(interval)
    console.log('end')
}

function subElement(classToElement, functionIfLower, maxElement = 59) {
    const timer = document.querySelector('.topusers__header_block_timer');
    let value = timer.querySelector(classToElement).getAttribute('value')

    value -= 1
    if (value <= -1) {
        value = maxElement;
        functionIfLower();
    }
    setElement(value, timer.querySelector(classToElement))
}

function onTimer() {
    interval = setInterval(subSecond, 1000)
}
