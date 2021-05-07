import Api from './Api'

export default {
  index() {
    return Api().get('/table');
  },
  create(form) {
    return Api().post('/table', form);
  },
  update(id, form) {
    return Api().put('/table/' + id, form);
  }
}