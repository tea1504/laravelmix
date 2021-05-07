import Api from './Api'
export default {
  index() {
    return Api().get('/staff');
  },
  create(form) {
    return Api().post('/staff', form);
  },
  show(id) {
    return Api().get('/staff/' + id);
  },
  update(form, id) {
    return Api().post('/staff/' + id + '?_method=put', form);
  },
  delete(id){
    return Api().delete('/staff/'+id);
  }
}