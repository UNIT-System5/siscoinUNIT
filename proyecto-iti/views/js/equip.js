import { header, homeRedir, profilePic } from "./modules/header.js";

header();
homeRedir();

function lSendSol() {
    let sendSol = `<div class="equipRequest">
            <form action="../../init.php" method="POST" id="equipForm" autocomplete="off">
                <i class="fas fa-times"></i>
                <div class="formTitle">
                    <h2>Request Equipment</h2>
                </div>
                <fieldset>
                    <input required type="text" name="titSol" class="titSol"
                    minlength="1" maxlength="30" placeholder="Ingrese título">
                    <div class="textArea" data-before="180">
                        <textarea required name="descSol" class="descSol"
                        minlength="1" maxlength="180" placeholder="Ingrese descripción"></textarea>
                    </div>
                </fieldset>
                <button type="submit" class="sendSol"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>`;
    
    $('.container1').prepend(sendSol);
    $('.equipRequest').fadeTo(400, 1);
}

function lEquip() {
    $.post('../../init.php', {
        listEquip: ''
    }, (data) => {
        let lTr = '';

        data.forEach((d) => {
            lTr += `<tr>
                <td>${d.id_equip}</td>
                <td>${d.desc_equip}</td>
                <td>${d.marca_equip}</td>
                <td>${d.fecha_adq}</td>
                <td>${d.estado_equip}</td>
                <td>${d.lugar_equip}</td>
            </tr>`;
        });

        let listEquip = `<div class="rEquip">
            <button class="rBtn">Request<i class="fas fa-plus"></i></button>
            <button class="aBtn">Add Type<i class="fas fa-plus"></i></button>
        </div>
        <div class="tableEquip">
            <div class="table">
                <table>
                    <tr>
                        <th class="id_th">ID</th>
                        <th class="desc_th">Descripción</th>
                        <th class="marca_th">Marca</th>
                        <th class="fecha_th">Adquirido</th>
                        <th class="estado_th">Estado</th>
                        <th class="lugar_th">Lugar</th>
                    </tr>
                    ${lTr}
                </table>
            </div>
        </div>`;

        console.log('a');

        $('.container1').prepend(listEquip);
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

$(window).on('load', () => {
    profilePic();
    lEquip();
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
    } else if (total == 0) {
        $('html').attr('style', '--areaColor: #b1b1b1')
    } else if (total > 80) {
        $('html').attr('style', '--areaColor: #110f30')
    }
});

$('body').on('submit', '#equipForm', function(e) {
    e.preventDefault();

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