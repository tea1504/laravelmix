import Api from './Api'

export default {
  get(){
    return Api().get('/department/get');
  },
  index(){
    return Api().get('/department');
  }
}