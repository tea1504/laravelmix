import Api from './Api'

export default {
  index() {
    return Api().get('/type');
  },
  create(form) {
    return Api().post('/type', form);
  },
  show(id) {
    return Api().get('/type/' + id);
  },
  update(form, id) {
    return Api().put('/type/' + id, form);
  },
  delete(id) {
    return Api().delete('/type/' + id);
  },
  getDetail(){
    return Api().get('/type/detail');
  }
}