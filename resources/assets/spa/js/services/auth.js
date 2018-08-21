import {Jwt} from './resources'
import LocalStorage from './localStorage'
import {User} from '../services/resources'

const TOKEN = 'token'
const USER = 'user'

const afterLogin = (response) => {
    User.get()
        .then((response) => LocalStorage.setObject(USER,response.data))
}

export default {
    login(email, password){
        return Jwt.accessToken(email,password).then((response) => {
            afterLogin(response)
            LocalStorage.set(TOKEN,response.data.token)
            return response
        })
    },
    getAuthorizationHeader(){
        return `Bearer ${LocalStorage.get(TOKEN)}`
    },
    user(){
        return LocalStorage.getObject(USER)
    }
}