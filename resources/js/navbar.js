document.getElementById('closebtn').addEventListener("click", function(){
    document.getElementById("side-navbar").style.right = "-250px";
    document.getElementById("side-navbar").style.width = "auto";
    document.getElementById("overlay-body").style.opacity = "0";
    document.getElementById("overlay-body").style.zIndex = 'auto';
});

document.getElementById('openbtn').addEventListener("click", function(){
    document.getElementById("side-navbar").style.right = "0";
    document.getElementById("overlay-body").style.opacity = "0.5";
    document.getElementById("overlay-body").style.zIndex = '12';
    resize();
});

function resize(){
    if(window.innerWidth <= 455){
        document.getElementById("side-navbar").style.width = "100%";
    } else {
        document.getElementById("side-navbar").style.width = "250px";
    }

}

window.addEventListener('resize', function(){
    // console.log(window.innerWidth);
    if(window.innerWidth <= 455 && getComputedStyle(document.getElementById("side-navbar")).right == '0px'){
        document.getElementById("side-navbar").style.width = "100%";
    } else {
        document.getElementById("side-navbar").style.width = "250px";
    }
});