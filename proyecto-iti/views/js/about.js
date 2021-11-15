import { header, homeRedir, profilePic } from "./modules/header.js";

header();
homeRedir();

$(window).on('load', () => {
    profilePic();
});