import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lFailures(e = true) {
    let table2 = '';
    let iconEstado = '';
    let estado = '';
    let finalRp = '';

    if (e == false) {
        var call = $.post('../../init.php', {
            gFFO: ''
        }, (data) => {
        }, 'json');
    } else if (e == true) {
        var call = $.post('../../init.php', {
            gFPFO: ''
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
                    ${finalRp}
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

$(window).on('load', () => {
    profilePic();
    lFailures();
});

$('body').on('click', '.lBtn', () => {
    lFailures(false);

    $('.lBtn').attr('title', 'List Pending');
    $('.lBtn').html('List Pending <i class="fas fa-clock"></i>');
    $('.lBtn').removeClass().addClass('lBtn2');
});

$('body').on('click', '.lBtn2', () => {
    lFailures();

    $('.lBtn2').attr('title', 'List All');
    $('.lBtn2').html('List All <i class="fas fa-align-left"></i>');
    $('.lBtn2').removeClass().addClass('lBtn');
});