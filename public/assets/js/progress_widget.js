
function progress(bool) {
    if (bool) {
        var overlay = document.createElement('DIV');
        overlay.setAttribute('id','overlay');
        overlay.style.position = 'fixed';
        overlay.style.display = 'none';
        overlay.style.width = '100%';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.right = '0';
        overlay.style.bottom = '0';
        overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
        overlay.style.zIndex  = '2';
        $("body").append(overlay);
        overlay.style.display = "flex";
        overlay.style.justifyContent = 'center';

        var progress = document.createElement('IMG');
        progress.src = 'https://i.stack.imgur.com/kOnzy.gif';
        progress.style.width = '100px';
        progress.style.height = '100px';
        progress.style.margin = 'auto';
        progress.style.display = 'block';
        overlay.appendChild(progress);
    } else {
        $("#overlay").remove();
    }
}