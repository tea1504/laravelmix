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
  },
  getDetail(id) {
    return Api().get('/invoice/detail/' + id);
  },
  thanhToan(id) {
    return Api().post('/invoice/thanhtoan/' + id);
  }
}