window.onresize = () => {
    let main = document.getElementsByClassName('main_info')[0];
    if (main) {
        if (window.outerWidth < 790)
            main.style.display = 'none';
        else
            if (main.style.display === 'none')
                main.style.display = 'block';
    }
};