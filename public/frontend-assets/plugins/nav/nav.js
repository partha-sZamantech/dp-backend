function openNav(data) {
    document.getElementById(data).style.width = "290px";
    document.querySelector(".main-content").style.background = "rgba(24,24,24,0.5)"
    document.querySelector(".marquee").style.background = "rgba(24,24,24,0.5)"
}

function closeNav(data) {
    document.getElementById(data).style.width = "0";
    document.querySelector(".main-content").style.background = 'none';
    document.querySelector(".marquee").style.background = "#f1f1f1"
}

function open_mega_menu(data) {
    document.getElementById(data).style.visibility = "visible";
    document.getElementById(data).style.opacity = "1";
    document.getElementById("overlay").style.display = "block";
}
function close_mega_menu(data) {
    document.getElementById(data).style.visibility = "hidden";
    document.getElementById(data).style.opacity = "0";
    document.getElementById("overlay").style.display = "none";
}

// close mega menu if click outside of window
function overlay_click(overlay) {
    document.getElementById("all_category").style.visibility = "hidden";
    document.getElementById("all_category").style.opacity = "0";
    document.getElementById(overlay).style.display = "none";
}

/*function showSearchForm() {
    let self = document.querySelector('.toggleSearchForm');
    self.addEventListener('click', ()=> {
        self.style.display = 'none';
        document.querySelector('.search_submit').style.display = 'block';
        document.querySelector('.search_submit').style.width = '300px'
    },true);
}
showSearchForm();*/
