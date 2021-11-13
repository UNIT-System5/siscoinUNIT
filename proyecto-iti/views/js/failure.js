import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lFailures(e = true) {
    let table2 = '';
    let iconEstado = '';
    let estado = '';
    let acc_dec = '';

    if (e == true) {
        var call = $.post('../../init.php', {
            listFailP: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call = $.post('../../init.php', {
            listFail: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.reverse().forEach((d) => {
            switch (d.estado_fallo) {
                case 'Pendiente Info':
                    iconEstado = 'fas fa-clock';
                    estado = 'Pendiente';
                    break;

                case 'Rechazado':
                    estado = 'Rechazado';
                    iconEstado = 'fas fa-times';
                    break;

                case 'Aceptado':
                    estado = 'Aceptado';
                    iconEstado = 'fas fa-check';
                    break;
            }

            acc_dec = `<div class="det_acc_dec info">
                <button class="accept" title="Accept Report"
                value="${d.id_fallo}" id="${d.fk_equip}" type="button" name="accept">
                <i class="fas fa-check"></i></button>
                <button class="decline" title="Reject Report"
                value="${d.id_fallo}" type="button" name="decline">
                <i class="fas fa-times"></i></button>
            </div>`;

            table2 += `<details>
                <summary>
                    <table>
                        <tr>
                            <td class="st_col"><span><i title="${estado}" class="${iconEstado}"></i></span></td>
                            <td class="id_col"><span>${d.id_fallo}</span></td>
                            <td class="tipo_col"><span>${d.equip_fallo}</span></td>
                            <td class="desc_col"><span>${d.desc_fallo}</span></td>
                            <td class="lugar_col"><span">${d.desc_lugar}</span></td>
                            <td class="fecha_col"><span>${d.fecha_ini_fallo}</span></td>
                            <td class="fecha_col_2">${d.fecha_fin_fallo == null ? `<span class="null">NULL</span>` :
                            `<span>${d.fecha_fin_fallo}</span>`}</td>
                        </tr>
                    </table>
                </summary>
                <div class="solDetails">
                    <div class="det_id info">
                        <h3>ID</h3><span>${d.id_fallo}</span>
                    </div>
                    <div class="det_tit info">
                        <h3>Equipment Type</h3><span>${d.equip_fallo}</span>
                    </div>
                    <div class="det_desc info">
                        <h3>Description</h3><span>${d.desc_fallo}</span>
                    </div>
                    <div class="det_lugar info">
                        <h3>Office</h3><span>${d.desc_lugar}</span>
                    </div>
                    <div class="det_fecha info">
                        <h3>Initial Date</h3><span>${d.fecha_ini_fallo}</span>
                    </div>
                    <div class="det_fecha2 info">
                        <h3>Final Date</h3><span ${d.fecha_fin_fallo == null ? `class="null"` :
                        ''}>${d.fecha_fin_fallo}</span>
                    </div>
                    ${estado == 'Pendiente' ? acc_dec : ''}
                </div>
            </details>`
        });

        $('.firstTable').nextAll().remove();
        $('.firstTable').after(table2);

        $('body table td span').each(function (index, element) {
            $clamp(element, {clamp: 1});
        });
    });
}

function formAcc(id, idEq) {
    let accForm = `<div class="accContainer">
        <form method="POST" action="../../init.php" id="accForm" autocomplete="off">
            <i class="fas fa-times"></i>
            <div class="formTitle">
                <h2>Accept Failure</h2>
            </div>
            <fieldset>
                <div class="textArea" data-before="180">
                    <textarea required name="descSol2" class="descSol2"
                    minlength="1" maxlength="240" placeholder="Type final report"></textarea>
                </div>
            </fieldset>
            <button class="accBtn" id="${idEq}" value="${id}" type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>`;

    $('.container1').prepend(accForm);
    $('.accContainer').fadeTo(400, 1);
}

function formDec(id) {
    let decForm = `<div class="decContainer">
        <form method="POST" action="../../init.php" id="decForm" autocomplete="off">
            <i class="fas fa-times"></i>
            <div class="formTitle">
                <h2>Decline Failure</h2>
            </div>
            <fieldset>
                <div class="textArea" data-before="180">
                    <textarea required name="descSol" class="descSol"
                    minlength="1" maxlength="240" placeholder="Type final report"></textarea>
                </div>
            </fieldset>
            <button class="decBtn" value="${id} type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>`;

    $('.container1').prepend(decForm);
    $('.decContainer').fadeTo(400, 1);
}

$(window).on('load', () => {
    profilePic();
    lFailures();
});

$('body').on('click', '.lBtn', () => {
    lFailures(false);

    $('.lBtn').html('List Pending <i class="fas fa-clock"></i>');
    $('.lBtn').attr('title', 'List Pending');

    $('.lBtn').removeClass().addClass('lBtn2');
});

$('body').on('click', '.lBtn2', () => {
    lFailures();

    $('.lBtn2').html('List All <i class="fas fa-align-left"></i>');
    $('.lBtn2').attr('title', 'List All');

    $('.lBtn2').removeClass().addClass('lBtn');
});

$('body').on('click', '.accept', function() {
    let id = $(this).val();
    let idEq = $(this).attr('id');

    formAcc(id, idEq);
});

$('body').on('click', '#accForm .fa-times', () => {
    $('.accContainer').toggleClass('active');
    setTimeout(() => {
        $('.accContainer').fadeTo(400, 0, () => {
            $('.accContainer').remove();
        });
    }, 500);
});

$('body').on('submit', '#accForm', function(e) {
    e.preventDefault();

    let id = $('.accBtn').val();
    let report = $('.descSol2').val();
    let st = 'Aceptado';
    let idEq = $('.accBtn').attr('id');

    $.post('../../init.php', {
        accanRpF: '',
        id: id,
        report: report,
        status: st,
        idEq: idEq
    }, () => {
        if ($('.lBtn').length) {
            lFailures();
        } else if ($('.lBtn2').length) {
            lFailures(false);
        }

        $('.descSol2').val('');

        $('.accContainer').toggleClass('active');
        setTimeout(() => {
            $('.accContainer').fadeTo(400, 0, () => {
                $('.accContainer').remove();
            });
        }, 500);
    });
});

$('body').on('click', '.decline', function() {
    let id = $(this).val();

    formDec(id);
});

$('body').on('click', '#decForm .fa-times', () => {
    $('.decContainer').toggleClass('active');
    setTimeout(() => {
        $('.decContainer').fadeTo(400, 0, () => {
            $('.decContainer').remove();
        });
    }, 500);
});

$('body').on('submit', '#decForm', function(e) {
    e.preventDefault();

    let id = $('.decBtn').val();
    let report = $('.descSol').val();
    let st = 'Rechazado';

    $.post('../../init.php', {
        accanRpF: '',
        id: id,
        report: report,
        status: st
    }, () => {
        if ($('.lBtn').length) {
            lFailures();
        } else if ($('.lBtn2').length) {
            lFailures(false);
        }

        $('.descSol').val('');

        $('.decContainer').toggleClass('active');
        setTimeout(() => {
            $('.decContainer').fadeTo(400, 0, () => {
                $('.decContainer').remove();
            });
        }, 500);
    });
});