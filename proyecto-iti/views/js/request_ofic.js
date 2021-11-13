import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lRequests(e = true) {
    let table2 = '';
    let iconEstado = '';
    let estado = '';
    let finalRp = '';

    if (e == false) {
        var call = $.post('../../init.php', {
            gRFO: ''
        }, (data) => {
        }, 'json');
    } else if (e == true) {
        var call = $.post('../../init.php', {
            gRPFO: ''
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

                case 'Pendiente Info':
                    iconEstado = 'fas fa-clock';
                    estado = 'Pendiente';
                    break;

                case 'Pendiente SS':
                    iconEstado = 'fas fa-truck';
                    estado = 'Pendiente Sin Stock';
                    break;

                case 'Rechazada':
                    estado = 'Rechazada';
                    iconEstado = 'fas fa-times';
                    break;

                case 'Aceptada':
                    estado = 'Aceptada';
                    iconEstado = 'fas fa-check';
                    break;
            }

            if (!($.isEmptyObject(d.reporte_final))) {
                finalRp = `<div class="det_frp info">
                    <h3>Final Report</h3><span>${d.reporte_final}</span>
                </div>`;
            } else {
                finalRp = '';
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
                    ${finalRp}
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

$('body').on('click', '.lBtn2', () => {
    lRequests();

    $('.lBtn2').attr('title', 'List All');
    $('.lBtn2').html('List All <i class="fas fa-align-left"></i>')
    $('.lBtn2').removeClass().addClass('lBtn');
});

$('body').on('click', '.lBtn', () => {
    lRequests(false);

    $('.lBtn').attr('title', 'List Pending');
    $('.lBtn').html('List Pending <i class="fas fa-clock"></i>')
    $('.lBtn').removeClass().addClass('lBtn2');
});