var bar_menu = document.querySelector('.fa-bars')
var drop_down = document.querySelector('.drop-down')
var close_menu = document.querySelector('.close-drop-down-menu')

bar_menu.addEventListener('click', (e)=>{
    e.preventDefault()
    drop_down.style.display = 'block'
})

close_menu.addEventListener('click', ()=>{
    drop_down.style.display = 'none'
})

