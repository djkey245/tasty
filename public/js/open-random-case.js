function openRandomCase(user_id, open_url) {
    const selectedDom = document.querySelector(`#case-count-${user_id}`);
    const caseCount = selectedDom.querySelector(`input`).value || 1;
    const button = selectedDom.querySelector('button');
    if(button) button.disabled = true
    $.ajax({
        method: 'POST',
        url: open_url,
        data: {
            user_id,
            count: caseCount
        },
        success: function() {
            if(button) button.disabled = false
        }
    })

}
