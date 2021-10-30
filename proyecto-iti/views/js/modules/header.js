export function profilePic() {
    $.post('../../init.php', {
        getSession: ''
    }, (data) => {
        if ($.isEmptyObject(data[0].pic_user)) {
            $('.signin img').attr('src',
            `https://avatars.dicebear.com/api/initials/${data[0].nom_comp_user}.svg`);
        } else {
            $('.signin img').attr('src',
            `../../profilePics/${data[0].pic_user}`);
        }
    }, 'json');
}

export function header() {
    //Toggle class to active on menu icon click.
    $('.fa-bars').click(() => {
        $('.fa-bars').fadeTo(200, 0);
        $('.fa-bars').css('transform', 'translateX(-2em)');
        $('.logoimg').css({transform: 'translateX(-1em)', transition: '0.5s ease-out'});
        $('.fa-bars').focus();
    });

    $('.leftbar').on('focusin', () => {
        $('.fa-bars').focus();
        $('.fa-bars').fadeTo(200, 0);
        $('.fa-bars').css('transform', 'translateX(-2em)');
        $('.logoimg').css({transform: 'translateX(-1em)', transition: '0.5s ease-out'});
    });

    $('.fa-bars').blur(() => {
        $('.fa-bars').fadeTo(200, 1);
        $('.logoimg').css('transform', 'translateX(0)');
        $('.fa-bars').css('transform', 'translateX(0em)');
    });

    //Toggle class to active on profile icon click.
    let counter = 0;
    $('.signin').click(() => {
        if (counter < 9) {
            counter += 1;
        } else {
            let video = `<div class="videoContainer">
                <video autoplay>
                    <source src="../images/cow.webm" type="video/webm">
                </video>
            </div>`;

            if (!($('.videoContainer').length)) {
                $('.header').prepend(video);
            }
            $('.videoContainer').fadeTo(400, 1);
        }
        $('.signin').focus();
    });

    $('body').on('click', '.videoContainer', () => {
        $('.videoContainer').fadeTo(400, 0, () => {
            $('.videoContainer').remove();
            counter = 0;
        });
    });

    //Focus searchbar input on search icon click.
    $('.fa-bell').click(() => {
        $('.notifications').focus();
    });

    $.post('../../init.php', {
        getMail: ''
    }, (data) => {
    }, 'json').done((data) => {
        $.post('../../init.php', {
            getUserM: '',
            mail: data
        }, (data) => {
            if (data[0].notify == false) {
                $('.notifList').html(`<span>You don't have any notification</span>`);
            } else {
            }
        }, 'json');
    })

    $('.editP').click(() => {
        $.post('../../init.php', {
            getMail: ''
        }, (data) => {
        }, 'json').done((data) => {
            $.post('../../init.php', {
                getUserM: '',
                mail: data
            }, (data) => {
                let imgProfile = '';
                
                if ($.isEmptyObject(data[0].pic_user)) {
                    imgProfile = `<img id="profPic" src="../images/default-profile.png">`;
                } else {
                    imgProfile = `<img id="profPic" src="../../profilePics/${data[0].pic_user}">`;
                }

                let editF = `<div class="editProfile">
                    <form action="../../init.php" method="POST" id="editForm" enctype="multipart/form-data">
                        <i class="fas fa-times closeP"></i>
                        <div class="imgSpace">
                            <div class="imgBg"></div>
                            <div class="imgContainer">
                                ${imgProfile}
                            </div>
                            <button type="button" class="chFile"><i class="fas fa-upload"></i></button>
                        </div>
                        <input type="file" id="fileCh" name="editImage" 
                        accept="image/jpeg, image/png">
                        <div class="dName">
                            <h2>${data[0].nom_comp_user}</h2>
                        </div>
                        <div class="otherStuff">
                            <div class="dGroup">
                                <div class="groupsI">
                                    <i class="fas fa-users"></i>
                                </div>
                                <span>${data[0].grupo_user}</span>
                            </div>
                            <div class="dLugar">
                                <div class="officeI">
                                    <i class="fas fa-building"></i>
                                </div>
                                <span>${data[0].lugar_user}</span>
                            </div>
                        </div>
                    </form>
                </div>`

                if ($('.editProfile').length) {
                } else {
                    $(':focus').blur();
                    $('.header').prepend(editF);

                    $.post('../../init.php', {
                        getSession: ''
                    }, (data) => {
                        if ($.isEmptyObject(data[0].pic_user)) {
                            $('#profPic').attr('src',
                            `https://avatars.dicebear.com/api/initials/${data[0].nom_comp_user}.svg`);
                        } else {
                            $('#profPic').attr('src',
                            `../../profilePics/${data[0].pic_user}`);
                        }
                    }, 'json');

                    $('.editProfile').fadeTo(400, 1);
                }
            }, 'json');
        });
    });

    $('body').on('click', '.closeP', () => {
        $('.editProfile').fadeTo(400, 0, () => {
            $('.editProfile').remove();
        });
    });

    $('body').on('click', '.chFile', () => {
        $('#fileCh').click();
    });

    let property = '';

    $('body').on('change', '#fileCh', function(e) {
        property = this.files[0];

        if ((property.size) > 8000000) {
            $.post('../../init.php', {
                getSession: ''
            }, (data) => {
                if ($.isEmptyObject(data[0].pic_user)) {
                    $('#profPic').attr('src',
                    `https://avatars.dicebear.com/api/initials/${data[0].nom_comp_user}.svg`);
                } else {
                    $('#profPic').attr('src',
                    `../../profilePics/${data[0].pic_user}`);
                }
            }, 'json');

            if ($('.confirm').length) {
                $('.confirm').fadeTo(200, 0, () => {
                    $('.confirm').remove();
                });
            }

            $('.chFile i').fadeTo(200, 0, () => {
                $('.chFile').html('<i class="fas fa-exclamation"></i>');
                $('.chFile').attr('title', 'File size is bigger than 8MB!')
                $('.chFile i').fadeTo(200, 1);
                $('.chFile').css({
                    'background-color': '#ec1947'
                });
                setTimeout(() => {
                    $('.chFile i').fadeTo(200, 0, () => {
                        $('.chFile').html('<i class="fas fa-upload"></i>');
                        $('.chFile i').fadeTo(200, 1);
                        $('.chFile').removeAttr('style title');
                    });
                }, 3000);
            });
        } else {
            $('#profPic').attr('src', URL.createObjectURL(e.target.files[0]));
        
            let button = `<button type="submit" name="cPPic" class="confirm"><i class="fas fa-check"></i></button>`;

            if (!($('.confirm').length)) {
                $('.chFile').before(button);
            }
        }
    });

    $('body').on('submit', '#editForm', function(e) {
        e.preventDefault();
        
        let imageName = property.name;
        let imgExt = imageName.split('.').pop().toLowerCase();

        let formData = new FormData();
        formData.append('file', property);

        $.ajax({
            url: '../../init.php',
            method: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.confirm').fadeTo(200, 0, () => {
                    $('.confirm').remove();
                    location.reload(true);
                });
            }
        });
    });

    $('body').on('click', '.close', () => {
        $('.fa-bars').blur();
    })
}

export function homeRedir() {
    $('.logoimg').click(() => {
        location.href = '.';
    });
}