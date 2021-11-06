import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lMTable() {
    $.post('../../init.php', {
        listSol: ''
    }, (data) => {
        let trs = '';

        data.reverse().forEach((d) => {
            trs += `<tr>
                <td>${d.id_soli}</td>
                <td>${d.titulo_soli}</td>
                <td class="desc_col">${d.desc_soli}</td>
                <td>${d.desc_lugar}</td>
                <td>${d.nom_tipo}</td>
                <td>${d.fecha_ini_soli}</td>
                <td>${d.fecha_fin_soli == null ? `<span class="null">NULL</span>` : d.fecha_fin_soli}</td>
            </tr>`
        });

        $('.top-tr').nextAll().remove();
        $('.top-tr').after(trs);
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lMTable();

    $.post('../../init.php', {
        userCount: ''
    }, (data) => {
        $('.data_employees h1').html(data.length);
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
    }, 'json')
});
