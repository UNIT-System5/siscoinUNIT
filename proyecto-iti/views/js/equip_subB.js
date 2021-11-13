import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lEquip(e = true) {
    let trList = '';
    
    if (e == true) {
        var call = $.post('../../init.php', {
            lEquipFM: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call = $.post('../../init.php', {
            lEquipFSB: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.forEach((d) => {
            trList += `<tr>
                <td>${d.id_equip}</td>
                <td>${d.desc_equip}</td>
                <td>${d.marca_equip}</td>
                <td>${d.fecha_adq}</td>
                <td>${d.estado_equip}</td>
                <td>${d.lugar_equip == null ? `<span class="null">NULL</span>` : d.lugar_equip}</td>
            </tr>`;
        });

        $('#headertr').nextAll().remove();
        $('#headertr').after(trList);
    });
}

$(window).on('load', () => {
    profilePic();
    lEquip();
});

$('body').on('click', '.lBtn', () => {
    lEquip(false);

    $('.lBtn').html('List Own <i class="fas fa-align-left"></i>');
    $('.lBtn').attr('title', 'List Own');

    $('.lBtn').removeClass().addClass('lBtn2');
});

$('body').on('click', '.lBtn2', () => {
    lEquip();

    $('.lBtn2').html('List All <i class="fas fa-align-left"></i>');
    $('.lBtn2').attr('title', 'List All');

    $('.lBtn2').removeClass().addClass('lBtn');
});