import { header, homeRedir, profilePic } from "./modules/header.js";

header();
homeRedir();

function lSendSol() {
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
                            <input required type="number" name="quantSol" class="quantSol"
                            min="1" max="99999" placeholder="Cantidad" title="Cantidad">
                            <div class="selectType">
                                <select name="typeSol" class="typeReq" required>
                                    <option value="default" disabled selected>Select a Type</option>
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
        $('.equipRequest').fadeTo(400, 1);
    }, 'json');
}

function lEquip(e) {
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

        data.forEach((d) => {
            lTr += `<tr>
                <td>${d.id_equip}</td>
                <td>${d.desc_equip}</td>
                <td>${d.marca_equip}</td>
                <td>${d.fecha_adq}</td>
                <td>${d.estado_equip}</td>
                <td>${d.lugar_equip == null ? `<span class="null">NULL</span>` : d.lugar_equip}</td>
            </tr>`;
        });

        $('#headertr').nextAll().remove();
        $('#headertr').after(lTr);
    });
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

$(window).on('load', () => {
    profilePic();
    lEquip(true);
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

    $.post('../../init.php', {
        purReq: '',
        titSol: title,
        descSol: desc,
        estSol: 'Pendiente SubB',
        fk_tipo: id_tipo
    }, () => {
        $('.quantSol').val('');
        $('.typeReq').val('default');
        $('.descSol').val('');
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