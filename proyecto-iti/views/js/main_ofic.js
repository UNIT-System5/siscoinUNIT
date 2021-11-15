import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lEquip() {
    let trList = '';

    $.post('../../init.php', {
        gRFO: ''
    }, (data) => {
        data.reverse().forEach((d) => {
            trList += `<tr>
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
        $('.top-tr').after(trList);
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lEquip();

    $.post('../../init.php', {
        lEquipFM: ''
    }, (data) => {
        $('.data_equipment h1').html(data.length);
    }, 'json');

    $.post('../../init.php', {
        gRFO: ''
    }, (data) => {
        $('.data_requests h1').html(data.length);
    }, 'json');

    $.post('../../init.php', {
        gFFO: ''
    }, (data) => {
        $('.data_fails h1').html(data.length);
    }, 'json')
});

$('.js-tilt').tilt({
    glare: true,
    maxGlare: .5
});