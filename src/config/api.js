/*
*  封装fetch
* params:
*         method:请求方式  string   必填
*               GET POST PUT DELETE
*         url:   地址   string  必填
*       data:  数据   对象
 */

import {SUCCESS, FAIL, TOKENFAIL} from "./base";

function api(method, url, data) {
    //防止实参是小写或者两边有空格
    method = method.toUpperCase().trim();
    let token = sessionStorage.getItem('token');
    let headers = {
        token
    }
    let options = {
        method,
        headers
    };

    //1.api(GET,'',{})
    //1.api(GET,'')
    //1.api(GET,'',{page:10})
    //判断是否为空对象
    if (method === 'GET' && data && Object.keys(data).length) {
        let str = '?';
        for (let i in data) {
            str += `${i}=${data}[i]&`;
        }
        str += str.slice(0, -1);        //截取掉最后的&
        url += str;
    }
    if (method === 'POST' || method === 'PUT') {
        headers = {
            token,
            'content-type': 'applicaiton/json'
        }
        let body = JSON.stringify(data);
        options.body = body;
    }
    let promise = new Promise((resolve, reject) => {
        fetch(url, options).then(res => res.json())
            .then(data => {
                let {code} = data;
                if (code == SUCCESS) {
                    resolve(data);
                } else if (code == FAIL) {
                    reject(data);
                }
            })
        return promise;
    })


}

export {api};
