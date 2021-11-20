'use strict';

/**
 * ajax刷新dom
 */
function ajaxDom(dom, url, postData = null) {
    var a = new XMLHttpRequest();
    a.open(postData ? 'POST' : 'GET', url, true);
    a.send(postData);
    a.onreadystatechange = function() {
        document.querySelector(dom).innerHTML = a.responseText;
    }
}