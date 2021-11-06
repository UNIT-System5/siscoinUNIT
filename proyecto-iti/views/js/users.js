import { header, homeRedir, profilePic } from './modules/header.js';

header();
homeRedir();

function lUserTable(e) {
    $.post('../../init.php', {
        userCount: ''
    }, (data) => {
        let tableData = '';

        data.forEach((d) => {
            tableData += `<tr id="${d.id_user}">
                <td>${d.id_user}</td>
                <td>${d.grupo_user}</td>
                <td>${d.desc_lugar}</td>
                <td>${d.mail_user}</td>
                <td>${d.nom_comp_user}</td>
                <td class="tdBtns">
                    <button class="iMod" value="${d.id_user}">
                    <i class="fas fa-pencil-alt"></i></button>
                    <button class="delIcon" name="delUser"
                    value="${d.id_user}"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`;
        });

        let tableDiv = `<div class="table">
                <table>
                    <tr>
                        <th class="id_th">ID <i class="fas fa-hashtag"></i></th>
                        <th class="group_th">Group <i class="fas fa-users"></i></th>
                        <th class="office_th">Office <i class="fas fa-building"></i></th>
                        <th class="mail_th">E-Mail <i class="fas fa-at"></i></th>
                        <th class="name_th">Name <i class="fas fa-user"></i></th>
                        <th></th>
                    </tr>
                    ${tableData}
                </table>
            </div>`;

        let tableUser = `<form action="../../init.php" id="formUser" method="POST"></form>
            <div class="switchBtns">
                <button class="btnCreate">Create User<i class="fas fa-plus"></i></button>
            </div>
            <div class="tableUser">
                ${tableDiv}
            </div>`;
        
        let emptyUser = `<form action="../../init.php" id="formUser" method="POST"></form>
            <div class="switchBtns">
                <button class="btnCreate">Create User<i class="fas fa-plus"></i></button>
            </div>
            <div class="emptyUser">
                <h1>There's no users</h1>
            </div>`;
        
        if ($.isEmptyObject(data)) {
            $('.container1').html(emptyUser);
        } else {
            if (e == true) {
                $('body .tableUser').html(tableDiv);
                $('.tableUser tr td').css('opacity', '0');
                $('.tableUser tr td').fadeTo(200, 1);
            } else {
                $('.container1').html(tableUser);
            }
        }
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    
    lUserTable(false);
});

function gGroups() {
    return $.post('../../init.php', {
        getGroups: ''
    }, (data) => {  
    }, 'json');
}

function cOffices(id) {
    return $.post('../../init.php', {
        getOWG: '',
        id: id
    }, (data) => {
    }, 'json');
}

$('body').on('click', '.iMod', function() {
    let idM = $(this).val();
    let lGroups = '';
    let lOffices = '';

    lUserTable(false);

    gGroups().done((data) => {
        data.forEach((d) => {
            lGroups += `<option value="${d.id_grupo}">${d.nom_grupo}</option>`
        });

        cOffices().done((data) => {
            data.forEach((d) => {
                lOffices += `<option value="${d.id_lugar}">${d.desc_lugar}</option>`
            });

            $.post('../../init.php', {
                getUserS: '',
                id: idM
            }, (data) => {
                let inputMod = `<td>${data[0].id_user}</td>
                    <td>
                        <div class="selectMod">
                            <select name="mGroup" class="modG" form="formUser" required>
                                <option value="" disabled selected>Select a Group</option>
                                ${lGroups}
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="selectMod">
                            <select name="mOfic" class="modO" form="formUser" required>
                                <option value="" disabled selected>Select an Office</option>
                                ${lOffices}
                            </select>
                        </div>
                    </td>
                    <td>
                        <input required type="email" name="mMail" placeholder="Insert E-Mail"
                        maxlength="35" form="formUser" class="modE" value="${data[0].mail_user}">
                    </td>
                    <td>
                        <input required type="text" name="mName" placeholder="Insert Name"
                        maxlength="40" form="formUser" class="modN" value="${data[0].nom_comp_user}">
                    </td>
                    <td class="tdBtns">
                        <button type="submit" form="formUser" class="mod" value="${data[0].id_user}">
                        <i class="fas fa-check"></i></button>
                        <button class="quitMod" value="${data[0].id_user}">
                        <i class="fas fa-times"></i></button>
                    </td>`;
                
                $(`#${idM} td:not(:first-child)`).fadeTo(100, 0, () => {
                    $(`#${idM}`).html(inputMod);

                    $(`#${idM} input`).add(`#${idM} .selectMod`).
                    add(`#${idM} .fa-check`).add(`#${idM} .fa-times`).fadeTo(100, 1);
        
                    $('.modG').val(data[0].fk_grupo);
                    $('.modO').val(data[0].fk_ofic);
                });
            }, 'json');
        });
    });
});

$('body').on('click', '.quitMod', function() {
    lUserTable(true);
});

$('body').on('submit', '#formUser', (e) => {
    e.preventDefault();

    let id = $('.mod').val();
    let group = $('.modG').val();
    let office = $('.modO').val();
    let email = $('.modE').val();
    let name = $('.modN').val();

    $.post('../../init.php', {
        mod: id,
        mGroup: group,
        mOfic: office,
        mMail: email,
        mName: name
    }, () => {
        lUserTable(true);
        profilePic();
    });
});

function gUserS(id) {
    return $.post('../../init.php', {
        getUserS: '',
        id: id
    }, (data) => {
    }, 'json');
}

function gMail() {
    return $.post('../../init.php', {
        getMail: ''
    }, (data) => {
    }, 'json');
}

$('body').on('click', '.delIcon', function() {
    let id = $(this).val();
    let mail = '';

    gUserS(id).done((data) => {
        let mailU = '';
        let groupU = '';

        data.forEach((d) => {
            mailU += d.mail_user;
            groupU += d.grupo_user;
        });

        gMail().done((data) => {
            mail += data;
            
            if ((mailU == mail) || (groupU == 'Director')) {
                $(`#${id} .delIcon`).html(
                    `<i class="fas fa-exclamation-triangle"></i>
                    <span>This user can't be removed</span>`);
                $(`#${id} .delIcon`).removeClass('delIcon').addClass('warnIcon');
                $('.fa-exclamation-triangle').fadeTo(400, 1);
                setTimeout(() => {
                    $(`#${id} .warnIcon`).fadeTo(400, 0);
                    setTimeout(() => {
                        $(`#${id} .warnIcon`).html(`<i class="fas fa-trash"></i>`);
                        $(`#${id} .warnIcon`).removeClass('warnIcon').addClass('delIcon');
                        $(`#${id} .delIcon`).css('opacity', '0');
                        $(`#${id} .delIcon`).fadeTo(400, 1);
                    }, 400);
                }, 5000);
            } else {
                let sure = `<div class="sure">
                    <div class="content">
                        <h2>Are you sure about deleting this user?</h2>
                        <div class="sBtns">
                            <button type="button" class="yes" value="${id}">Yes</button>
                            <button type="button" class="no">No</button>
                        </div>
                    </div>
                </div>`;

                $('.container1').prepend(sure);

                $('.sure').fadeTo(400, 1);
            }
        });
    });
});

$('body').on('click', '.sure .no', function() {
    $('.sure').fadeTo(400, 0, () => {
        lUserTable(false);
    });
});

$('body').on('click', '.sure .yes', function() {
    let id = $(this).val();

    $.post('../../init.php', {
        delUser: id
    }, () => {
        lUserTable(false);
    });
});

function cUserTable() {
    $.post('../../init.php', {
        getCreate: ''
    }, (data) => {
        let lOptions = '';

        data.forEach((d) => {
            lOptions += `<option value="${d.id_grupo}">${d.nom_grupo}</option>`;
        });

        let formCreate = `<div class="formCreate">
            <form action="../../init.php" method="POST" id="formCreate" autocomplete="off">
                <button type="button" class="closeForm"><i class="fas fa-times"></i></button>
                <h2>Create User</h2>
                <input required type="text" name="cName" placeholder="Insert Name"
                maxlength="40" id="cName">
                <input required type="email" name="cMail" placeholder="Insert E-Mail"
                maxlength="35" id="cMail">
                <input required type="password" name="cPass" placeholder="Insert Password"
                maxlength="24" id="cPass">
                <div class="selectCreate">
                    <select name="cGroup" id="cGroup" required>
                        <option value="" disabled selected>Select a Group</option>
                        ${lOptions}
                    </select>
                </div>
                <div class="selectOffice">
                    <select name="cOffice" id="cOffice" disabled required>
                        <option class="default" value="default" disabled selected>Select an Office</option>
                    </select>
                </div>
                <button type="submit" class="saveUser" name="saveUser">Save</button>
            </form>
        </div>`;

        $('.container1').prepend(formCreate);
        $('.formCreate').fadeTo(400, 1);
    },'json');
}

$('body').on('click', '.btnCreate', () => {
    cUserTable();
});

$('body').on('click', '.closeForm', () => {
    $('.formCreate').toggleClass('active');
    setTimeout(() => {
        $('.formCreate').fadeTo(400, 0, () => {
            lUserTable(false);
        });
    }, 500);
});

$(document.body).on('change',"#cGroup", function(e) {
    let lOffices = '';

    if ($('#cGroup option:selected')) {
        let id = $('#cGroup').val();

        cOffices(id).done((data) => {
            data.forEach((d) => {
                lOffices += `<option value="${d.id_lugar}">${d.desc_lugar}</option>`
            });

            $('#cOffice').val('default');
            $('#cOffice .default').nextAll().remove();
            $('#cOffice .default').after(lOffices);
            $('#cOffice').removeAttr('disabled');
        });
    }
});

$('body').on('submit', '#formCreate', (e) => {
    e.preventDefault();

    let mail = $('#cMail').val();
    let pass = $('#cPass').val();
    let name = $('#cName').val();
    let office = $('#cOffice').val();
    let group = $('#cGroup').val();

    $.post('../../init.php', {
        saveUser: '',
        cMail: mail,
        cPass: pass,
        cName: name,
        cOfic: office,
        cGroup: group
    }, () => {
        $('.saveUser').html('<i class="fas fa-check"></i>');
        $('.saveUser').css({
            'background-color': '#28c730',
            'pointer-events': 'none'
        });

        setTimeout(() => {
            $('.saveUser').html('Save');
            $('.saveUser').removeAttr('style');
        }, 2000);

        lUserTable(true);
        
        $('#cMail').val('');
        $('#cPass').val('');
        $('#cName').val('');
        $('#cOffice').val('');
        $('#cGroup').val('');
    });
});