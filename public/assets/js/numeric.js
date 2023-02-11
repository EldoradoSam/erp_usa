
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 Created on : Dec 17, 2020, 8:24:42 AM
 Author     : Sampath
 */

var int_components = document.getElementsByClassName('integer');
var float_components = document.getElementsByClassName('float');

for (i = 0; i < int_components.length; i++) {
    int_components[i].addEventListener('input',inputIntegerEvent);
}


for (i = 0; i < float_components.length; i++) {
    float_components[i].addEventListener('input',inputFloatEvent);
}

function inputIntegerEvent(event){
    $('#'+event.target.id).val($('#'+event.target.id).val().replace(/[^0-9]/g, ''));
    numericInputTrigger();
}


function inputFloatEvent(event){
    $('#'+event.target.id).val($('#'+event.target.id).val().replace(/[^0-9-.]/g, ''));
    numericInputTrigger();
}


function numericInputTrigger(){}

