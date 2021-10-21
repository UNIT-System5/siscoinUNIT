import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lRequests() {
    $.post('../../init.php', {
        getReq: ''
    }, (data) => {
        let lDCard = '';
        let count = 0;

        data.forEach((d) => {
            count += 1;
            if (!(count > 6)) {
                lDCard += `<div class="card_req">
                    <div class="section1">
                        <h1>${d.tipo_soli}</h1>
                        <span>${d.desc_soli}</span>
                    </div>
                    <div class="section2">
                        <button class="accept" value="${d.id_soli}"><i class="fas fa-check"></i></button>
                        <button class="reject" value="${d.id_soli}"><i class="fas fa-times"></i></button>
                    </div>
                </div>`
            }
        });

        let empty = `<div class="emptyReq">
            <h1>There's no requests</h1>
        </div>`;

        if ($.isEmptyObject(data)) {
            $('.requestValidator').html(empty);
        } else {
            $('.requestValidator').html(lDCard);
            $('.card_req').css('opacity', '0');
            $('.card_req').fadeTo(400, 1);
        }

        $('.data_requests h1').html(data.length);
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lRequests();
});

$('body').on('click', '.accept', function() {
    let id = $(this).val();

    $.post('../../init.php', {
        changeSR: id,
        state: 'Pendiente Info'
    }).done(() => {
        $('.card_req').fadeTo(400, 0);
        lRequests();
    });
});

$('body').on('click', '.reject', function() {
    let id = $(this).val();
    console.log(id);

    $.post('../../init.php', {
        changeSR: id,
        state: 'Rechazado'
    }).done(() => {
        $('.card_req').fadeTo(400, 0);
        lRequests();
    });
});