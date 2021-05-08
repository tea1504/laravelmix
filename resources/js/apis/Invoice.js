import Api from './Api'

export default {
  index() {
    return Api().get('/invoice');
  },
  show(id) {
    return Api().get('/invoice/' + id);
  },
  create(form) {
    return Api().post('/invoice', form);
  },
  update(form, id) {
    return Api().put('/invoice/' + id, form);
  },
  delete(id) {
    return Api().delete('/invoice/' + id);
  }
}