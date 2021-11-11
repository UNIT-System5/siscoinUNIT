import { header, homeRedir, profilePic } from "./modules/header.js";

header();
homeRedir();

function lSendSol(quant = '', eID = 'default', id = '') {
    let lTypes = '';

    $.post('../../init.php', {
        getEquipT: ''
    }, (data) => {
        data.forEach((d) => {
            lTypes += `<option value="${d.id_tipo}">${d.nom_tipo}</option>`;
        });

        let sendSol = `<div class="equipRequest">
                <form action="../../init.php" method="POST" id="equipForm" autocomplete="off">
                    <i class="fas fa-times"></i>
                    <div class="formTitle">
                        <h2>Request Equipment</h2>
                    </div>
                    <fieldset>
                        <div class="inpSel">
                            ${!($.isEmptyObject(id)) ? `<input type="hidden" required name="fk_soli"
                            class="fk_soli" value="${id}">` : ''}
                            <input required type="number" name="quantSol" class="quantSol"
                            min="1" max="99999" placeholder="Cantidad" title="Cantidad" value="${quant}">
                            <div class="selectType">
                                <select class="typeReq" required>
                                    <option value="" disabled selected>Select a Type</option>
                                    ${lTypes}
                                </select>
                            </div>
                        </div>
                        <div class="textArea" data-before="180">
                            <textarea required name="descSol" class="descSol"
                            minlength="1" maxlength="240" placeholder="Ingrese descripción"></textarea>
                        </div>
                    </fieldset>
                    <button type="submit" class="sendSol"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>`;
        
        $('.container1').prepend(sendSol);
        
        if (eID > 0) {
            $('.typeReq').val(eID);
            $('.descSol').focus();
        }

        $('.equipRequest').fadeTo(400, 1);
    }, 'json');
}

