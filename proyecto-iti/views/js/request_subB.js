import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lRequests(e = true) {
    let table2 = '';
    let iconEstado = '';
    let estado = '';
    let acc_pen = '';

    if (e == true) {
        var call = $.post('../../init.php', {
            getReqSubB: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call = $.post('../../init.php', {
            getReqSubBA: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.reverse().forEach((d) => {
            switch (d.estado_soli) {
                case 'Pendiente SubB':
                    iconEstado = 'fas fa-clock';
                    estado = 'Pendiente';
                    break;

                case 'Pendiente SD':
                    iconEstado = 'fas fa-dollar-sign';
                    estado = 'Pendiente Sin Dinero';
                    break;
            }

            if (estado == 'Pendiente') {
                acc_pen = `<div class="det_acc_dec info">
                    <button class="accept" title="Aceptar Solicitud"
                    value="${d.id_soli}" type="button" name="accept">
                    <i class="fas fa-check"></i></button>
                    <button class="pending" title="Pendiente Sin Dinero"
                    value="${d.id_soli}" type="button" name="pend">
                    <i class="fas fa-clock"></i></button>
                </div>`;
            } else if (estado == 'Pendiente Sin Dinero') {
                acc_pen = `<div class="det_acc_dec info">
                    <button class="accept" title="Aceptar Solicitud"
                    value="${d.id_soli}" type="button" name="accept">
                    <i class="fas fa-check"></i></button>
                </div>`;
            }

            table2 += `<details>
                <summary>
                    <table>
                        <tr>
                            <td class="st_col"><span><i title="${estado}" class="${iconEstado}"></i></span></td>
                            <td class="id_col"><span>${d.id_soli}</span></td>
                            <td class="tit_col"><span>${d.titulo_soli}</span></td>
                            <td class="desc_col"><span>${d.desc_soli}</span></td>
                            <td class="lugar_col"><span">${d.desc_lugar}</span></td>
                            <td class="tipo_col"><span>${d.nom_tipo}</span></td>
                            <td class="fecha_col"><span>${d.fecha_ini_soli}</span></td>
                            <td class="fecha_col_2">${d.fecha_fin_soli == null ? `<span class="null">NULL</span>` :
                            `<span>${d.fecha_fin_soli}</span>`}</td>
                        </tr>
                    </table>
                </summary>
                <div class="solDetails">
                    <div class="det_id info">
                        <h3>ID</h3><span>${d.id_soli}</span>
                    </div>
                    <div class="det_tit info">
                        <h3>Title</h3><span>${d.titulo_soli}</span>
                    </div>
                    <div class="det_desc info">
                        <h3>Description</h3><span>${d.desc_soli}</span>
                    </div>
                    <div class="det_lugar info">
                        <h3>Office</h3><span>${d.desc_lugar}</span>
                    </div>
                    <div class="det_tipo info">
                        <h3>Equipment Type</h3><span>${d.nom_tipo}</span>
                    </div>
                    <div class="det_fecha info">
                        <h3>Initial Date</h3><span>${d.fecha_ini_soli}</span>
                    </div>
                    <div class="det_fecha2 info">
                        <h3>Final Date</h3><span ${d.fecha_fin_soli == null ? `class="null"` :
                        ''}>${d.fecha_fin_soli}</span>
                    </div>
                    ${acc_pen}
                </div>
            </details>`;
        });

        $('.firstTable').nextAll().remove();
        $('.firstTable').after(table2);

        $('body td span').each(function (index, element) {
            $clamp(element, {clamp: 1});
        });
    });
}

$(window).on('load', () => {
    profilePic();
    lRequests();
});

$('body').on('click', '.lBtn', () => {
    lRequests(false);

    $('.lBtn').attr('title', 'List Pending');
    $('.lBtn').html('List Pending <i class="fas fa-clock"></i>');
    $('.lBtn').removeClass().addClass('lBtn2');
});

$('body').on('click', '.lBtn2', () => {
    lRequests();

    $('.lBtn2').attr('title', 'List All');
    $('.lBtn2').html('List All <i class="fas fa-align-left"></i>');
    $('.lBtn2').removeClass().addClass('lBtn');
});

$('body').on('click', '.accept', function() {
    let id = $(this).val();

    $.post('../../init.php', {
        changeSR: id,
        state: 'Pendiente Compras'
    }).done(() => {
        $('.card_req').fadeTo(400, 0);
        
        if ($('.lBtn').length) {
            lRequests();
        } else if ($('.lBtn2').length) {
            lRequests(false);
        }
    });
});

$('body').on('click', '.pending', function() {
    let id = $(this).val();

    $.post('../../init.php', {
        changeSR: id,
        state: 'Pendiente SD'
    }).done(() => {
        $('.card_req').fadeTo(400, 0);
        
        if ($('.lBtn').length) {
            lRequests();
        } else if ($('.lBtn2').length) {
            lRequests(false);
        }
    });
});