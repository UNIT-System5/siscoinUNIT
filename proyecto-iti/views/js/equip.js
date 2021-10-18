import { header, homeRedir, profilePic } from "./modules/header.js";

header();
homeRedir();

function lSendSol() {
    let sendSol = `<div class="equipRequest">
            <form action="../../init.php" method="POST" id="equipForm" autocomplete="off">
                <i class="fas fa-times"></i>
                <div class="formTitle">
                    <h2>Realizar Solicitud</h2>
                </div>
                <fieldset>
                    <input required type="text" name="titSol" class="titSol"
                    minlength="1" maxlength="30" placeholder="Ingrese título">
                    <div class="textArea" data-before="180">
                        <textarea required name="descSol" class="descSol"
                        minlength="1" maxlength="180" placeholder="Ingrese descripción"></textarea>
                    </div>
                </fieldset>
                <button type="submit" class="sendSol"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>`;
    
    $('.container1').prepend(sendSol);
    $('.equipRequest').fadeTo(400, 1);
}

$(window).on('load', () => {
    profilePic();
});

$('body').on('click', '.rBtn', () => {
    lSendSol();
});

$('body').on('click', '.equipRequest .fa-times', () => {
    $('.equipRequest').toggleClass('active');
    setTimeout(() => {
        $('.equipRequest').fadeTo(400, 0, () => {
            $('.equipRequest').remove();
        });
    }, 500);
});

$('body').on('keyup', '.descSol', function() {
    let letters = $(this).val().length;
    let total = 180 - letters;

    $('.textArea').attr('data-before', total);

    if (total <= 80 && total > 30) {
        $('html').attr('style', '--areaColor: #ff9216');
    } else if (total <= 30 && total > 0) {
        $('html').attr('style', '--areaColor: #e61010');
    } else if (total == 0) {
        $('html').attr('style', '--areaColor: #b1b1b1')
    } else if (total > 80) {
        $('html').attr('style', '--areaColor: #110f30')
    }
});

$('body').on('submit', '#equipForm', function(e) {
    e.preventDefault();
});

