import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lRequests(e = true) {
    let table2 = '';
    let iconEstado = '';
    let estado = '';

    if (e == true) {
        var call = $.post('../../init.php', {
            gRPFS: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.reverse().forEach((d) => {
            switch (d.estado_soli) {
                case 'Pendiente SubA':
                    iconEstado = 'fas fa-clock';
                    estado = 'Pendiente';
                    break;
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
                    <div class="det_acc_dec info">
                        <button class="accept" title="Aceptar Solicitud"
                        value="${d.id_soli}" type="button" name="accept">
                        <i class="fas fa-check"></i></button>
                        <button class="decline" title="Rechazar Solicitud"
                        value="${d.id_soli}" type="button" name="decline">
                        <i class="fas fa-times"></i></button>
                    </div>
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

$('body').on('click', '.decline', function() {
    let id = $(this).val();

    $.post('../../init.php', {
        changeSR: id,
        state: 'Rechazada'
    }).done(() => {
        $('.card_req').fadeTo(400, 0);
        lRequests();
    });
});