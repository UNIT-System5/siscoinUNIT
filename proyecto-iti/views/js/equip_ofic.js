import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lEquip() {
    let trList = '';

    $.post('../../init.php', {
        lEquipFM: ''
    }, (data) => {
        data.forEach((d) => {
            trList += `<tr>
                <td>${d.id_equip}</td>
                <td>${d.desc_equip}</td>
                <td>${d.marca_equip}</td>
                <td>${d.fecha_adq}</td>
                <td>${d.estado_equip}</td>
                <td>${d.lugar_equip == null ? `<span class="null">NULL</span>` : d.lugar_equip}</td>
                <td><i aria-hidden="true" title="Equip is failing?"
                class="fas fa-wrench repFailI" id="${d.id_equip}"></i></td>
            </tr>`;
        });

        $('#headertr').nextAll().remove();
        $('#headertr').after(trList);
    }, 'json');
}

$(window).on('load', () => {
    profilePic();
    lEquip();
});

function lTypes() {
    return $.post('../../init.php', {
        getEquipT: ''
    }, (data) => {
    }, 'json');
}

function lSTypes() {
    return $.post('../../init.php', {
        getEquipST: ''
    }, (data) => {
    }, 'json');
}

function rEquip() {
    let listT = '';

    lTypes().done((data) => {
        data.forEach((d) => {
            listT += `<option value="${d.id_tipo}">${d.nom_tipo}</option>`;
        });

        let reqEquip = `<div class="reqEquip">
            <form method="POST" action="../../init.php" id="eqForm" autocomplete="off">
                <i class="fas fa-times"></i>
                <div class="formTitle">
                    <h2>Request Equipment</h2>
                </div>
                <fieldset>
                    <div class="inpSel">
                        <input required type="number" name="quantSol" class="quantSol"
                        min="1" max="999" placeholder="Cantidad" title="Cantidad">
                        <div class="selectType">
                            <select name="typeSol" class="typeReq" required>
                                <option value="default" disabled selected>Select a Type</option>
                                ${listT}
                            </select>
                        </div>
                    </div>
                    <div class="textArea" data-before="180">
                        <textarea required name="descSol" class="descSol"
                        minlength="1" maxlength="240" placeholder="Type Description"></textarea>
                    </div>
                </fieldset>
                <button type="submit" class="sendSol"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>`;

        $('.container1').prepend(reqEquip);
        $('.reqEquip').fadeTo(400, 1);
    });
}

function rFail(nom, marca, id) {
    let repFail = `<div class="repFail">
        <form method="POST" action="../../init.php" id="rpForm" autocomplete="off">
             <i class="fas fa-times"></i>
            <div class="formTitle">
                <h2>Report Failure</h2>
            </div>
            <fieldset>
                <input type="hidden" class="idFail" value="${id}">
                <input type="hidden" class="nomFail" value="${nom}">
                <div class="selectType">
                    <select name="typeSol" class="sTypeReq" disabled required>
                        <option selected disabled value="${id}">${nom} ${marca}</option>
                    </select>
                </div>
                <div class="textArea" data-before="180">
                    <textarea required name="descFail" class="descFail"
                    minlength="1" maxlength="240" placeholder="Type Description"></textarea>
                </div>
            </fieldset>
            <button type="submit" class="sendFail"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>`

    $('.container1').prepend(repFail);
    $('.repFail').fadeTo(400, 1);
}

$('body').on('click', '.rBtn', () => {
    rEquip();
});

$('body').on('click', '.reqEquip .fa-times', () => {
    $('.reqEquip').toggleClass('active');
    setTimeout(() => {
        $('.reqEquip').fadeTo(400, 0, () => {
            $('.reqEquip').remove();
        });
    }, 500);
});

$('body').on('keyup', '.textArea textarea', function() {
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

$('body').on('submit', '#eqForm', function(e) {
    e.preventDefault();

    let title = $('.quantSol').val() + ' ' + $('.typeReq option:selected').text();
    let id_tipo = $('.typeReq').val();
    let desc = $('.descSol').val();

    $.post('../../init.php', {
        iNR: '',
        titSol: title,
        descSol: desc,
        estSol: 'Pendiente SubA',
        fk_tipo: id_tipo
    }, () => {
        $('.quantSol').val('');
        $('.typeReq').val('default');
        $('.descSol').val('');
        $('.textArea').attr('data-before', 180);
    });

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

$('body').on('click', '.repFailI', function() {
    let id = $(this).attr('id');
    let nom = '';
    let marca = '';
    
    $.post('../../init.php', {
        gEFID: '',
        idEquip: id
    }, (data) => {
        data.forEach((d) => {
            nom += d.desc_equip;
            marca += d.marca_equip;
        });

        rFail(nom, marca, id);
    }, 'json');
});

$('body').on('click', '.repFail .fa-times', () => {
    $('.repFail').toggleClass('active');
    setTimeout(() => {
        $('.repFail').fadeTo(400, 0, () => {
            $('.repFail').remove();
        });
    }, 500);
});

$('body').on('submit', '#rpForm', function(e) {
    e.preventDefault();

    let equip = $('.nomFail').val();
    let id_tipo = $('.idFail').val();
    let desc = $('.descFail').val();

    $.post('../../init.php', {
        iNF: '',
        equipFail: equip,
        descFail: desc,
        estadoFail: 'Pendiente Info',
        idEquip: id_tipo
    }, () => {
        $('.descFail').val('');
        $('.textArea').attr('data-before', 180);
    });

    $('.sendFail i').fadeTo(200, 0, () => {
        $('.sendFail').html('<i class="fas fa-check"></i>');
        $('.sendFail i').fadeTo(200, 1);
        $('.sendFail').css({
            'background-color': '#28c730',
            'pointer-events': 'none'
        });
        setTimeout(() => {
            $('.sendFail i').fadeTo(200, 0, () => {
                $('.sendFail').html('<i class="fas fa-paper-plane"></i>');
                $('.sendFail i').fadeTo(200, 1);
                $('.sendFail').removeAttr('style');
                $('.repFail').toggleClass('active');
                setTimeout(() => {
                    $('.repFail').fadeTo(400, 0, () => {
                        $('.repFail').remove();
                    });
                }, 500);
            });
        }, 1500);
    });
});