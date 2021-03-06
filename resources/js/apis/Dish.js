import Api from './Api'

export default {
  index() {
    return Api().get('/dish');
  },
  show(id) {
    return Api().get('/dish/' + id);
  },
  create(form) {
    return Api().post('/dish', form);
  },
  update(form, id) {
    return Api().post('/dish/' + id + '?_method=put', form);
  },
  delete(id) {
    return Api().delete('/dish/' + id);
  },
  setStatus() {
    return Api().get('/dish/setstatus');
  },
  khoiPhuc(id) {
    return Api().get('/dish/khoiphuc/' + id);
  },
  hetHang(id) {
    return Api().get('/dish/hethang/' + id);
  },
}