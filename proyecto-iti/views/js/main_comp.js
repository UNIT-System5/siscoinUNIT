import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lRequests() {
    $.post('../../init.php', {
        getReqComp: ''
    }, (data) => {
        let lDCard = '';
        let count = 0;

        data.forEach((d) => {
            count += 1;
            if (!(count > 6)) {

                lDCard += `<div class="card_req" id="${d.id_soli}" tabindex="10">
                    <div class="card_content">
                        <div class="front">
                            <div class="section1">
                                ${(d.desc_soli).length < 180 ? `<h1>${d.titulo_soli}</h1>`
                                : `<h1>${d.titulo_soli} <i title="Read More..." class="fas fa-info-circle"
                                id="${d.id_soli}"></i></h1>`}
                                <span>${d.desc_soli}</span>
                            </div>
                            <div class="section2">
                                <button class="accept" value="${d.id_soli}"><i class="fas fa-check"></i></button>
                                <button class="pending" value="${d.id_soli}"><i class="fas fa-clock"></i></button>
                            </div>
                        </div>
                        <div class="back" id="${d.id_soli}" tabindex="10">
                            <span>${d.desc_soli}</span>
                        </div>
                    </div>
                </div>`
            }
        });

        let empty = `<div class="emptyReq">
            <h1>There's no requests</h1>
        </div>`;

        if ($.isEmptyObject(data)) {
            $('.requestValidator').html(empty);
            $('.requestValidator').attr('style', '--grid: 1fr; --rows: minmax(11em, 1fr)');
        } else {
            $('.requestValidator').html(lDCard);
            $('.card_req').css('opacity', '0');
            $('.card_req').fadeTo(400, 1);
            $('body .section1 span').each(function (index, element) {
                $clamp(element, {clamp: 5, useNativeClamp: false});
            });
        }

        $('.data_requests h1').html(data.length);
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lRequests();

    $.post('../../init.php', {
        listEquip: ''
    }, (data) => {
        $('.data_equipment h1').html(data.length);
    }, 'json');

    $.post('../../init.php', {
        getBrand: ''
    }, (data) => {
        $('.data_brands h1').html(data.length);
    }, 'json');

    $.post('../../init.php', {
        getProv: ''
    }, (data) => {
        $('.data_providers h1').html(data.length);
    }, 'json');

    $.post('../../init.php', {
        getReqComp: ''
    }, (data) => {
        $('.data_requests h1').html(data.length);
    }, 'json');
});

$('body').on('click', '.fa-info-circle', function() {
    let idInfo = $(this).attr('id');
    $(`#${idInfo} .back`).focus();
});

$('body').on('focusin', '.back', function() {
    let id = $(this).attr('id');
    console.log(id);
    $(`#${id} .card_content`).css({
        'transform': 'rotateX(.5turn)'
    });
});

$('body').on('blur', '.back', function() {
    let id = $(this).attr('id');
    $(`#${id} .card_content`).removeAttr('style');
})


$('body').on('click', '.accept', function() {
    let id = $(this).val();

    $.post('../../init.php', {
        changeSR: id,
        state: 'Recibido'
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