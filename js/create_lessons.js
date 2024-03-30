const btnList = document.querySelectorAll('.btn-light');
        
btnList.forEach(btn => {
    btn.addEventListener('click', () => {
        if (btn.classList.contains('active')) {
            btn.classList.remove('active');
            document.getElementById('timeSlot').value = document.getElementById('timeSlot').value.replace(btn.innerHTML + '|', '');
        }
        else {
            // document.querySelector('.active')?.classList.remove('active');
            btn.classList.add('active');
            document.getElementById('timeSlot').value += btn.innerHTML + '|';
        }
    })
})