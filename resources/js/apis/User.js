import User from '../store/modules/User';
import Api from './Api'

export default {
    login(form){
        return Api().post('/login', form);
    },
    user(){
        return Api().post('/user');
    },
    logout(){
        return Api().post('/logout');
    }
}