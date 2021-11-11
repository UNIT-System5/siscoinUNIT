import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lOffices(e = true) {
    let table2 = '';
    let sols = '';
    let iconFail = '';
    let iconSoli = '';

    if (e == true) {
        var call = $.post('../../init.php', {
            getOffice: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.forEach((d) => {
            if (d.grupo_lugar == 'Oficina') {
                sols = `<div class="det_sol info">
                    <h3>Pending Requests</h3><span>${d.sol_pen}</span>
                </div>
                <div class="det_fail info">
                    <h3>Pending Failures</h3><span>${d.fal_pen}</span>
                </div>`
            } else {
                sols = '';
            }

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
                    <div class="det_eq info">
                        <h3>Installed Equipment</h3><span ${d.eq_inst < 15 ? 'class="norm"' :
                        d.eq_inst < 30 ? 'class="med"' : 'class="many"'}>${d.eq_inst} ${d.eq_inst >= 40 ?
                        '<i class="fas fa-exclamation-triangle warn_many" title="Equipment limit reached"></i>' : ''}</span>
                    </div>
                    ${sols}
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

function lDeparts() {
    return $.post('../../init.php', {
        getDepart: ''
    }, (data) => {
    }, 'json');
}

function insertNOff() {
    let lGroups = '';
    let lDepart = '';

    $.post('../../init.php', {
        getGroups: ''
    }, (data) => {
        data.forEach((d) => {
            lGroups += `<option value="${d.id_grupo}">${d.nom_grupo}</option>`;
        });

        lDeparts().done((data) => {
            data.forEach((d) => {
                lDepart += `<option value="${d.id_dep}">${d.nom_dep}</option>`;
            });

            let offContainer = `<div class="offContainer">
                <form action="../../init.php" method="POST" id="offForm" autocomplete="off">
                    <i class="fas fa-times"></i>
                    <div class="formTitle">
                        <h2>Add Office</h2>
                    </div>
                    <fieldset>
                        <div class="firstInG">
                            <input type="text" class="nomOff" placeholder="Office Name" required
                            minlength="1" maxlength="20">
                            <div class="selectGroup">
                                <select class="gOff" required>
                                    <option value="" selected disabled>Select a Group</option>
                                    ${lGroups}
                                </select>
                            </div>
                        </div>
                        <div class="selectDep">
                            <select class="depOff" required>
                                <option value="" disabled selected>Select a Department</option>
                                ${lDepart}
                            </select>
                        </div>
                        <input type="text" class="dirOff" required placeholder="Address"
                        minlength="1" maxlength="40">
                        <div class="secondInG">
                            <input type="text" class="cityOff" required placeholder="City"
                            minlength="1" maxlength="40">
                            <input type="tel" required placeholder="Phone"
                            minlength="8" maxlength="9" pattern="[0-9]{8,9}" class="phoneOff">
                        </div>
                    </fieldset>
                    <button class="crOff" type="submit"><i class="fas fa-plus"></i>
                    <i class="fas fa-building"></i></button>
                </form>
            </div>`;

            $('.container1').prepend(offContainer);
            $('.offContainer').fadeTo(400, 1);
        });
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lOffices();
});

$('body').on('click', '.aOffic', () => {
    insertNOff();
});

$('body').on('click', '#offForm .fa-times', () => {
    $('.offContainer').toggleClass('active');
    setTimeout(() => {
        $('.offContainer').fadeTo(400, 0, () => {
            $('.offContainer').remove();
        });
    }, 500);
});

$('body').on('submit', '#offForm', function(e) {
    e.preventDefault();

    let nomOff = $('.nomOff').val();
    let gOffID = $('.gOff').val();
    let gOffN = $('.gOff option:selected').text();
    let depOffID = $('.depOff').val();
    let depOffN = $('.depOff option:selected').text();
    let dirOff = $('.dirOff').val();
    let cityOff = $('.cityOff').val();
    let phoneOff = $('.phoneOff').val();

    $.post('../../init.php', {
        inNewO: '',
        descO: nomOff,
        groupO: gOffN,
        groupID: gOffID,
        dirO: dirOff,
        depO: depOffN,
        cityO: cityOff,
        telO: phoneOff,
        depID: depOffID
    }, () => {
        lOffices();

        $('.crOff i').fadeTo(200, 0, () => {
            $('.crOff').html('<i class="fas fa-check"></i>');
            $('.crOff i').fadeTo(200, 1);
            $('.crOff').css({
                'background-color': '#28c730',
                'pointer-events': 'none'
            });
            setTimeout(() => {
                $('.crOff i').fadeTo(200, 0, () => {
                    $('.crOff').html('<i class="fas fa-plus"></i><i class="fas fa-building"></i>');
                    $('.crOff i').fadeTo(200, 1);
                    $('.crOff').removeAttr('style');
                });
            }, 1500);
        });

        $('.nomOff').val('');
        $('.gOff').val('');
        $('.depOff').val('');
        $('.dirOff').val('');
        $('.cityOff').val('');
        $('.phoneOff').val('');
    });
});