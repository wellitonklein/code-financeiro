import Echo from 'laravel-echo'
import JwtToken from './services/jwt-token'

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'a14389d9bab3af6e5c6d'
})

const changeJwtTokenInEcho = value => {
    window.Echo.connector.pusher.config.auth.headers['Authorization'] =
        JwtToken.getAuthorizationHeader()
}

JwtToken.event('updateToken', value => {
    changeJwtTokenInEcho(value)
})

changeJwtTokenInEcho(JwtToken.token)