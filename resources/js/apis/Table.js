import Api from './Api'

export default {
  index() {
    return Api().get('/table');
  },
  create(form) {
    return Api().post('/table', form);
  },
  update(form, id) {
    return Api().put('/table/' + id, form);
  },
  show(id) {
    return Api().get('/table/' + id);
  },
  delete(id) {
    return Api().delete('/table/' + id);
  },
  getBanTrong(){
    return Api().get('/table/getbantrong');
  },
  getBanPhucVu(){
    return Api().get('/table/getbanphucvu');
  },
}