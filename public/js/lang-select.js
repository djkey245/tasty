document.querySelector('.selected_lang').addEventListener('click', function (e) {
    e.preventDefault()
    toggleOpen()
})

function toggleOpen() {
    document.querySelector('.language__picker_new').classList.toggle('opened')
}
