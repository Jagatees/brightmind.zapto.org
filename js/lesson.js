const btnList = document.querySelectorAll('.btn');
        
btnList.forEach(btn => {
    btn.addEventListener('click', () => {
        if (btn.classList.contains('active')) {
            btn.classList.remove('active');
        }
        else {
            document.querySelector('.active')?.classList.remove('active');
            btn.classList.add('active');
        }
    })
})