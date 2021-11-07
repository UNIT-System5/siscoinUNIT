import { header, homeRedir, profilePic } from "./modules/header.js";

header();
homeRedir();

function lEquip() {
    $.post('../../init.php', {
        listEquip: ''
    }, (data) => {
        let tableContent = '';
        let result = '';

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

            tableContent += `<tr>
                <td>${d.id_equip}</td>
                <td>${d.desc_equip}</td>
                <td>${d.marca_equip}</td>
                <td>${result}</td>
                <td>${d.nom_prov}</td>
                <td>${d.fecha_adq}</td>
                <td>${d.estado_equip}</td>
            </tr>`;
        });

        $('.top-tr').nextAll().remove();
        $('.top-tr').after(tableContent);
    }, 'json');
}

function brands() {
    return $.post('../../init.php', {
        getBrand: ''
    }, (data) => {
    }, 'json');
}

function provs() {
    return $.post('../../init.php', {
        getProv: ''
    }, (data) => {
    }, 'json');
}

function rPur() {
    let lTypes = '';
    let lProv = '';

    provs().done((data) => {
        data.forEach((d) => {
            lProv += `<option value="${d.id_prov}">${d.nom_prov}</option>`;
        });
    });

    $.post('../../init.php', {
        getEquipT: ''
    }, (data) => {
        data.forEach((d) => {
            lTypes += `<option value="${d.id_tipo}">${d.nom_tipo}</option>`;
        });

        let today = new Date();
        let dd = today.getDate();
        let mm = today.getMonth() + 1;
        let yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        } 

        today = yyyy + '-' + mm + '-' + dd;
        
        let registerPur = `<div class="regPurchase">
            <form action="../../init.php" method="POST" id="rForm" autocomplete="off">
                <i class="fas fa-times"></i>
                <div class="formTitle">
                    <h2>Register Purchase</h2>
                </div>
                <fieldset>
                    <input type="date" required name="fechaCompra" class="dReq"
                    min="2021-01-01" max="${today}">
                    <div class="selectType">
                        <select name="typeSol" class="typeReq" required>
                            <option value="" disabled selected>Select a Type</option>
                            ${lTypes}
                        </select>
                    </div>
                    <div class="selectProv">
                        <select name="provS" class="provSol" required>
                            <option value="" disabled selected>Select a Provider</option>
                            ${lProv}
                        </select>
                    </div>
                    <input type="number" class="preSol" name="prestock"
                    min="1" max="99999" required placeholder="Cantidad">
                </fieldset>
                <button type="submit" class="addP"><i class="fas fa-plus"></i>
                <i class="fas fa-shopping-cart"></i></button>
            </form>
        </div>`;

        $('.container1').prepend(registerPur);
        $('.regPurchase').fadeTo(400, 1);
    }, 'json');
}

function aEquip() {
    let lTypes = '';
    let lBrands = '';
    let lProv = '';

    provs().done((data) => {
        data.forEach((d) => {
            lProv += `<option value="${d.id_prov}">${d.nom_prov}</option>`;
        })
    });

    brands().done((data) => {
        data.forEach((d) => {
            lBrands += `<option value="${d.id_marca}">${d.nom_marca}</option>`;
        })
    });

    $.post('../../init.php', {
        getEquipT2: ''
    }, (data) => {
        data.forEach((d) => {
            lTypes += `<option value="${d.id_tipo}">${d.nom_tipo}</option>`;
        });

        let today = new Date();
        let dd = today.getDate();
        let mm = today.getMonth() + 1;
        let yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        } 

        today = yyyy + '-' + mm + '-' + dd;
        
        let registerEquip = `<div class="registerEquip">
            <form action="../../init.php" method="POST" id="aForm" autocomplete="off">
                <i class="fas fa-times"></i>
                <div class="formTitle">
                    <h2>Add Equipment</h2>
                </div>
                <fieldset>
                    <input type="date" required name="fechaCompra" class="dateSol"
                    min="2021-01-01" max="${today}">
                    <div class="selectType">
                        <select name="typeSol" class="titSol" required>
                            <option id="firstT" value="default" disabled selected>Select a Type</option>
                            ${lTypes}
                        </select>
                    </div>
                    <div class="selectBrand">
                        <select name="brandSol" class="bSol" required>
                            <option value="" disabled selected>Select a Brand</option>
                            ${lBrands}
                        </select>
                    </div>
                    <div class="selectProv">
                        <select name="provS" class="pSol" required>
                            <option value="" disabled selected>Select a Provider</option>
                            ${lProv}
                        </select>
                    </div>
                    <input type="number" required name="" class="guarSol"
                    min="1" max="1188" placeholder="Garantía">
                </fieldset>
                <button type="submit" class="addE"><i class="fas fa-plus"></i>
                <i class="fas fa-microchip"></i></button>
            </form>
        </div>`;

        $('.container1').prepend(registerEquip);
        $('.registerEquip').fadeTo(400, 1);
    }, 'json');
}

