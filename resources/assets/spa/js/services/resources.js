export class Jwt {
    static accessToken(email,password){
        return Vue.http.post('access_token',{
            email: email,
            password: password
        })
    }
}

var User = Vue.resource('user')

export {User}