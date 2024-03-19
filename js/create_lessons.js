const btnList = document.querySelectorAll('.btn-light');
        
btnList.forEach(btn => {
    btn.addEventListener('click', () => {
        if (btn.classList.contains('active')) {
            btn.classList.remove('active');
            document.getElementById('timeSlots').value = document.getElementById('timeSlots').value.replace(btn.innerHTML + '|', '');
        }
        else {
            // document.querySelector('.active')?.classList.remove('active');
            btn.classList.add('active');
            document.getElementById('timeSlots').value += btn.innerHTML + '|';
        }
    })
})