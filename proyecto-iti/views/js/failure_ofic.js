import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lFailures(e = true) {
    let table2 = '';

    if (e == true) {
        var call = $.post('../../init.php', {
            gFFO: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call = $.post('../../init.php', {
            gFPFO: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.reverse().forEach((d) => {
            table2 += `<details>
                <summary>
                    <table>
                        <tr>
                            <td class="id_col"><span>${d.id_fallo}</span></td>
                            <td class="tipo_col"><span>${d.equip_fallo}</span></td>
                            <td class="desc_col"><span>${d.desc_fallo}</span></td>
                            <td class="lugar_col"><span">${d.desc_lugar}</span></td>
                            <td class="fecha_col"><span>${d.fecha_ini_fallo}</span></td>
                            <td class="fecha_col_2">${d.fecha_fin_fallo == null ? `<span class="null">NULL</span>` :
                            `<span>${d.fecha_fin_soli}</span>`}</td>
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
    $('.lBtn').html('List All <i class="fas fa-align-left"></i>');
    $('.lBtn').removeClass().addClass('lBtn2');
});

$('body').on('click', '.lBtn2', () => {
    lFailures();
    $('.lBtn2').html('List Pending <i class="fas fa-clock"></i>');
    $('.lBtn2').removeClass().addClass('lBtn');
});