function lEquip(e = true) {
    if (e == true) {
        var call = $.post('../../init.php', {
            listEquip: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call = $.post('../../init.php', {
            lEquipFM: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        let lTr = '';
        let counter = 0;
        var counter2 = 0;
        let result = '';
        let finalGuarantee = '';
        let guaranteeLeft = '';

        data.forEach((d) => {
            if ((d.garantia % 12) == 0) {
                result = Math.floor(d.garantia/12) + (Math.floor(d.garantia/12) > 1 ? ' años' : ' año');
            } else if (d.garantia > 12) {
                result = Math.floor(d.garantia/12) + (Math.floor(d.garantia/12) > 1 ? ' años' : ' año') + ' y ' +
                (d.garantia - (Math.floor(d.garantia/12) * 12)) +
                ((d.garantia - (Math.floor(d.garantia/12) * 12)) > 1 ? ' meses' : ' mes');
            } else {
                result = d.garantia + (d.garantia > 1 ? ' meses' : ' mes');
            }

            finalGuarantee = moment(d.fecha_adq).add(d.garantia, 'months');
            
            if (finalGuarantee > moment()) {
                guaranteeLeft = finalGuarantee.diff(moment(), 'days');
            } else {
                guaranteeLeft = '';
            }

            lTr += `<tr>
                <td>${d.id_equip}</td>
                <td>${d.desc_equip}</td>
                <td>${d.marca_equip}</td>
                <td>${result}</td>
                <td>${d.fecha_adq}</td>
                <td>${d.estado_equip}</td>
                <td>${d.lugar_equip == null ? `<span class="null">NULL</span>` : d.lugar_equip}</td>
                <td><div class="actions">${(guaranteeLeft < 31) && (guaranteeLeft != '') ?
                `<i title="Guarantee ends in ${guaranteeLeft} days" class="fas fa-exclamation-triangle"></i>` : ''}
                ${d.estado_equip == 'Stock' ?
                `<i title="Assign Equipment" id="${d.id_equip}"
                class="fas fa-toolbox"></i>` : ''}
                ${d.estado_equip == 'Taller' ?
                `<i title="Scrap Equipment" id="${d.id_equip}"
                class="fas fa-hammer"></i>` : ''}</div></td>
            </tr>`;
        });

        $('#headertr').nextAll().remove();
        $('#headertr').after(lTr);
    });
}

function lETotalS() {
    let nTableSE = '';
    let trSE = '';
    let total = '';

    $.post('../../init.php', {
        getEquipTotal: ''
    }, (data) => {
        data.forEach((d) => {
            total = parseInt(d.prestock, 10) + parseInt(d.stock, 10);

            trSE += `<tr>
                <td>${d.id_tipo}</td>
                <td>${d.nom_tipo}</td>
                <td>${d.prestock}</td>
                <td>${d.stock}</td>
                <td>${total}</td>
                <td>${total < 50 ? `<i title="Low Stock!" class="fas fa-exclamation-triangle"></i>` : ''}</td>
            </tr>`;
        });

        nTableSE = `<div class="rEquip">
            <button class="eBtn">List Equip <i class="fas fa-microchip"></i></button>
        </div>
        <div class="tableEquip" id="eT">
            <div class="table">
                <table>
                    <tr id="headertr">
                        <th class="id_th"><i class="fas fa-hashtag"></i> ID</th>
                        <th class="equip_th"><i class="fas fa-desktop"></i> Equipment Type</th>
                        <th class="prestock_th"><i class="fas fa-box"></i> Prestock</th>
                        <th class="stock_th"><i class="fas fa-box-open"></i> Stock</th>
                        <th class="total_th"><i class="fas fa-file-invoice"></i> Total</th>
                        <th class="warning_th"></th>
                    </tr>
                    ${trSE}
                </table>
            </div>
        </div>`;

        $('.container1').html(nTableSE);
    }, 'json');
}

function lEquipS() {
    let tableS = `<div class="rEquip">
        <button class="rBtn">Request <i class="fas fa-plus"></i></button>
        <button class="aBtn">Add Type <i class="fas fa-plus"></i></button>
        <button class="lBtn">List Own <i class="fas fa-align-left"></i></button>
        <button class="tBtn">List Types <i class="fas fa-desktop"></i></button>
    </div>
    <div class="tableEquip">
        <div class="table">
            <table>
                <tr id="headertr">
                    <th class="id_th">ID</th>
                    <th class="desc_th">Description</th>
                    <th class="marca_th">Brand</th>
                    <th class="guar_th">Guarantee</th>
                    <th class="fecha_th">Acquired</th>
                    <th class="estado_th">Status</th>
                    <th class="lugar_th">Location</th>
                    <th class="actions_th"></th>
                </tr>
            </table>
        </div>
    </div>`;

    $('.container1').html(tableS);
    lEquip();
}

function gGroups() {
    return $.post('../../init.php', {
        getGroups: ''
    }, (data) => {  
    }, 'json');
}

function asignEquip(id, equip) {
    let assignContainer = '';
    let groups = '';

    gGroups().done((data) => {
        data.forEach((d) => {
            groups += `<option value="${d.id_grupo}">${d.nom_grupo}</option>`;
        });

        assignContainer = `<div class="assContainer">
            <form action="../../init.php" method="POST" id="assForm" autocomplete="off">
            <i class="fas fa-times"></i>
                <div class="formTitle">
                    <h2>Assign Equipment</h2>
                </div>
                <fieldset>
                    <input class="eqAss" type="text" value="${equip}" disabled>
                    <div class="selectGroup">
                        <select class="sGroup" required>
                            <option value="" selected disabled>Select a Group</option>
                            ${groups}
                        </select>
                    </div>
                    <div class="selectOffice">
                        <select class="sOffice" disabled required>
                            <option class="default" value="" selected disabled>Select an Office</option>
                        </select>
                    </div>
                </fieldset>
                <button class="assBtn" value="${id}" type="submit">Assign <i class="fas fa-chevron-right"></i></button>
            </form>
        </div>`;

        $('.container1').prepend(assignContainer);
        $('.assContainer').fadeTo(400, 1);
    }, 'json');
}

function lAddEquip() {
    $.post('../../init.php', {
        getEquipT: ''
    }, (data) => {
        let types = '';

        data.forEach((d) => {
            types += `<tr>
                <td>${d.nom_tipo}</td>
            </tr>`;
        });

        let addEquip = `<div class="equipAdd">
            <form action="../../init.php" method="POST" id="addForm" autocomplete="off">
                <i class="fas fa-times"></i>
                <div class="formTitle">
                    <h2>Add Equipment</h2>
                </div>
                <fieldset>
                    <input required type="text" name="" class="titSol"
                    minlength="1" maxlength="40" placeholder="Ingrese tipo">
                    <button type="submit" class="addE"><i class="fas fa-plus"></i></button>
                </fieldset>
                <div class="table">
                    <table>
                        <tr>
                            <th>Nombre Tipo</th>
                        </tr>
                        ${types}
                    </table>
                </div>
            </form>
        </div>`;
    
        $('.container1').prepend(addEquip);
        $('.equipAdd').fadeTo(400, 1);
    }, 'json');
}

function cOffices(id) {
    return $.post('../../init.php', {
        getOWG: '',
        id: id
    }, (data) => {
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lEquip(true);

    let searchParams = new URLSearchParams(window.location.search);

    if (searchParams.has('aRq')) {
        let quant = searchParams.get('qt');
        let equip_id = searchParams.get('eqID');
        let id = searchParams.get('id');

        lSendSol(quant, equip_id, id);
    }
});

$('body').on('click', '.rBtn', () => {
    lSendSol();
});

$('body').on('click', '.equipRequest .fa-times', () => {
    $('.equipRequest').toggleClass('active');
    setTimeout(() => {
        $('.equipRequest').fadeTo(400, 0, () => {
            $('.equipRequest').remove();
        });
    }, 500);
});

$('body').on('keyup', '.descSol', function() {
    let letters = $(this).val().length;
    let total = 180 - letters;

    $('.textArea').attr('data-before', total);

    if (total <= 80 && total > 30) {
        $('html').attr('style', '--areaColor: #ff9216');
    } else if (total <= 30 && total > 0) {
        $('html').attr('style', '--areaColor: #e61010');
    } else if (total < 1) {
        $('html').attr('style', '--areaColor: #b1b1b1')
    } else if (total > 80) {
        $('html').attr('style', '--areaColor: #110f30')
    }
});

$('body').on('submit', '#equipForm', function(e) {
    e.preventDefault();

    let title = $('.quantSol').val() + ' ' + $('.typeReq option:selected').text();
    let id_tipo = $('.typeReq').val();
    let desc = $('.descSol').val();
    let fk_sol = '';

    if ($('.fk_soli').length) {
        fk_sol = $('.fk_soli').val();

        $.post('../../init.php', {
            purReq2: '',
            titSol: title,
            descSol: desc,
            estSol: 'Pendiente SubB',
            fk_tipo: id_tipo,
            fk_sol: fk_sol
        }, () => {
            $('.quantSol').val('');
            $('.typeReq').val('');
            $('.descSol').val('');

            location.replace('request.php');
        });
    } else {
        $.post('../../init.php', {
            purReq: '',
            titSol: title,
            descSol: desc,
            estSol: 'Pendiente SubB',
            fk_tipo: id_tipo
        }, () => {
            $('.quantSol').val('');
            $('.typeReq').val('');
            $('.descSol').val('');
        });
    }

    $('.sendSol i').fadeTo(200, 0, () => {
        $('.sendSol').html('<i class="fas fa-check"></i>');
        $('.sendSol i').fadeTo(200, 1);
        $('.sendSol').css({
            'background-color': '#28c730',
            'pointer-events': 'none'
        });
        setTimeout(() => {
            $('.sendSol i').fadeTo(200, 0, () => {
                $('.sendSol').html('<i class="fas fa-paper-plane"></i>');
                $('.sendSol i').fadeTo(200, 1);
                $('.sendSol').removeAttr('style');
            });
        }, 1500);
    });
});

$('body').on('click', '.actions .fa-toolbox', function() {
    let id = $(this).attr('id');

    $.post('../../init.php', {
        listEquipFID: '',
        idEq: id
    }, (data) => {
        let nomEquip = data[0].desc_equip + ' ' + data[0].marca_equip;

        asignEquip(id, nomEquip);
    }, 'json');
});

$(document.body).on('change', '.sGroup', function() {
    let offices = '';

    if ($('.sGroup option:selected')) {
        let id = $('.sGroup').val();

        cOffices(id).done((data) => {
            data.forEach((d) => {
                offices += `<option value="${d.id_lugar}">${d.desc_lugar}</option>`
            });

            $('.sOffice').val('');
            $('.sOffice .default').nextAll().remove();
            $('.sOffice .default').after(offices);
            $('.sOffice').removeAttr('disabled');
        });
    }
});

$('body').on('click', '.assContainer .fa-times', () => {
    $('.assContainer').toggleClass('active');
    setTimeout(() => {
        $('.assContainer').fadeTo(400, 0, () => {
            $('.assContainer').remove();
        })
    }, 500);
});

$('body').on('submit', '#assForm', function(e) {
    e.preventDefault();

    let id = $('.assBtn').val();
    let id_office = $('.sOffice').val();
    let office = $('.sOffice option:selected').text();

    $.post('../../init.php', {
        assignEquip: '',
        id: id,
        id_office: id_office,
        office: office,
        estado: 'Instalado',
        id_estado: 4
    }, () => {
        lEquip(true);

        $('.assContainer').toggleClass('active');
        setTimeout(() => {
            $('.assContainer').fadeTo(400, 0, () => {
                $('.assContainer').remove();
            })
        }, 500);
    })
});

$('body').on('click', '.aBtn', () => {
    lAddEquip();
});

$('body').on('click', '.equipAdd .fa-times', () => {
    $('.equipAdd').toggleClass('active');
    setTimeout(() => {
        $('.equipAdd').fadeTo(400, 0, () => {
            $('.equipAdd').remove();
        })
    }, 500);
});

$('body').on('click', '.editP', () => {
    if ($('.equipAdd').length) {
        $('.equipAdd').toggleClass('active');
        setTimeout(() => {
            $('.equipAdd').fadeTo(400, 0, () => {
                $('.equipAdd').remove();
            });
        }, 500);
    } else if ($('.equipRequest').length) {
        $('.equipRequest').toggleClass('active');
        setTimeout(() => {
            $('.equipRequest').fadeTo(400, 0, () => {
                $('.equipRequest').remove();
            });
        }, 500);
    }
});

$('body').on('submit', '#addForm', function(e) {
    e.preventDefault();

    $('.addE i').fadeTo(200, 0, () => {
        $('.addE').html('<i class="fas fa-check"></i>');
        $('.addE i').fadeTo(200, 1);
        $('.addE').css({
            'background-color': '#28c730',
            'pointer-events': 'none'
        });
        setTimeout(() => {
            $('.addE i').fadeTo(200, 0, () => {
                $('.addE').html('<i class="fas fa-plus"></i>');
                $('.addE i').fadeTo(200, 1);
                $('.addE').removeAttr('style');
            });
        }, 1500);
    });

    $.post('../../init.php', {
        getEquipT: ''
    }, (data) => {
        let types = '';

        data.forEach((d) => {
            types += `<tr>
                <td>${d.nom_tipo}</td>
            </tr>`;
        });

        let typeData = `<table>
            <tr>
                <th>Nombre Tipo</th>
            </tr>
            ${types}
        </table>`
        
        $('.equipAdd form .table').html(typeData);
    }, 'json');
});

$('body').on('click', '.lBtn', () => {
    $('.lBtn', '.lBtn2').css('pointer-events', 'none');
    lEquip(false);
    $('body .lBtn').removeClass('lBtn').addClass('lBtn2')
    .html('List All <i class="fas fa-align-left"></i>');
});

$('body').on('click', '.lBtn2', () => {
    lEquip(true);
    $('body .lBtn2').removeClass('lBtn2').addClass('lBtn')
    .html('List Own <i class="fas fa-align-left"></i>');
});

$('body').on('click', '.tBtn', () => {
    lETotalS();
})

$('body').on('click', '.eBtn', () => {
    lEquipS();
})