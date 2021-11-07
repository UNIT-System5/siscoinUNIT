import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lRequests(e = true) {
    let table2 = '';
    let iconEstado = '';
    let estado = '';
    let acc_dec = '';
    let st_pr = '';

    if (e == true) {
        var call = $.post('../../init.php', {
            listSolP: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call = $.post('../../init.php', {
            listSol: ''
        }, (data) => {
        }, 'json');
    }

    call.done((data) => {
        data.reverse().forEach((d) => {
            switch (d.estado_soli) {
                case 'Pendiente Info':
                    iconEstado = 'fas fa-clock';
                    estado = 'Pendiente';
                    break;
                
                case 'Aceptada':
                    estado = 'Aceptado';
                    iconEstado = 'fas fa-check';
                    break;

                case 'Rechazada':
                    console.log(d.estado_soli);
                    iconEstado = 'fas fa-times';
                    estado = 'Rechazada';
                    break;
            }

            acc_dec = `<div class="det_acc_dec info">
                <button class="accept" id="${d.id_soli}" type="button" name="accept">
                <i class="fas fa-check"></i></button>
                <button class="decline" id="${d.id_soli}" type="button" name="decline">
                <i class="fas fa-times"></i></button>
            </div>
            <div class="det_eq_inst info">
                <h3>Installed Equipment</h3><span>${d.total_equip}</span>
            </div>`;

            st_pr = `<div class="det_stock info">
                <h3>Stock ${d.nom_tipo}</h3><span>${d.stock}</span>
            </div>
            <div class="det_prestock info">
                <h3>Prestock ${d.nom_tipo}</h3><span>${d.prestock}</span>
            </div>`;

            table2 += `<details>
                <summary>
                    <table>
                        <tr>
                            <td class="st_col"><span><i title="${estado}" class="${iconEstado}"></i></span></td>
                            <td class="id_col"><span>${d.id_soli}</span></td>
                            <td class="tit_col"><span>${d.titulo_soli}</span></td>
                            <td class="desc_col"><span>${d.desc_soli}</span></td>
                            <td class="lugar_col"><span">${d.desc_lugar}</span></td>
                            <td class="tipo_col"><span>${d.nom_tipo}</span></td>
                            <td class="fecha_col"><span>${d.fecha_ini_soli}</span></td>
                            <td class="fecha_col_2">${d.fecha_fin_soli == null ? `<span class="null">NULL</span>` :
                            `<span>${d.fecha_fin_soli}</span>`}</td>
                        </tr>
                    </table>
                </summary>
                <div class="solDetails">
                    <div class="det_id info">
                        <h3>ID</h3><span>${d.id_soli}</span>
                    </div>
                    <div class="det_tit info">
                        <h3>Title</h3><span>${d.titulo_soli}</span>
                    </div>
                    <div class="det_desc info">
                        <h3>Description</h3><span>${d.desc_soli}</span>
                    </div>
                    <div class="det_lugar info">
                        <h3>Office</h3><span>${d.desc_lugar}</span>
                    </div>
                    <div class="det_tipo info">
                        <h3>Equipment Type</h3><span>${d.nom_tipo}</span>
                    </div>
                    <div class="det_fecha info">
                        <h3>Initial Date</h3><span>${d.fecha_ini_soli}</span>
                    </div>
                    <div class="det_fecha2 info">
                        <h3>Final Date</h3><span ${d.fecha_fin_soli == null ? `class="null"` :
                        ''}>${d.fecha_fin_soli}</span>
                    </div>
                    ${estado == 'Pendiente' ? acc_dec : ''}
                    ${estado == 'Pendiente' ? st_pr : ''}
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
    lRequests();
});

$('body').on('click', '.lBtn', () => {
    lRequests(false);

    $('.lBtn').attr('title', 'List Pending');
    $('.lBtn').html('List Pending <i class="fas fa-clock"></i>')
    $('.lBtn').removeClass().addClass('lBtn2');
});

$('body').on('click', '.lBtn2', () => {
    lRequests();
    
    $('.lBtn2').attr('title', 'List All');
    $('.lBtn2').html('List All <i class="fas fa-align-left"></i>')
    $('.lBtn2').removeClass().addClass('lBtn');
});

function formAcc() {
    let accForm = `<div class="accContainer">
        <form method="POST" action="../../init.php" id="accForm" autocomplete="off">
            <i class="fas fa-times"></i>
            <h2>Accept Request</h2>
            <fieldset>
                
            </fieldset>
        </form>
    </div>`
}

function formDec(id) {
    let decForm = `<div class="decContainer">
        <form method="POST" action="../../init.php" id="decForm" autocomplete="off">
            <i class="fas fa-times"></i>
            <div class="formTitle">
                <h2>Decline Request</h2>
            </div>
            <fieldset>
                <div class="textArea" data-before="180">
                    <textarea required name="descSol" class="descSol"
                    minlength="1" maxlength="240" placeholder="Type final report"></textarea>
                </div>
            </fieldset>
            <button class="decBtn" value="${id} type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>`;

    $('.container1').prepend(decForm);
    $('.decContainer').fadeTo(400, 1);
}

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

$('body').on('click', '.det_acc_dec .accept', function() {
    let id = $(this).val();


});

$('body').on('click', '.det_acc_dec .decline', function() {
    let id = $(this).val();
    console.log(id);

    formDec(id);
});

$('body').on('click', '#decForm .fa-times', () => {
    $('.decContainer').toggleClass('active');
    setTimeout(() => {
        $('.decContainer').fadeTo(400, 0, () => {
            $('.decContainer').remove();
        });
    }, 500);
});

$('body').on('submit', '#decForm', function(e) {
    e.preventDefault();

    
});