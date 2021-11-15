import { header, homeRedir, profilePic } from "./modules/header.js";

header();
homeRedir();

function lEquip(e = true) {
    let listEquip = '';

    if (e == true) {
        var call = $.post('../../init.php',{
            listTEquip: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.forEach((d) => {
            listEquip += `<tr>
                <td>${d.id_equip}</td>
                <td>${d.desc_equip}</td>
                <td>${d.marca_equip}</td>
                <td>${d.fecha_adq}</td>
                <td>${d.estado_equip}</td>
            </tr>`;
        });

        $('.top-tr').nextAll().remove();
        $('.top-tr').after(listEquip);
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lEquip();
});