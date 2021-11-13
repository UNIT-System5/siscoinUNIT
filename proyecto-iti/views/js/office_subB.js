import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lOffices(e = true) {
    let table2 = '';

    if (e == true) {
        var call = $.post('../../init.php', {
            listSubBOS: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call = $.post('../../init.php', {
            listSubBO: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.forEach((d) => {
            table2 += `<details>
                <summary>
                    <table>
                        <tr>
                            <td class="id_col"><span>${d.id_lugar}</span></td>
                            <td class="name_col"><span>${d.desc_lugar}</span></td>
                            <td class="group_col"><span>${d.grupo_lugar}</span></td>
                            <td class="dep_col"><span">${d.depart_lugar}</span></td>
                            <td class="city_col"><span>${d.ciudad_lugar}</span></td>
                            <td class="dir_col"><span>${d.dir_lugar}</span></td>
                            <td class="tel_col"><span>${d.tel_lugar}</span></td>
                        </tr>
                    </table>
                </summary>
                <div class="solDetails">
                    <div class="det_id info">
                        <h3>ID</h3><span>${d.id_lugar}</span>
                    </div>
                    <div class="det_name info">
                        <h3>Name</h3><span>${d.desc_lugar}</span>
                    </div>
                    <div class="det_group info">
                        <h3>Group</h3><span>${d.grupo_lugar}</span>
                    </div>
                    <div class="det_depart info">
                        <h3>Department</h3><span>${d.depart_lugar}</span>
                    </div>
                    <div class="det_city info">
                        <h3>City</h3><span>${d.ciudad_lugar}</span>
                    </div>
                    <div class="det_addr info">
                        <h3>Address</h3><span>${d.dir_lugar}</span>
                    </div>
                    <div class="det_tel info">
                        <h3>Phone Number</h3><span>${d.tel_lugar}</span>
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
    lOffices();
});

$('body').on('click', '.aOffic', () => {
    lOffices(false);

    $('.aOffic').attr('title', 'List Own');
    $('.aOffic').html('List Own <i class="fas fa-align-left"></i>');

    $('.aOffic').removeClass().addClass('aOffic2');
});

$('body').on('click', '.aOffic2', () => {
    lOffices();

    $('.aOffic2').attr('title', 'List All');
    $('.aOffic2').html('List All <i class="fas fa-align-left"></i>');

    $('.aOffic2').removeClass().addClass('aOffic');
});

