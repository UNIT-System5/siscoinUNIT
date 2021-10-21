import { header, profilePic, homeRedir } from './modules/header.js';

header();
homeRedir();

$(window).on('load', () => {
    profilePic();
});
