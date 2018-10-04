
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('select2')
require('jquery-ui')
require('jquery-ui/ui/widget');
require('jquery-ui/ui/widgets/datepicker');
require('jquery-ui/ui/widgets/slider');
require('jquery-ui-timepicker-addon')
require('dhtmlx-scheduler')
require('dhtmlx-scheduler/codebase/ext/dhtmlxscheduler_tooltip')
require('dhtmlx-gantt')
require('dhtmlx-gantt/codebase/ext/dhtmlxgantt_tooltip')
require('dhtmlx-gantt/codebase/ext/dhtmlxgantt_fullscreen')

/**
window.Vue = require('vue');

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
        let form = $("<form>", {
            action: "/logout",
            method: "POST"
        }).append([
            $("<input>", {
                name: "_token",
                value: csrf
            }),
        ]).appendTo("body").submit()
    })
    $(".task-update").click(function(event){
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
        ])
        switch ($(this).attr("data-status")) {
            case "Pending":
                form.append($("<input>", {name: "status_id", value: 2}))
                break;
            case "Working":
                form.append($("<input>", {name: "status_id", value: 3}))
                break;
        }
        form.appendTo("body").submit()
    })
    $(".delete").click(function(event){
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
                value: "DELETE"
            })
        ]).appendTo("body").submit()
    })
    $(".zoom").click(function(event){
        event.preventDefault()
        mapShow.setZoom(15)
        mapShow.setCenter($(this).data())
    })
    $("#timezoneModal").on("shown.bs.modal", function(event){
        $(this).find("select").select2({
            theme: "default"
        })
    })
    $("#calcModal").on("shown.bs.modal", function(event){
        $(this).find("select").select2({
            theme: "default"
        })
    })
    $("#calcModal form").submit(function(event){
        event.preventDefault()
        $.ajax({
            url: "/converter",
            method: "POST",
            data: $(this).serialize(),
            success: (data) => {
                $("input[name='to']").val(data)
            }
        })
    })
    $(".datetimepicker-calc").datetimepicker({
        dateFormat: "yy-mm-dd"
    })
    $(".select2").select2()
    $(window).resize(function(event){
        appHeight()
    })

    appHeight()
    
})
function appHeight(){
    $("#app").height($(window).height())
}