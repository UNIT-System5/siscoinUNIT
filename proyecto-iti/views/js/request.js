import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

function lRequests(e = true) {
    let table2 = '';
    let iconEstado = '';
    let estado = '';
    let acc_dec = '';
    let acc_sS = '';
    let pend_sS = '';
    let st_pr = '';
    let quant = '';

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

                case 'Pendiente SS':
                    iconEstado = 'fas fa-truck';
                    estado = 'Pendiente Sin Stock';
                    break;
                
                case 'Aceptada':
                    estado = 'Aceptada';
                    iconEstado = 'fas fa-check';
                    break;

                case 'Rechazada':
                    iconEstado = 'fas fa-times';
                    estado = 'Rechazada';
                    break;
            }

            quant = parseInt(d.titulo_soli.split(' ')[0], 10);

            acc_sS = `<button class="accept" title="Aceptar Solicitud"
            value="${d.id_soli}" type="button" name="accept">
            <i class="fas fa-check"></i></button>`;

            pend_sS = `<button class="noStock" title="Pendiente sin Stock"
            value="${d.id_soli}" type="button" name="nostock">
            <i class="fas fa-clock"></i></button>`;

            acc_dec = `<div class="det_acc_dec info">
                ${((d.stock == 0) && (d.prestock == 0)) ? pend_sS :
                    ((d.stock == 0) && (d.prestock >= quant)) ? pend_sS :
                    (d.stock >= quant) ? acc_sS : pend_sS}
                <button class="decline" title="Rechazar Solicitud"
                value="${d.id_soli}" type="button" name="decline">
                <i class="fas fa-times"></i></button>
            </div>
            <div class="det_eq_inst info">
                <h3>Installed Equipment</h3><span ${d.total_equip < 15 ? 'class="norm"' :
                d.total_equip < 30 ? 'class="med"' : 'class="many"'}>${d.total_equip} ${d.total_equip >= 40 ?
                '<i class="fas fa-exclamation-triangle warn_many" title="Equipment limit reached"></i>' : ''}</span>
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

function lRequestsS(e = true) {
    let tableS = '';
    let estado2 = '';
    let iconEstado2 = '';

    if (e == true) {
        var call2 = $.post('../../init.php', {
            listSolSP: ''
        }, (data) => {
        }, 'json');
    } else if (e == false) {
        var call2 = $.post('../../init.php', {
            listSolS: ''
        }, (data) => {
        }, 'json');
    }

    call2.done((data) => {
        data.reverse().forEach((d) => {
            switch (d.estado_soli) {
                case 'Pendiente SubB':
                    iconEstado2 = 'fas fa-clock';
                    estado2 = 'Pendiente';
                    break;

                case 'Pendiente Compras':
                    iconEstado2 = 'fas fa-clock';
                    estado2 = 'Pendiente';
                    break;

                case 'Pendiente SD':
                    iconEstado2 = 'fas fa-dollar-sign';
                    estado2 = 'Pendiente Sin Dinero';
                    break;
                
                case 'Aceptada':
                    estado2 = 'Aceptada';
                    iconEstado2 = 'fas fa-check';
                    break;

                case 'Realizada':
                    estado2 = 'Realizada';
                    iconEstado2 = 'fas fa-check';
                    break;

                case 'Recibida':
                    estado2 = 'Recibida';
                    iconEstado2 = 'fas fa-inbox';
                    break;

                case 'Rechazada':
                    iconEstado2 = 'fas fa-times';
                    estado2 = 'Rechazada';
                    break;
            }

            tableS += `<details>
                <summary>
                    <table>
                        <tr>
                            <td class="st_col"><span><i title="${estado2}" class="${iconEstado2}"></i></span></td>
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
                </div>
            </details>`;
        });

        $('.firstTable').nextAll().remove();
        $('.firstTable').after(tableS);

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

function formAcc(id) {
    let accForm = `<div class="accContainer">
        <form method="POST" action="../../init.php" id="accForm" autocomplete="off">
            <i class="fas fa-times"></i>
            <div class="formTitle">
                <h2>Accept Request</h2>
            </div>
            <fieldset>
                <div class="textArea" data-before="180">
                    <textarea required name="descSol2" class="descSol2"
                    minlength="1" maxlength="240" placeholder="Type final report"></textarea>
                </div>
            </fieldset>
            <button class="accBtn" value="${id}" type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>`;

    $('.container1').prepend(accForm);
    $('.accContainer').fadeTo(400, 1);
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

    formAcc(id);
});

$('body').on('click', '.noStock', function() {
    let id = $(this).val();
    let prestock = '';
    let quant = '';

    $.post('../../init.php', {
        getSolFID: '',
        id: id
    }, (data) => {
        prestock = data[0].prestock;
        quant = data[0].titulo_soli.split(' ')[0];

        if (prestock >= quant) {
            let title = 'Registrar Equipamiento';
            let desc = `Se solicita registrar ${quant} ${data[0].nom_tipo} como mínimo para poder enviar equipamiento a la oficina que lo solicita.`;
            let status = 'Pendiente Compras'
            let equip_id = data[0].fk_tipo;

            $.post('../../init.php', {
                autoReport: '',
                id: id,
                titSol: title,
                descSol: desc,
                estSol: status,
                fk_tipo: equip_id
            }, () => {
                if ($('.lBtn').length) {
                    lRequests();
                } else if ($('.lBtn2').length) {
                    lRequests(false);
                }
            });
        } else {
            let equip_id = data[0].fk_tipo;

            $.post('../../init.php', {
                pendSS: '',
                id: id
            }, () => {
                location.replace(`equip.php?aRq=yes&qt=${quant}&eqID=${equip_id}&id=${id}`);
            });
        }
    }, 'json');
})

$('body').on('click', '.det_acc_dec .decline', function() {
    let id = $(this).val();

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

$('body').on('click', '#accForm .fa-times', () => {
    $('.accContainer').toggleClass('active');
    setTimeout(() => {
        $('.accContainer').fadeTo(400, 0, () => {
            $('.accContainer').remove();
        });
    }, 500);
});

$('body').on('submit', '#accForm', function(e) {
    e.preventDefault();

    let report = $('.descSol2').val();
    let id = $('.accBtn').val();

    $.post('../../init.php', {
        acccanReport: '',
        id: id,
        report: report,
        status: 'Aceptada'
    }, () => {
        $('.accBtn').val('');
        $('.descSol2').val('');

        if ($('.lBtn').length) {
            lRequests();
        } else if ($('.lBtn2').length) {
            lRequests(false);
        }

        $('.accBtn i').fadeTo(200, 0, () => {
            $('.accBtn').html('<i class="fas fa-check"></i>');
            $('.accBtn i').fadeTo(200, 1);
            $('.accBtn').css({
                'background-color': '#28c730',
                'pointer-events': 'none'
            });

            location.replace('equip.php');
        });
    });
});

$('body').on('submit', '#decForm', function(e) {
    e.preventDefault();

    let id = $('.decBtn').val();
    let report = $('.descSol').val();

    $.post('../../init.php', {
        acccanReport: '',
        id: id,
        report: report,
        status: 'Rechazada'
    }, () => {
        $('.decBtn').val('');
        $('.descSol').val('');

        if ($('.lBtn').length) {
            lRequests();
        } else if ($('.lBtn2').length) {
            lRequests(false);
        }

        $('.decBtn i').fadeTo(200, 0, () => {
            $('.decBtn').html('<i class="fas fa-check"></i>');
            $('.decBtn i').fadeTo(200, 1);
            $('.decBtn').css({
                'background-color': '#28c730',
                'pointer-events': 'none'
            });
            setTimeout(() => {
                $('.decBtn i').fadeTo(200, 0, () => {
                    $('.decBtn').html('<i class="fas fa-paper-plane"></i>');
                    $('.decBtn i').fadeTo(200, 1);
                    $('.decBtn').removeAttr('style');
                    $('.decContainer').toggleClass('active');
                    setTimeout(() => {
                        $('.decContainer').fadeTo(400, 0, () => {
                            $('.decContainer').remove();
                        });
                    }, 500);
                });
            }, 1500);
        });
    });
});

$('body').on('click', '.oBtn', () => {
    lRequestsS();

    $('.oBtn').html('List Received <i class="fas fa-inbox"></i>');
    $('.oBtn').attr('title', 'List Received');
    $('.oBtn').removeClass().addClass('ofBtn');

    if ($('.lBtn').length) {
        $('.lBtn').removeClass().addClass('loBtn');
    } else if ($('.lBtn2').length) {
        $('.lBtn2').html('List All <i class="fas fa-align-left"></i>');
        $('.lBtn2').removeClass().addClass('loBtn');
    }
});

$('body').on('click', '.ofBtn', () => {
    lRequests();

    $('.ofBtn').html('List Sent <i class="fas fa-paper-plane"></i>');
    $('.ofBtn').attr('title', 'List Sent');
    $('.ofBtn').removeClass().addClass('oBtn');

    if ($('.loBtn').length) {
        $('.loBtn').removeClass().addClass('lBtn');
    } else if ($('.loBtn2').length) {
        $('.loBtn2').html('List All <i class="fas fa-align-left"></i>');
        $('.loBtn2').removeClass().addClass('lBtn');
    }
});

$('body').on('click', '.loBtn', () => {
    lRequestsS(false);

    $('.loBtn').html('List Pending <i class="fas fa-clock"></i>');
    $('.loBtn').removeClass().addClass('loBtn2');
});

$('body').on('click', '.loBtn2', () => {
    lRequestsS();

    $('.loBtn2').html('List All <i class="fas fa-align-left"></i>');
    $('.loBtn2').removeClass().addClass('loBtn');
});