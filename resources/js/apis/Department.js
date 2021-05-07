import Api from './Api'

export default {
  get() {
    return Api().get('/department/get');
  },
  index() {
    return Api().get('/department');
  },
  create(form) {
    return Api().post('/department', form);
  },
  show(id) {
    return Api().get('/department/' + id);
  },
  update(form, id) {
    return Api().post('/department/' + id + '?_method=put', form);
  }
}