function aProv(e = true) {
    let provList = '';

    provs().done((data) => {
        data.forEach((d) => {
            provList += `<tr>
                <td>${d.id_prov}</td>
                <td>${d.nom_prov}</td>
                <td>${d.dir_prov}</td>
                <td>${d.tel_prov}</td>
            </tr>`
        });

        if (e == true) {
            let addProvider = `<div class="addProvider">
                <form action="../../init.php" method="POST" id="pForm" autocomplete="off">
                    <i class="fas fa-times"></i>
                    <div class="formTitle">
                        <h2>Add Provider</h2>
                    </div>
                    <fieldset>
                        <input type="text" required placeholder="Nombre proveedor"
                        minlength="1" maxlength="20" class="nomProv">
                        <input type="text" required placeholder="Dirección proveedor"
                        minlength="1" maxlength="40" class="dirProv">
                        <input type="tel" required placeholder="Teléfono proveedor"
                        minlength="8" maxlength="9" pattern="[0-9]{8,9}" class="telProv">
                        <button type="submit" class="addP"><i class="fas fa-plus"></i></button>
                    </fieldset>
                    <div class="table">
                        <table>
                            <tr class="first_tr">
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                            </tr>
                            ${provList}
                        </table>
                    </div>
                </form>
            </div>`;

            $('.container1').prepend(addProvider);
            $('.addProvider').fadeTo(400, 1);
        } else {
            $('.addProvider .first_tr').nextAll().remove();
            $('.addProvider .first_tr').after(provList);
        }    
    });
}

function aBrand(e = true) {
    let bList = '';

    brands().done((data) => {
        data.forEach((d) => {
            bList += `<tr>
                <td>${d.id_marca}</td>
                <td>${d.nom_marca}</td>
            </tr>`;
        });

        if (e == true) {
            let addBrand = `<div class="addBrand">
                <form action="../../init.php" method="POST" id="bForm" autocomplete="off">
                    <i class="fas fa-times"></i>
                    <div class="formTitle">
                        <h2>Add Brand</h2>
                    </div>
                    <fieldset>
                        <input type="text" required minlength="1" maxlength="80" class="nomBrand">
                        <button class="addB" type="submit"><i class="fas fa-plus"></i></button>
                    </fieldset>
                    <div class="table">
                        <table>
                            <tr class="first_tr">
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                            ${bList}
                        </table>
                    </div>
                </form>
            </div>`;

            $('.container1').prepend(addBrand);
            $('.addBrand').fadeTo(400, 1);
        } else {
            $('.addBrand .first_tr').nextAll().remove();
            $('.addBrand .first_tr').after(bList);
        }
    });
}

$(window).on('load', () => {
    profilePic();
    lEquip();

    let searchParams = new URLSearchParams(window.location.search);
    
    if (searchParams.has('brand')) {
        console.log(true);
        $('body .rBrand').click();
    } else if (searchParams.has('prov')) {
        $('body .rProv').click();
    }
});

$('body').on('click', '.rPur', () => {
    rPur();
});

$('body').on('click', '#rForm .fa-times', () => {
    $('.regPurchase').toggleClass('active');
    setTimeout(() => {
        $('.regPurchase').fadeTo(400, 0, () => {
            $('.regPurchase').remove();
        });
    }, 500);
})

$('body').on('submit', '#rForm', function(e) {
    e.preventDefault();

    let fecha = $('.dReq').val();
    let tipo_nom = $('.typeReq option:selected').text();
    let tipo = $('.typeReq').val();
    let prov = $('.provSol').val();
    let prestock = $('.preSol').val();

    $.post('../../init.php', {
        INE: '',
        fecha_compra: fecha,
        tipo_compra: tipo_nom,
        fk_tipo: tipo,
        fk_prov: prov,
        prestock: prestock
    }, () => {
        $('.preSol').val('');
    });

    $('.addP i').fadeTo(200, 0, () => {
        $('.addP').html('<i class="fas fa-check"></i>');
        $('.addP i').fadeTo(200, 1);
        $('.addP').css({
            'background-color': '#28c730',
            'pointer-events': 'none'
        });
        setTimeout(() => {
            $('.addP i').fadeTo(200, 0, () => {
                $('.addP').html('<i class="fas fa-plus"></i><i class="fas fa-shopping-cart"></i>');
                $('.addP i').fadeTo(200, 1);
                $('.addP').removeAttr('style');
            });
        }, 1500);
    });
});

