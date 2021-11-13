import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lMTable() {
    $.post('../../init.php', {
        listSol: ''
    }, (data) => {
        let trs = '';
        let counter = 0;

        data.reverse().forEach((d) => {
            if (counter < 20) {
                trs += `<tr>
                    <td>${d.id_soli}</td>
                    <td>${d.titulo_soli}</td>
                    <td class="desc_col">${d.desc_soli}</td>
                    <td>${d.desc_lugar}</td>
                    <td>${d.nom_tipo}</td>
                    <td>${d.fecha_ini_soli}</td>
                    <td>${d.fecha_fin_soli == null ? `<span class="null">NULL</span>` : d.fecha_fin_soli}</td>
                </tr>`;

                counter++;
            }
        });

        $('.top-tr').nextAll().remove();
        $('.top-tr').after(trs);
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lMTable();

    $.post('../../init.php', {
        listSol: ''
    }, (data) => {
        $('.data_req h1').html(data.length);
    }, 'json');

    $.post('../../init.php', {
        getOffice: ''
    }, (data) => {
        $('.data_offices h1').html(data.length);
    }, 'json');

    $.post('../../init.php', {
        listEquip: ''
    }, (data) => {
        $('.data_equipment h1').html(data.length);
    }, 'json');

    $.post('../../init.php', {
        listFail: ''
    }, (data) => {
        $('.data_fails h1').html(data.length);
    }, 'json');
});

$('.js-tilt').tilt({
    glare: true,
    maxGlare: .5
});
