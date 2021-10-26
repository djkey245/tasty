let alreadyListen = false

function startListen() {
    if (alreadyListen) return;
    Echo.channel('livedrop-tasty')
        .listen('.stat-count-update', function (e) {
            findStatElement(e.statName)
        })
    alreadyListen = true;
}

function findStatElement(name) {
    const elementToUpdate = document.querySelectorAll(`.header__middle_stat .${name}`);
    for (let element of elementToUpdate) {
        countPlusToElement(element)
    }
}

function countPlusToElement(element) {
    let value = parseInt(element.innerText);
    element.innerText = value + 1;
}
