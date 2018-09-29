
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 
 Vue.component('example-component', require('./components/ExampleComponent.vue'));
 
 const app = new Vue({
     el: '#app'
    });
*/
var csrf
$(document).ready(function()
{
    csrf = $('meta[name="csrf-token"]').attr("content")

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": csrf
        }
    })
    
    $(".logout").click(function(event){
        event.preventDefault()
        $.ajax({
            url: "/logout",
            method: "POST",
            success: (data) => {
                location.reload()
            }
        })
    })
    $(".working").click(function(event){
        event.preventDefault()
        let form = $("<form>", {
            action: $(this).attr("href"),
            method: "POST"
        }).append([
            $("<input>", {
                name: "_token",
                value: csrf
            }),
            $("<input>", {
                name: "_method",
                value: "PUT"
            }),
            $("<input>", {
                name: "status_id",
                value: 2
            }),
        ]).appendTo("body").submit()
    })
    $(".zoom").click(function(event){
        event.preventDefault()
        mapShow.setZoom(15)
        mapShow.setCenter($(this).data())
    })
})