import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

$(window).on('load', () => {
    profilePic();

    $.post('../../init.php', {
        userCount: ''
    }, (data) => {
        $('.data_employees .card_content .section1 h1').html(data.length);
    }, 'json');
});
