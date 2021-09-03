function ProfileClick() {
    const clickProfile = document.querySelector('.signin');
    clickProfile.classList.toggle('active');
}

function MenuClick() {
    const clickMenu = document.querySelector('.menu');
    clickMenu.classList.toggle('active');
}

function viewPass() {
    if (document.querySelector('#uwu').classList.contains('fa-eye-slash')) {
        const iconChange = document.querySelector('#uwu');
        iconChange.classList.replace('fa-eye-slash', 'fa-eye');
        const passView = document.querySelector('.password');
        passView.setAttribute('type', 'text');
    } else if (document.querySelector('#uwu').classList.contains('fa-eye')) {
        const changeIcon = document.querySelector('#uwu');
        changeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        const passView = document.querySelector('.password');
        passView.setAttribute('type', 'password');
    }
}

function searchBar() {
    document.querySelector('.searchbar input').focus();
}