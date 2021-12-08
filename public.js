'use strict';

/**
 * @returns XMLHttpRequest
 */
function __retAjax(url, postData = null) {
    var a = new XMLHttpRequest();
    if (postData) {
        a.open('POST', url, true);
        a.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        a.send(postData);
    } else {
        a.open('GET', url, true);
        a.send();
    }
    return a
}

/**
 * ajax刷新dom
 */
function ajaxDom(dom, url, postData = null) {
    __retAjax(url, postData).onload = function({ currentTarget: d }) {
        document.querySelector(dom).innerHTML = d.responseText;
    }
}

/**
 * ajax请求api
 */
function ajaxApi(url, postData = null, success = null, error530 = null, error = null) {
    __retAjax(url, postData).onload = function({ currentTarget: d }) {
        console.log(JSON.parse(d.response));
        if (d.status == 200) {
            success && success(JSON.parse(d.response));
        } else if (d.status == 530) {
            error530 && error530(JSON.parse(d.response));
        } else {
            error && error(d.status, d.response);
        }
    }
}
