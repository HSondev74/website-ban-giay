var add = document.querySelector('.header-location')
var map = document.querySelector('.map')
var closes = document.querySelector('.close-map')
add.addEventListener('click', (e)=>{
    e.preventDefault()
    map.style.display = 'block'
})

closes.addEventListener('click', (e)=>{
    e.preventDefault()
    map.style.display = 'none'
} )

