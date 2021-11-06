//Change input type from password to text.
$('.showPass').click(() => {
    console.log('click');
    if ($('#iconEye').hasClass('fa-eye-slash')) {
        $('#iconEye').removeClass('fa-eye-slash').addClass('fa-eye');
        $('.password').attr('type', 'text');
    } else if ($('#iconEye').hasClass('fa-eye')) {
        $('#iconEye').removeClass('fa-eye').addClass('fa-eye-slash');
        $('.password').attr('type', 'password');
    }
});

$('body').on('submit', (e) => {
    e.preventDefault();

    let mail = $('.mail').val();
    let pass = $('.password').val();

    $.post('init.php', {
        login: '',
        mail: mail,
        pass: pass
    }, (data) => {
        if (data != 'error') {
            let success = `<div class="sucss">
                <div class="svgContainer">
                    <div class="svg1">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 1000 1000" style="enable-background:new 0 0 1000 1000;" xml:space="preserve">
                            <path class="t_circle" d="M67.5,594.01c-10.02-46.22-12.76-94.84-7.08-144.43C88.26,206.38,307.99,31.8,551.19,59.65
                                s417.78,247.57,389.93,490.77S693.55,968.2,450.35,940.35c-114.55-13.12-213.88-68.8-284-149.46"/>
                        </svg>
                    </div>
                    <div class="svg2">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 1000 1000" style="enable-background:new 0 0 1000 1000;" xml:space="preserve">
                            <polyline class="tick" points="242.35,517.45 402.92,678.01 758.59,322.34 "/>
                        </svg>
                    </div>
                </div>
            </div>`;

            $('.container1').prepend(success);
            $('.sucss').fadeTo(200, 1);

            setTimeout(() => {
                location.href = '.';
            }, 2900);
        } else {
            $('.errM h2').html('Your password is incorrect')
            $('.errM').focus();
            setTimeout(() => {
                $('.errM').blur();
            }, 5000);
        }
    }, 'json');
});