$('body').on('click', '.rEquip', () => {
    aEquip();
});

$('body').on('click', '#aForm .fa-times', () => {
    $('.registerEquip').toggleClass('active');
    setTimeout(() => {
        $('.registerEquip').fadeTo(400, 0, () => {
            $('.registerEquip').remove();
        });
    }, 500);
});

$('body').on('submit', '#aForm', function(e) {
    e.preventDefault();

    let lTypes = '';

    let fecha = $('.dateSol').val();
    let tipo_nom = $('.titSol option:selected').text();
    let tipo_id = $('.titSol').val();
    let tipo = tipo_id == 2 || tipo_id == 4 ? 'Equipamiento' : 'Componente';
    let brand_id = $('.bSol').val();
    let brand_name = $('.bSol option:selected').text();
    let guarantee = $('.guarSol').val();
    let provider = $('.pSol').val();

    $.post('../../init.php', {
        IE: '',
        fecha_adq: fecha,
        desc_equip: tipo_nom,
        fk_tipo: tipo_id,
        tipo: tipo,
        marca_equip: brand_name,
        fk_marca: brand_id,
        garantia: guarantee,
        fk_prov: provider
    }, () => {
        $.post('../../init.php', {
            getEquipT2: ''
        }, (data) => {
            data.forEach((d) => {
                lTypes += `<option value="${d.id_tipo}">${d.nom_tipo}</option>`;
            });
    
            $('#firstT').nextAll().remove();
            $('#firstT').after(lTypes);
            
            if ($(`.titSol option[value=${tipo_id}]`).length) {
                $('.titSol').val(tipo_id);
            } else {
                $('.titSol').val('default');
            }

            lEquip();
        }, 'json');
    });

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
});

$('body').on('click', '.rProv', () => {
    aProv();
});

$('body').on('click', '#pForm .fa-times', () => {
    $('.addProvider').toggleClass('active');
    setTimeout(() => {
        $('.addProvider').fadeTo(400, 0, () => {
            $('.addProvider').remove();
        });
    }, 500);
});

$('body').on('submit', '#pForm', function(e) {
    e.preventDefault();

    let nom = $('.nomProv').val();
    let dir = $('.dirProv').val();
    let tel = $('.telProv').val();

    $.post('../../init.php', {
        INP: '',
        nomProv: nom,
        dirProv: dir,
        telProv: tel
    }, () => {
        aProv(false);

        $('.nomProv').val('');
        $('.dirProv').val('');
        $('.telProv').val(''); 
    });

    $('.addP i').fadeTo(200, 0, () => {
        $('.addP').html('<i class="fas fa-check"></i>');
        $('.addP i').fadeTo(200, 1);
        $('.addP').css({
            'background-color': '#28c730',
            'pointer-events': 'none'
        });
        setTimeout(() => {
            $('.addP i').fadeTo(200, 0, () => {
                $('.addP').html('<i class="fas fa-plus"></i>');
                $('.addP i').fadeTo(200, 1);
                $('.addP').removeAttr('style');
            });
        }, 1500);
    });
});

$('body').on('click', '.rBrand', () => {
    aBrand();
});

$('body').on('click', '#bForm .fa-times', () => {
    $('.addBrand').toggleClass('active');
    setTimeout(() => {
        $('.addBrand').fadeTo(400, 0, () => {
            $('.addBrand').remove();
        });
    }, 500);
});

$('body').on('submit', '#bForm', function(e) {
    e.preventDefault();

    let nom = $('.nomBrand').val();

    $.post('../../init.php', {
        INB: '',
        nomBrand: nom
    }, () => {
        aBrand(false);

        $('.nomBrand').val('');
    });

    $('.addB i').fadeTo(200, 0, () => {
        $('.addB').html('<i class="fas fa-check"></i>');
        $('.addB i').fadeTo(200, 1);
        $('.addB').css({
            'background-color': '#28c730',
            'pointer-events': 'none'
        });
        setTimeout(() => {
            $('.addB i').fadeTo(200, 0, () => {
                $('.addB').html('<i class="fas fa-plus"></i>');
                $('.addB i').fadeTo(200, 1);
                $('.addB').removeAttr('style');
            });
        }, 1500);
    });
});

$('.menupfp').click(() => {
    if ($('.registerEquip').length) {
        $('.registerEquip').toggleClass('active');
        setTimeout(() => {
            $('.registerEquip').fadeTo(400, 0, () => {
                $('.registerEquip').remove();
            });
        }, 500);
    }

    if ($('.regPurchase').length) {
        $('.regPurchase').toggleClass('active');
        setTimeout(() => {
            $('.regPurchase').fadeTo(400, 0, () => {
                $('.regPurchase').remove();
            });
        }, 500);
    }
});