
(function() {
   'use strict';
   var rslt,dbs;
   
   
function init(){ 
   rslt=document.getElementById('rslt');
   dbs=document.body.style;
   
document.getElementById('bmiform').reset();
document.getElementById('rst').onclick=function(){
   this.blur();
   rslt.innerHTML='';
   dbs.backgroundColor='#fff';
 }
document.getElementById('bmi').onclick=function(){
   BMIcalc();
  }
 }
function BMIcalc(){
   var w_txt=document.getElementById('wght');
   var h_txt=document.getElementById('hght');
   var w=parseInt(w_txt.value);
   var h=parseInt(h_txt.value);
   h=h/100;
   var errMsg='';
if(w<=0) {
   errMsg=errMsg+'* Weight cannot be negative';
   rslt.innerHTML=errMsg;
   return;
 }
if(h<=0) {
   errMsg=errMsg+'* Height cannot be negative';
   rslt.innerHTML=errMsg;
   return;  
 }
if(!w||!h) {
   rslt.innerHTML='Fill the width and height boxes';
   return;   
 }
else {
   var BMI=((w)/(h*h));
   var resultMsg='';
if(BMI<19) {
   resultMsg='Your BMI is '+ BMI.toFixed(2)+' ==>\nYou are classified as Underweight';
   dbs.backgroundColor='#f93';
 }
else {
if(BMI<25) {
   resultMsg='Your BMI is '+ BMI.toFixed(2)+' ==>\nYou are classified as Normal';
   dbs.backgroundColor='#0c0';  
 }
else { 
if(BMI<30) {
   resultMsg='Your BMI is '+BMI.toFixed(2)+' ==>\nYou are classified as Overweight';
   dbs.backgroundColor='#f93';
 }
else {
resultMsg='Your BMI is '+BMI.toFixed(2)+' ==>\nYou are classified as Obese';
   dbs.backgroundColor='#f00';
    }
   }
  }
 }
   rslt.innerHTML=resultMsg;
   document.getElementById('bmi').blur();
 }
   window.addEventListener?
   window.addEventListener('load',init,false):
   window.attachEvent('onload',init);
})();
