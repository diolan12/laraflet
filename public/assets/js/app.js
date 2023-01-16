let inits = []
function onReady(f) {
    inits.push(f)
}
$(document).ready(() => {
    M.AutoInit();
    $('.modal').modal()
    inits.forEach((f) => { f() })
})