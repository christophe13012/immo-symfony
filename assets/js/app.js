/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "../css/app.css";

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from "jquery";
require("bootstrap");

$(function () {
  $(".modal-btn").click(function () {
    var data_var = $(this).data("id");
    $(".modal-footer").append(
      "<a href='admin/delete/" +
        data_var +
        '\' class="btn btn-danger">Supprimer</a>'
    );
  });
});

require("select2");
$("select").select2();
var display = "none";
$(".contact").click(function () {
  var display = $(".contactForm")[0].style.display;
  display === "none" || display === ""
    ? $(".contactForm").css("display", "block")
    : $(".contactForm").css("display", "none");
});
console.log("Hello Webpack Encore! Edit me in assets/js/app.js");
