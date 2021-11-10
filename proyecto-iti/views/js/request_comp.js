import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lRequests(e = true) {
    let table2 = '';
    let iconEstado = '';
    let estado = '';
    let acc = '';

    if (e == true) {
        var call = $.post('../../init.php', {
            getReqComp: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call = $.post('../../init.php', {
            getReqCompA: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.reverse().forEach((d) => {
            switch (d.estado_soli) {
                case 'Pendiente Compras':
                    iconEstado = 'fas fa-clock';
                    estado = 'Pendiente';
                    break;

                case 'Rechazada':
                    estado = 'Rechazada';
                    iconEstado = 'fas fa-times';
                    break;

                case 'Aceptada':
                    estado = 'Aceptada';
                    iconEstado = 'fas fa-check';
                    break;

                case 'Realizada':
                    estado = 'Realizada';
                    iconEstado = 'fas fa-check';
                    break;

                case 'Recibida':
                    estado = 'Recibida';
                    iconEstado = 'fas fa-inbox';
                    break;
            }

            if (estado == 'Pendiente') {
                acc = `<div class="det_acc info">
                    <button class="accept" title="Aceptar Solicitud"
                    value="${d.id_soli}" type="button" name="accept">
                    <i class="fas fa-check"></i></button>
                </div>`;
            } else {
                acc = '';
            }

            table2 += `<details>
                <summary>
                    <table>
                        <tr id="${d.id_soli}">
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
                    ${acc}
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

    $('.lBtn').html('List Pending <i class="fas fa-clock"></i>');
    $('.lBtn').attr('title', 'List Pending');

    $('.lBtn').removeClass().addClass('lBtn2');
});

$('body').on('click', '.lBtn2', () => {
    lRequests();

    $('.lBtn2').html('List All <i class="fas fa-align-left"></i>');
    $('.lBtn2').attr('title', 'List All');

    $('.lBtn2').removeClass().addClass('lBtn');
});

$('body').on('click', '.accept', function() {
    let id = $(this).val();

    if ($(`#${id} .tit_col span`).text() == 'Registrar Equipamiento') {
        $.post('../../init.php', {
            getReqFID: '',
            id: id
        }, (data) => {
            $.post('../../init.php', {
                changeSR: data[0].fk_soli,
                state: 'Pendiente Info'
            }).done(() => {
                if ($('.lBtn').length) {
                    lRequests();
                } else if ($('.lBtn2').length) {
                    lRequests(false);
                }
            });

            $.post('../../init.php', {
                changeSR: id,
                state: 'Realizada'
            });
        }, 'json');
    } else {
        $.post('../../init.php', {
            changeSR: id,
            state: 'Recibida'
        }).done(() => {
            if ($('.lBtn').length) {
                lRequests();
            } else if ($('.lBtn2').length) {
                lRequests(false);
            }
        });
    }
});