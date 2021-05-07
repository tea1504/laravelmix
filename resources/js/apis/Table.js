import Api from './Api'

export default {
  index(){
    return Api().get('/table');
  },
  create(form){
    return Api().post('/table', form);
  }
}